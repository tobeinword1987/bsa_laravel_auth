<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/library', function(){
    return view ('library.index');
});

Route::resource('users','UserController');

Route::resource('books','BookController');


//Route::put('users/turnbook/{id}','UserController@turnbook');
//
//Route::get('users/info/{id}','UserController@info');
//
//Route::put('users/getbook/{id}/{id_user}','UserController@getbook');

Route::group(['prefix' => 'users/'],function(){
    Route::get('info/{id}','UserController@info');
    Route::put('turnbook/{id}','UserController@turnbook');
    Route::put('getbook/{id}/{id_user}','UserController@getbook');
});
Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/auth/github', 'SocialAuthController@redirectToProvider');
Route::get('/auth/github/callback', 'SocialAuthController@handleProviderCallback');
