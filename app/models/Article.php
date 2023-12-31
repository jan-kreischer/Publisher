<?php 
class Article extends Eloquent {
	protected $table = 'articles';
	protected $primaryKey = 'article_id';
	public $timestamps = TRUE;
	protected $guarded = [];
	public static $rules = [];
	//article counter
	//user score counter
	
	//One User probably has many Articles
	//1:n (user:articles) Relation
	/*public function user() {
		return $this->belongsTo('User', 'user_id');
	}*/
	
	public function article_preview() {
		$template = Config::get('c.article.article_preview.template');
		return sprintf($template, $this->article_id_hidden(), $this->author->a(), $this->article_options(), $this->article_title, $this->article_abstract(), 
		$this->article_rating(), $this->article_republishings(), $this->article_comments(), $this->article_views());
	}
	
	public function tags() {
		return $this->hasMany('Tag', 'article_id', 'article_id')->orderBy('created_at', 'ASC')->limit(8);
	}
	
	public function article_interaction() 
	{
		$template = Config::get('c.article.article_interaction.template');
		return sprintf($template, $this->up_count(), $this->down_count(), $this->comment_count(), $this->view_count());
	}
	
	public function author() {
		return $this->hasOne('User', 'user_id', 'user_id');
	}
	
	public function article_views() {
		$template = Config::get('c.article.view_template');
		return sprintf($template, $this->a(1) ,side(), $this->view_count());
	}
	
	public function article_options() {
		$template = Config::get('c.article.article_options.template');
		return $template;
	}
	
	public function article_republishings() {
		$template = $template = Config::get('c.article.republishing_template');
		return sprintf($template, side(), 0);
	}
	
	public function article_comments() {
		$template = Config::get('c.article.comment_template');
		return sprintf($template, $this->a(1,'comment'), side(), $this->comment_count());
	}
	
	//every article is linked with 
	//many comments
	//1:n
	public function comments($order = 'DESC') {
		return $this->hasMany('Comment', 'article_id', 'article_id')->orderBy('created_at', $order)->limit(16);
	}
	
	public function comment_count($order = 'DESC') {
		return intval($this->hasMany('Comment', 'article_id', 'article_id')->count());
	}
	
	public function category () {
		return $this->belongsTo('Category', 'category_id');
	}
	
	public function related_articles() {
		//return $this->hasMany('')
	}
	
	public function up_count() {
		return $this->hasMany('Rating', 'article_id', 'article_id')->where('rating_value', '=', 1)->count();
	}
	
	public function down_count() {
		return $this->hasMany('Rating', 'article_id', 'article_id')->where('rating_value', '=', -1)->count();
	}
	
	public function view_count() {
		return $this->article_view_count;
	}
	
	public function article_abstract() {
		return str_limit($this->article_content, 255, $this->a(1) . '...</a>');
	}
	
	//Relations without ()
	//Model Functions with ()
	/*public function summary() {
		return "yo";
	}*/
	
	public function this_user_rating() {	
		if(Auth::check()) {
		$this_user_id = Auth::user()->user_id;
			$this_user_rating = ($this->hasMany('Rating', 'article_id', 'article_id')->where('user_id','=', $this_user_id)->select(['rating_value'])->first());
			return $this_user_rating['rating_value'];
		}
		else {
			return 0;
		}
	}
	
	public function article_visibility() {
		return $this->article_visibility;
	}
	
	public function hidden_article_id() {
		$template = Config::get('c.article.article_id.template');
		return sprintf($template, $this->article_id);
	}
	
	public function article_id_hidden() {
		$template = Config::get('c.article.article_id.template');
		return sprintf($template, $this->article_id);
	}
	
	public function hidden_article_timestamp() {
		$template = Config::get('c.article.article_timestamp.template');
		return sprintf($template, $this->created_at);
	}
	
	public function a($mode = 0, $fragment = NULL) {
		$close = "</a>";
		if($mode == 2) {
			return $close;
		}
		$open = "<a href=" . $this->article_url($fragment) . " class=\"article-a\">";
		if($mode == 1) {
			return $open;
		}
		else {
			return $open . $close;
		}
	}
	
	public function article_a() {
		return "<a href=" . $this->article_url() . ">
			$this->article_title
		</a>";
	}
	
	public function article_content() {
		return parse_markup($this->article_content); 
	}
	
	public function article_url($fragment = '') {
		return "https://www.publisr.com/article/" . $this->article_str . '#' . $fragment;
	}
	
	public function article_rating() {
		$up_state = '';
		$down_state = '';
		$this_user_rating = $this->this_user_rating();
		if($this_user_rating == 1) {
			$up_state = ' active';
		}
		
		if($this_user_rating == -1) {
			$down_state = ' active';
		}
		$template = Config::get('c.article.article_rating.template');
		return sprintf($template, $this->hidden_article_id(), side() . $up_state,  $this->up_count(), side() . $down_state, $this->down_count());
	}
	
	//1 Article - mc Articleimages
	public function articleimages() {
		return $this->hasMany('Articleimage', 'article_id', 'article_id')->select(
				[
				'articleimage_name',
				'articleimage_extension',
				'articleimage_width',
				'articleimage_height',
				]
				)->get();
	}
}