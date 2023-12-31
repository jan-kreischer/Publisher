<?php

class ArticleController extends BaseController {
	public function getArticle($article_str = NULL) {
		//$article_str made up of [a-zA-Z0-9] => 62C
		//view_visiblity
		if(!empty($article_str) & (strlen($article_str)===16)) {
			$article = Article::where('article_str', '=', $article_str)->firstOrFail();
			$this_user = Auth::user();
			$that_user = $article->author;
			$comments = $article->comments;
			$recent_articles = $that_user->recent_articles();
			
			//articleimage_path always set
			$articleimage_path = Config::get('c.articleimage_path');
			
			$articleimages = $article->articleimages();
			if(Auth::check()) {
				$this_user_rating = $article->this_user_rating($this_user->user_id);
			}
			else {
				$this_user_rating = 0;
			}
			$tags = $article->tags;

			//store user and view in views table
			//increment view count
			Event::fire('article.viewed', $article);
			$data = [
					'article' => $article,
					'articleimages' => $articleimages,
					'articleimage_path' => $articleimage_path,
					'this_user' => $this_user,
					'that_user' => $that_user,
					'comments' => $comments,
					'this_user_rating' => $this_user_rating,
					'view' => view_visibility($that_user->user_id),
					'tags' => $tags,
					'recent_articles' => $recent_articles,
			];			
			return View::make('article.index', $data);
		}
		elseif(!empty($article_str)) {
			//return with errors because article can not be found 
			//because $article_str needs to be 16 characters of asci chars
			return Redirect::to('articles')->with(['alert_error' => 'Article can´t be found']);
		}
		else {
			//return without errors an only list all articles from categories
			return Redirect::route('articles', []);
		}
	}
	
	public function getArticles() {
		return View::make('articles.index');
	}
	
	public function load_article() {
		$request_data_rules = [
			'that_user_id' => 'required|integer',
			'number_items' => 'required|integer',	
		];
		$response_data = [];
		
		$request_data = Input::only(array_keys($request_data_rules));
		$validator = Validator::make($request_data, $request_data_rules);
		
		if($validator->passes()) {
			$that_user = User::find(Input::get('that_user_id'));
			//Article::where('user_id', '=', Input::get('that_user_id')->orderBy('created_at', 'DESC')->get(4);
			
			$article = $that_user->article(Input::get('number_items'));
			if(!empty($article)) {
				$response_data['html'] = $article->article_preview();
				$response_data['success'] = TRUE;
			}
		}
		else {
			$response_data['success'] = FALSE;
		}
		return Response::json($response_data);
	}
	
	public function tag() {
		//AJAX Request
		$request_data_rules = [
			'tag_content' => Config::get('c.tag.tag_content.rules'),
			'article_id' => 'required',
			'article_str' => 'required',
		];
		
		if(Auth::check()) {
			//extract keys from array
			$request_data = Input::only(array_keys($request_data_rules));
			$validator = Validator::make($request_data, $request_data_rules);
			if($validator->passes()) {
				$tag_content = explode(' ', Input::get('tag_content'))[0];
				$tag = new Tag();
				$tag->tag_content = $tag_content;
				$tag->article_id = Input::get('article_id');
				$tag->user_id = Auth::user()->user_id;
				$tag->save();
				
				$response_data['tag_content'] = $tag_content;
				$response_data['success'] = TRUE;
				
				$url = URL::to("tag/$tag_content");
				$tag_template = Config::get('c.tag.tag_template');
				$response_data['html'] = sprintf($tag_template, $url, $tag_content);
				return Response::json($response_data);
			}
		}
	}
	
	public function postAjaxArticle() 
	{	
		$request_data_rules =[
			'article_content' => 'required',
			'article_title' => 'required',
			'article_visiblity' => 'required',
		];
		
		$response_data =[
			'success' => FALSE,
		];

		if(Auth::check()) 
		{
			$user = Auth::user();
		
			$request_data = Input::all();
		
			$article = new Article();
			$article->article_str = time() . str_random(6);
			$article->user_id = $user->user_id;
			$article->article_published = TRUE;
			$article->article_content = nl2br(Input::get('article_content'));
			$article->article_title = Input::get('article_title');
			$article->article_visibility = Input::get('article_visibility');
			$article->article_info = '';
			$article->category_id = intval(Input::get('category_id'));
			$article->save();
			
			$response_data['success'] = TRUE;
			$article_url = URL::to('/article/' . $article->article_str);
			$response_data['href'] = $article_url;
			
			//check for all possible articlimages_ids
			//with the form of articleimage_id_$i
			for($i = 1; $i <= Config::get('c.max_articleimages'); $i++) {
				$articleimage_id = Input::get('articleimage_id_' . $i);
				//if there is an articleimage_id there is an image uploaded previously
				if(!empty($articleimage_id)) {
					//$response_data['articleimages'][$i]['articleimage_id'] = intval(Input::get('articleimage_id_' . $i));
					$articleimage = Articleimage::find($articleimage_id);
					if(Auth::user()->user_id == $articleimage->user_id) {
						if(empty($articleimage->article_id)) {
							$articleimage->article_id = $article->article_id;
						}
					}
					$articleimage->save();
					$response_data[$i] = $articleimage ;
				}
			}
		
		}
		else 
		{
			$response_data['message'] = 'not authenticated';
			$response_data['href'] = URL::to('login');
		}
		
		//Return
		if(Request::ajax()) 
		{
			return Response::json($response_data);
		}
		else 
		{
			return Redirect::to($article_url);
		}
	}
	
