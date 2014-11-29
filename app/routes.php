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

// public routes
Route::get('/', "HomeController@showWelcome" );
Route::get('login', "LoginController@login");
Route::post('loginPost', "LoginController@loginPost");
Route::any('logout', "LoginController@logout");
Route::get('join', "JoinController@join");
Route::post('joinPost', "JoinController@joinPost");
Route::get('forum-boards/{id}', "ForumBoardController@forumBoard");

// routes with permissions - should all have 'before' => 'auth'
Route::any(
    'chat',
    array('before' => 'auth:TEST', 'uses' =>"ChatController@chat")
);
Route::any(
    'chat/{username}',
    array('before' => 'auth:TEST', "ChatController@chat")
);
Route::post(
    'chatPost',
    array('before' => 'auth:TEST', "ChatController@chatPost")
);
Route::post(
    'messages/{username}',
    array('before' => 'auth:TEST', "ChatController@messages")
);
