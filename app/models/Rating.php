<?php
class Rating extends Eloquent {
	protected $table = 'ratings';
	protected $primaryKey = 'rating_id';
	public $timestamps = FALSE;

	
	public function user() {
		return $this->belongsTo('User', 'user_id', 'user_id');
	}

	public function article () {
		return $this->belongsTo('Article', 'article_id', 'article_id');
	}
}