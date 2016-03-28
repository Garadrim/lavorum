<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
Route::group(['middleware' => 'web'], function () {
    //
    Route::auth();
	Route::get('/', function () { return view('welcome'); });
    Route::get('/home', 'HomeController@index');


	/*
		Lavorum project
	*/
	// HOME
	//Route::get('lavorum','LavorumController@index');
	Route::get('lavorum','PostController@index');

	// USER
	// User profile
	Route::get('lavorum/user/{id}', 'UserController@profile')->where('id', '[0-9]+');
	// Display list of posts
	Route::get('lavorum/user/{id}/posts', 'UserController@posts')->where('id', '[0-9]+');
	// Display all of a users posts
	Route::get('lavorum/user/all', 'UserController@allposts');
	// Display all of a users drafts
	Route::get('lavorum/user/drafts', 'UserController@drafts');
	

	// POSTS
	// Display single post
	Route::get('lavorum/view/{slug}', 'PostController@show')->where('slug', '[A-Za-z0-9-_]+');
	// Show new post form
	Route::get('lavorum/post/create', 'PostController@create');
	// Save new post
	Route::post('lavorum/post/create', 'PostController@store');
	// Edit post
	Route::get('lavorum/post/edit/{slug}', 'PostController@edit');
	// Update edited post
	Route::post('lavorum/post/update', 'PostController@update');
	// Delete post
	Route::get('lavorum/post/delete/{id}', 'PostController@delete_this');

	// COMMENTS
	// Add comment
	Route::post('lavorum/comment/add', 'CommentController@store');
	// Delete comment
	Route::post('lavorum/comment/delete/{id}', 'CommentController@delete_this');


	/*
		Authentication
	*/
	Route::controllers([
		'auth' => 'Auth\AuthController',
		'password' => 'Auth\PasswordController'
	]);
	
});


Route::group(['middleware' => 'auth'], function () {
	/*
			Lavorum Project
	*/
});
