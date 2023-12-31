<?php 
class Category extends Eloquent {
	protected $table = 'categories';
	protected $primaryKey = 'category_id';
	public $timestamps = FALSE;
	
	public function output ()
	{
		$category_name = $this->category_name;
		return sprintf(Config::get('c.category.category_template'), URL::to("category/" . strtolower($category_name)), $category_name);
	}
}