	public function getTag() {
		
	}
	
	public function postAjaxArticleImage() {
		$response_data = [];
		$allowed_size = 2000000;
		$allowed_extensions = ['jpg', 'jpeg', 'png'];
		$name = 'articleimage';
		
		if(Auth::check() & Input::hasFile($name)) {
			$user_id = intval(Auth::user()->user_id);
			$articleimage = Input::file($name);
			
			$current_file_name = $articleimage->getClientOriginalName();
			$current_file_extension = $articleimage->getClientOriginalExtension();
			$current_file_size = intval($articleimage->getSize());
			
			//check if file size is suitable 
			if ($current_file_size < $allowed_size) {
				if(in_array($current_file_extension, $allowed_extensions)) {
					//prefix => 22 characters random ascii
					//postfix => 10 characters time
					//filename => 32 characters
					$destination_file_name = time() . str_random(22);
					//extension stays the same
					$destination_file_extension = $current_file_extension;
					//file size doesnt change
					$destination_file_size = $current_file_size;
					//path where the image gets copied relative to doc root
					//$destination_file_path = Config::get('c.articleimages');
					$destination_file_path = public_path() . '/uploads/articleimages';
						
						$upload_success = $articleimage->move($destination_file_path, $destination_file_name . '.' . $destination_file_extension);
						if($upload_success) {
							
							$src = $destination_file_path . '/' . $destination_file_name . '.' . $destination_file_extension;
							list($width, $height, $crap, $dimensions) = getimagesize($src);
							
							$articleimage = new Articleimage();
							$articleimage->user_id = $user_id;
							$articleimage->article_id = NULL;
							$articleimage->articleimage_name = $destination_file_name;
							$articleimage->articleimage_extension = $destination_file_extension;
							$articleimage->articleimage_size = $destination_file_size;
							$articleimage->articleimage_width = $width;
							$articleimage->articleimage_height = $height;
							$articleimage->articleimage_title = NULL;
							$articleimage->articleimage_description = NULL;
							$articleimage->save();
						
							$response_data['dimensions'] = $dimensions;
							$response_data['articleimage_id'] = $articleimage->articleimage_id;
							$response_data['src'] = $src;
							$response_data['success'] = TRUE;
						}
						else {
							//upload failed
							$response_data['error'] = '1.1.1.0';
							$response_data['message'] = 'upload failed';
						}
						
					}
					else {
						//wrong extension
						//not jpg or png
						$response_data['error'] = '1.1.0';
						$response_data['message'] = 'wrong extension';
					}
				}
				else {
					//wrong size
					//too large
					$response_data['error'] = '1.0';
					$response_data['message'] = 'max 2MB in Size';
				}
		}
		else {
			$response_data['error'] = '0';
			$response_data['message'] = 'no permissions or file';
		}
		return Response::json($response_data);
	}
	
