<?php 
class Userimage extends Eloquent {
	protected $table = 'userimages';
	protected $primaryKey = 'userimage_id';
	public $timestamps = TRUE;
	
	public function userimage_src() {
		return 'src="' . Config::get('c.userimages') . '/' . $this->userimage_name . '.' . $this->userimage_extension . '"';
	}
	
	public function output() {
		return "<img " . $this->userimage_src() . "class=\"userimage\"/>";
	}
}