<?php

class IndexController extends BaseController {
	public function getIndex()
	{
		/*$articles = Article::where('published', '=', 1)->get();
		return View::make('home')->with('articles', $articles);*/
		if(Auth::check()) {
			return Redirect::to('user');
		}
		else {
			return Redirect::to('articles');
		}
	}
		
	public function postIndex()
	{
	}
	
	public function getSearch() {
		
	}
	
	public function getInfo() {
		return View::make('info.index');
	}
	
	public function getContact() {
		return View::make('contact.index');
	}
	
	public function postContact() {
		return Redirect::to('/')->with([
			'alert_success' => 'Thanks for writing us!',
		]);
	}
}
