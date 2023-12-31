<?php 
class Articleimage extends Eloquent {
	protected $table = 'articleimages';
	protected $primaryKey = 'articleimage_id';
	public $timestamps = TRUE;
	
	public function articleimage_src() {
		return 'src="' . Config::get('c.articleimages') . '/' . $this->articleimage_name . '.' . $this->articleimage_extension . '"';
	}
	
	public function articleimage_dimensions () {
		return 'width="' . $this->articleimage_width . 'px"' . ' ' . 'height="' . $this->articleimage_height . 'px"';
	}
	
	public function articleimage_info() {
		return 'title="' . $this->articleimage_title . '"' . ' ' . 'alt="' . $this->articleimage_description . '"';
	}
	
	public function output() {
		return "<img " . $this->articleimage_src() . " " . $this->articleimage_dimensions() . " " . $this->articleimage_info() . "class=\"articleimage\"/>";
	}
}