<?php

Route::group(['prefix' => 'v1'], function() {
    Route::get('/debug', function(){
        echo base_path();
    });

    // User & Auth
    Route::controllers([
        'auth' => 'Auth\AuthController',
        'password' => 'Auth\PasswordController',
    ]);
    Route::resource('tokens', 'TokenController', array('only' => array('create','destroy')));
    Route::resource('profiles', 'ProfileController', array('only' => array('index','show')));
    Route::resource('users', 'UserController');

    // Relation
    Route::resource('friends', 'FriendController');
    Route::resource('follows', 'FollowController');
    Route::resource('members', 'MemberController');

    // Content
    Route::resource('posts', 'PostController');
    Route::resource('comments', 'CommentController');
    Route::resource('likes', 'LikeController');

    // Upload
    Route::controller('files', 'FileController');

    // Message
    Route::resource('channels', 'ChannelController');
    Route::resource('messages', 'MessageController');

    // Others
    Route::resource('helps', 'HelpController');

});

Route::get('/', 'WelcomeController@index');
Route::controller('debug', 'DebugController');
