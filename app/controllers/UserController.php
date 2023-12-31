<?php 
class UserController extends Controller {
	

	//Get This or That Users Profile
	public function getUser($that_user_id = NULL) {
		if(!empty($that_user_id)) {
			$this_user = Auth::user();
			
			try
			{
				if(is_int(intval($that_user_id))) {
					$that_user = User::findOrFail(intval($that_user_id));
				}
				else {
					$that_user;
				}
			}
			catch(Exception $e)
			{
				return Redirect::to('/')->with([
						'alert_error' => 'user not found',
				]);
			}
			
			$view = view_visibility($that_user_id);
			if($view['is_private']) {
				return Redirect::to('/user');
			}
		}
		else {
			$this_user = Auth::user();
			$that_user = $this_user;
			$view = view_visibility($that_user->user_id);
		}
		$subscribers = $that_user->subscribers;
		$subscribers_count = $that_user->subscribers_count();
		$authors = $that_user->authors;
		$authors_count = $that_user->authors_count();
		
		$recent_articles = $that_user->recent_articles();
		$userimage_path = $that_user->userimage_src();
		
		//Article::where('user_id', '=', 1)->orderBy('created_at', 'DESC')->get(4);
		var_dump($this_user->article(0));
		
		return View::make('user.index')->with([
			'view' => $view,
			'this_user' => $this_user,
			'that_user' => $that_user,
			'recent_articles' => $recent_articles,
			'authors' => $authors,
			'authors_count' => $authors_count,
			'subscribers' => $subscribers,
			'subscribers_count' => $subscribers_count,
			'userimage_path' => $userimage_path,
		]);
	}

	public function postUser() {
		
	}
	
	//this user (subscriber) subscribes to that user (author)
	//and gets a subscription
	public function subscribe() 
	{
			$response_data = [];
			$rules = [
				'that_user_id' => 'required|integer|min:0',
			];
			
			$validator = Validator::make(Input::only(array_keys($rules)), $rules);
			
			if($validator->passes()) 
			{
				$this_user_id = intval(Auth::user()->user_id);
				$that_user_id = intval(Input::get('that_user_id'));
				$that_user = User::find($that_user_id);
				
				$subscription = Subscription::where('subscriber_id', '=', $this_user_id)->where('author_id', '=', $that_user_id)->first();
				if(!empty($subscription)) 
				{
					$subscription->delete();
					
					$response_data['action'] = 'unsubscribed';
				}
				else
				{
					$subscription = new Subscription();
					$subscription->subscriber_id = Auth::user()->user_id;
					$subscription->author_id = Input::get('that_user_id');
					$subscription->save();
					
					$response_data['action'] = 'subscribed';
				}
				$response_data['subscriber_count'] = $that_user->subscribers_count();
				$response_data['success'] = TRUE;
			}
			else {
			}
		 
			if(Request::ajax()) {
				return Response::json($response_data);
			}	
			else {
				return Redirect::back()->with(['alert_success' => 'error']);
			}
		
		/*catch (Exception $e) 
		{
			return Redirect::back()->with([]);
		}*/
	}
	
	public function getAuthors() {
		return View::make('index');
	}
	
	public function editUser() {
		
	}
	
	public function postUploadUserImage() {
		$name = 'userimage';
		$allowed_size = 2000000; //in bytes
		$response_data = [];
			
		if(Auth::check()) {
			$user_id = Auth::user()->user_id;
			
			$request_data = Input::only([
				$name
			]);
			//max in kb
			$rules = [
				$name => 'required|image|max:2000',
			];
			$validator = Validator::make($request_data, $rules);
			
			if($validator->passes()) {
		
				$userimage = Input::file($name);
				$userimage_name = str_random(22) . time();
				$userimage_size = intval($userimage->getSize());
				$userimage_extension = $userimage->getClientOriginalExtension();
				//remove leading slash
				$userimage_path = substr(Config::get('c.userimages'),1);
		
				try {
					$upload_success = $userimage->move($userimage_path, $userimage_name . '.' . $userimage_extension);
					if($upload_success) {
						$userimage = new Userimage();
						$userimage->user_id = $user_id;
						$userimage->userimage_name = $userimage_name;
						$userimage->userimage_extension = $userimage_extension;
						$userimage->userimage_size = $userimage_size;
						list($userimage_width, $userimage_height) = getimagesize($userimage_path . '/' .
															 $userimage_name . '.' . 
															 $userimage_extension);
			
						$userimage->userimage_width = $userimage_width;
						$userimage->userimage_height = $userimage_height;
						$userimage->userimage_description = 'fuck';
						$userimage->save();

						$response_data['userimage'] = $userimage_path . '/' .
													  $userimage_name . '.' .
												      $userimage_extension;
						//Exit Point on Success
						$response_data['success'] = TRUE;
						return Response::json($response_data);
					}
				}
				catch(Exception $e) {
					$response_data['message'] = $e->getMessage();
				}
				
			}
			elseif ($validator->fails()) {
				$response_data['error'] = $validator->errors();
				$response_data['message'] = $validator->messages();
			}
		}
		else {
			$response_data['message'] = 'invalid permissions';
		}
		
		//Exit Point on Failure
		$response_data['success'] = FALSE;
		return Response::json($response_data);
	}
}
