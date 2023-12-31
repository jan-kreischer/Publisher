<?php
App::missing(function($exception)
{
	return View::make('errors.404');
});

Event::listen('article.viewed', function($article){
	$article->increment('article_view_count');
});

Route::when('*', 'csrf', ['post', 'put', 'delete']);

Route::get('/', ['as' => 'index', 'uses' => 'IndexController@getIndex']);
//Route::post('/', ['uses' => 'IndexController@postIndex']);

Route::get('contact', ['as' => 'contact', 'uses' => 'IndexController@getContact']);
Route::post('contact', ['as' => 'contact', 'uses' => 'IndexController@postContact']);

Route::get('login', ['uses' => 'AuthenticationController@getLogin'])->before('outsider');
Route::post('login', ['uses' => 'AuthenticationController@postLogin']);

Route::get('logout', ['uses' => 'AuthenticationController@getLogout']);

Route::get('register', array('as' => 'register', 'uses' => 'AuthenticationController@getRegister'))->before('outsider');
Route::post('register',array('uses' => 'AuthenticationController@postRegister'));

Route::post('user',array('uses' => 'UserController@postUser'));
Route::get('user/{that_user_id?}', array('as' => 'user', 'uses' => 'UserController@getUser'))->before('insider');
//site for writing articles
Route::get('article/{article_str?}', array('as' => 'article', 'uses' => 'ArticleController@getArticle'));
Route::get('article/{article_str?}/edit', array('as' => 'article', 'uses' => 'ArticleController@editArticle'));
Route::post('article', ['uses' => 'ArticleController@postAjaxArticle']);

Route::get('articles', array('as' => 'articles', 'uses' => 'ArticleController@getArticles'));

Route::get('tag/$tag_content', ['uses' => 'ArticleController@getTag']);
Route::get('author/{$username}', array('as' => 'author', 'uses' => 'AuthorController@getAuthor'));
//should show valuable articles

Route::get('test3', function() {
	return View::make('tests.test3');
});
Route::post('test3', array('uses' => 'TestController@postTest3'));

Route::get('test2', function() {
	return View::make('tests.test2');
});
Route::post('test2', array('uses' => 'ArticleController@ajaxPostArticleImage'));

Route::get('test1', function() {
	return View::make('tests.test1');
});
Route::post('test1', array('uses' => 'ArticleController@ajaxPostArticleImages'));

Route::post('reload', ['uses' => 'ArticleController@load_article']);

//POSTs Only - AJAX Interface
Route::group(['before' => 'insider'], function()
{
	Route::post('tag', ['uses' => 'ArticleController@tag']);
	Route::post('rate', ['uses' => 'ArticleController@rate']);
	Route::post('comment', ['uses' => 'ArticleController@comment']);
	Route::post('subscribe', ['uses' => 'UserController@subscribe']);
	Route::post('ajax', ['uses' => 'AJAXController@postIndex']);
	Route::post('userimage', ['uses' => 'UserController@postUploadUserImage']);
	Route::post('articleimage', ['uses' => 'ArticleController@postAjaxArticleImage']);
	Route::post('delete', ['uses' => 'ArticleController@delete']);
	Route::post('article/delete', ['uses' => 'ArticleController@delete']);
	Route::post('article/edit', ['uses' => 'ArticleController@delete']);
	
	Route::post('postUploadUserImage', ['uses' => 'UserController@postUploadUserImage']);
	Route::get('search', array('as' => 'search', 'uses' => 'IndexController@getSearch'));
	
	Route::get('info', array('as' => 'info', 'uses' => 'IndexController@getInfo'));
	
	Route::get('confirm', array('as' => 'confirm', 'uses' => 'AuthenticationController@getConfirm'));
});

