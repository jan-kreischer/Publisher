<?php 
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
class User extends Eloquent implements UserInterface, RemindableInterface {
	use UserTrait, RemindableTrait, SoftDeletingTrait;
	protected $table = 'users';
	protected $primaryKey = 'user_id';
	public $timestamps = TRUE;
	protected $hidden = ['password', 'remember_token'];
	
	public function is_username($string) {
		
	}
	
	public function is_user_id($string) {
		
	}
	
	public function articles() {
		return $this->hasMany('Article', 'article_id');
	}
	
	public function article($number = 0) {
		$collection_of_articles = $this->hasMany('Article', 'user_id', 'user_id')->orderBy('created_at', 'DESC')->skip($number)->limit(1)->get();
		if($collection_of_articles->isEmpty()) {
			return NULL;
		}
		else {
			return $collection_of_articles->first();
		}
	}
	
	public function language() {
		return $this->belongsTo('Language', 'language_id', 'language_id');
	}
	
	public function name() {
		return $this->first_name . ' ' . $this->last_name;
	}
	
	public function userimage() {
		return $this->hasOne('Userimage', 'user_id', 'user_id')->select(['userimage_name', 'userimage_extension'])->latest();
	}
	
	public function email_is_confirmed() {
		if($this->email_confirmed == TRUE && $this->email_confirmation_code == NULL) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

	//mc
	public function subscribers_count() {
		return $this->hasMany('Subscription', 'author_id', 'user_id')->count();
	}
	
	public function subscribers () {
		return $this->belongsToMany('User', 'subscriptions', 'author_id', 'subscriber_id')->select(['first_name', 'last_name', 'user_id'])->take(9);
	}
	
	public function authors() {
		return $this->belongsToMany('User', 'subscriptions', 'subscriber_id', 'author_id')->select(['first_name', 'last_name', 'user_id'])->take(9);
	}
	
	//mc
	public function authors_count() {
		return $this->hasMany('Subscription', 'subscriber_id', 'user_id')->count();
	}

	public function userimage_src($size = NULL) 
	{
			$userimage = $this->userimage;
			if(!empty($userimage)) {
				return Config::get('c.userimages') . '/' . $userimage->userimage_name . '.' . $userimage->userimage_extension;
			}
			else {
				return Config::get('c.userimages') . '/user.svg';
			}
	}
	
	public function userimage_output ()
	{
		return "<img src=" . $this->userimage_src() . " class=\"userimage\"/>";
	}
	
	public function a() 
	{
		return "<a href=\"/user/$this->user_id\">" . $this->name() . "</a>";
	}

	public function hidden_user_id() {
		return Form::hidden('that_user_id', $this->user_id, ['id' => '', 'class' => 'that_user_id']);
	}
	
	public function profile_picture() {
		
	}
	//each article is linked to
	//a specified category
	
	public function articles_count() {
		return $this->hasMany('Article', 'user_id', 'user_id')->count();
	}
	
	public function recent_articles() {
		return $this->hasMany('Article', 'user_id', 'user_id')->select(['user_id', 'article_title', 'article_id' ,'article_content', 'article_str', 'article_view_count', 'article_visibility'])->orderBy('created_at', 'DESC')->limit(3)->get();
	}
	
	public function relevant_articles() {
		
	}
	
	public function subscribed_articles() {
		
	}
	
	public function comments () {
		return $this->hasMany('Comment', 'user_id', 'user_id');
	}
}