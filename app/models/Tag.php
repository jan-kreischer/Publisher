<?php 
class Tag extends Eloquent {
	protected $table = 'tags';
	protected $primaryKey = 'tag_id';
	public $timestamps = TRUE;
	protected $guarded = [];
	public static $rules = [];
	
	public function output ()
	{
		$tag_content = $this->tag_content;
		return sprintf(Config::get('c.tag.tag_template'), URL::to("tag/$tag_content"), $tag_content);
	}
}