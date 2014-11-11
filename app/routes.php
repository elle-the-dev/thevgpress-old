<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', "HomeController@showWelcome" );
Route::get('login', "LoginController@login");
Route::post('loginPost', "LoginController@loginPost");
Route::any('logout', "LoginController@logout");
Route::get('join', "JoinController@join");
Route::post('joinPost', "JoinController@joinPost");
Route::any('chat', "ChatController@chat");
Route::any('chat/{username}', "ChatController@chat");
Route::post('chatPost', "ChatController@chatPost");
Route::post('messages/{username}', "ChatController@messages");
