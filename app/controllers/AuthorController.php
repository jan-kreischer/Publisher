<?php 
class AuthorController extends Controller {
	public function getAuthor($username) {
		return View::make('user.public.user');
	}
}