	public function ajaxPostArticleImages() {
		$response_data = [];
		$allowed_size = 2000000;
		$name = 'article_images';
		
		if(Auth::check() & Input::hasFile($name)) {
			$allowed_extensions = ['jpg', 'jpeg', 'png'];
			$user_id = Auth::user()->user_id;
			//path where the image gets copied relative to doc root
			$destination_path = Config::get('conf.img.article');
			
			//stores number of images
			$article_images_counter = 0;
			//empty array for storing information about article images
			$article_images = [];
			foreach(Input::file($name) as $image) {
				//check if file size is suitable < 2MB
				$current_file_size = intval($image->getSize());
				if ($current_file_size < $allowed_size) {
	
					$current_file_name = $image->getClientOriginalName();
					$current_file_extension = $image->getClientOriginalExtension();
					if(in_array($current_file_extension, $allowed_extensions)) {
						//prefix => 22 characters random ascii
						//postfix => 10 characters time
						//filename => 32 characters
						$destination_file_name = str_random(22) . time();
						//extension stays the same
						$destination_file_extension = $current_file_extension;
						//file size doesnt change
						$destination_file_size = $current_file_size;
						
						$upload_success = $image->move($destination_path, $destination_file_name . '.' . $destination_file_extension);
						if($upload_success) {
							$articleimage = new articleimage();
							$articleimage->user_id = $user_id;
							$articleimage->article_id = 1;
							$articleimage->articleimage_name = $destination_file_name;
							$articleimage->articleimage_extension = $destination_file_extension;
							$articleimage->articleimage_size = $destination_file_size;
							$articleimage->articleimage_width = 1;
							$articleimage->articleimage_height = 1;
							$articleimage->articleimage_description = 'fuck';
							$articleimage->save();
							
							$article_images[$article_images_counter]['file_name'] = $destination_file_name . '.' . $destination_file_extension;
							$article_images[$article_images_counter]['src'] = $destination_path . '/' . $destination_file_name . '.' . $destination_file_extension;
							$article_images[$article_images_counter]['file_upload_success'] = TRUE;
							$article_images_counter++;
						}
						else {
							//upload failed
							$response_data['error'] = '1.1.1.0';
							$response_data['message'] = 'upload failed';
						}
						
					}
					else {
						//wrong extension
						//not jpg or png
						$response_data['error'] = '1.1.0';
						$response_data['message'] = 'wrong extension';
					}
				}
				else {
					//wrong size
					//too large
					$response_data['error'] = '1.0';
					$response_data['message'] = 'max 2MB in Size';
				}
			}
			$response_data['article_images'] = $article_images;
		}
		else {
			$response_data['error'] = '0';
			$response_data['message'] = 'no permissions or file';
		}
		
		return Response::json($response_data);
	}
	
	public function rate() {
		if(Input::get('rating_type') == 'article') {
		if(Request::ajax() & Auth::check()) {
			//$request_data = Input::all();
			$response_data = [];
			$rating_value = intval(Input::get('rating_value'));
			$article_id = intval(Input::get('article_id'));
			$user_id = Auth::user()->user_id;
			
			//check if article hast already been rated by user
			//if not rated =>add new rating
			//if already rated =>only update rating
			$query = Rating::where('user_id', '=', $user_id)
			->where('article_id', '=', $article_id);
			$existing_rating = $query->first();
			//Illuminati Collection
			//get first Rating Model Object
			if(!empty($existing_rating)) {
				//get the current rating value
				//if they match the same button was hit twice
				if((intval($existing_rating->rating_value)) === $rating_value) {
					//therefore set to neutral position
					$query->update(array('rating_value' => 0));
					$response_data['rating_value'] = 0;
				}
				else {
					//else other button has been hit
					//therefore only update the position
					$query->update(array('rating_value' => $rating_value));
					$response_data['rating_value'] = $rating_value;
				}
			}
			//if already rated
			//=> update rating_value field
			else {
				$new_rating = new Rating();
				$new_rating->user_id = $user_id;
				$new_rating->article_id = $article_id;
				$new_rating->rating_value = $rating_value;
				$new_rating->save();
				
				$response_data['rating'] = $rating_value;
			}
			
			//count ups from db
			$current_up_count = Rating::where('rating_value', '=', 1)
			->where('article_id', '=', $article_id)->get()->count();
			$response_data['up_count'] = $current_up_count;
			
			//count downs from db
			$current_down_count = Rating::where('rating_value', '=', -1)
			->where('article_id', '=', $article_id)->get()->count();
			$response_data['down_count'] = $current_down_count;
			
			//confirm success at last
			$response_data['success'] = TRUE;
			return Response::json($response_data);
		}
		}
	}
	
	public function comment() {
		$comment_maxlength = Config::get('c.comment.comment_maxlength');
		$comment_minlength = Config::get('c.comment.comment_minlength');
		$response_data = [];
		$rules = [
			'comment_content' => "required|min:$comment_minlength|max:$comment_maxlength",
			'article_id' => 'required|integer',
			'user_id' => 'required|integer',
		];
		
		$request_data = Input::only(array_keys($rules));
		$request_data['user_id'] = Auth::user()->user_id;
		
		$validator = Validator::make($request_data, $rules);
	
		if($validator->passes()) {
			$comment = new Comment();
			$comment->comment = Input::get('comment_content');
			$comment->article_id = Input::get('article_id');
			$comment->user_id = Auth::user()->user_id;
			$comment->save();
		}
		$response_data['success'] = TRUE;
		return Response::json($response_data);
	}

	public function delete() {
		$article_id = Input::get('article_id');
		$article = Article::find($article_id);
		$article->delete();

		return Response::json(['hallo' => 'kevin']);
	}
	
	public function edit() {
		$article_id = Input::get('article_id');
		$article = Article::find($article_id);
		$response_data['article_content'] = $article->article_content;
		$response_data['article_title'] = $article->article_title;
		
		return Response::json();
	}
}
