<?php 
class Comment extends Eloquent {
	protected $table = 'comments';
	protected $primaryKey = 'comment_id';
	public $timestamps = TRUE;
	
	public function article()
	{
		return $this->belongsTo('Article', 'article_id', 'article_id');
	}
	
	public function commenter()
	{
		//Foreign Model, Foreign Key, Local Key
		return $this->belongsTo('User', 'user_id', 'user_id')->select([
			'user_id',
			'first_name',
			'last_name',	
		]);
	}
}