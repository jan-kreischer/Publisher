<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	/*if(!Request::secure())
	{
		return Redirect::secure($_SERVER['REQUEST_URI']);
	}*/
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Insider Filters
|--------------------------------------------------------------------------
| The Insider Filter checks if a user is authenticated and so on an Insider
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('insider', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			$response_data['href'] = URL::secure('login');
			return Response::json($response_data);
			//return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::to('login');
		}
	}
});

Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest/Outsider Filter
|--------------------------------------------------------------------------
| The Outsider filter is the counterpart of the Insider filter.
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('outsider', function()
{
	if (Auth::check())
	{
		return Redirect::to('/logout');
	}
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	$token = (Request::ajax())? Request::header('csrf_token') : Input::get('_token');
	if (Session::token() != $token)
	{
		//throw new Illuminate\Session\TokenMismatchException;
	}
});

Route::filter('https', function()
{
	if(!Request::secure())
	{
		return Redirect::secure(Request::fullUrl());
	}

});
