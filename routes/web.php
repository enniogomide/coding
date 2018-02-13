<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/*  |------------------------------------------------------------------------- 
    |                                                                        | 
    | Routes referente a autenticação, login, etc.                           |
    |                                                                        |   
    |-------------------------------------------------------------------------
*/

Auth::routes();
Route::get('/', function(){ return view('welcome'); });
Route::get('/home', function () {return view('welcome'); });
Route::get('/logout', 'Auth\LoginController@logout');

/*  |------------------------------------------------------------------------- 
    |                                                                        | 
    | Routes referente a configuração de administração                       |
    |                                                                        |   
    |-------------------------------------------------------------------------
*/

Route::group(['middleware' => 'admin'], function(){
	Route::get('admin', function(){
		return view('admin.index'); 
    });

    Route::get('/post/{id}', ['as'=>'home.post', 'uses'=>'AdminPostController@post']);

    Route::resource('admin/users', 'AdminUsersController',['names'=>[

        'index'=>'admin.users.index',
        'create'=>'admin.users.create',
        'store'=>'admin.users.store',
        'edit'=>'admin.users.edit'

    ]]);    


    Route::resource('admin/posts', 'AdminPostController',['names'=>[

        'index'=>'admin.posts.index',
        'create'=>'admin.posts.create',
        'store'=>'admin.posts.store',
        'edit'=>'admin.posts.edit',
        'show'=>'admin.posts.show'
        
    ]]);

    Route::resource('admin/categories', 'AdminCategoriesController',['names'=>[

        'index'=>'admin.categories.index',
        'create'=>'admin.categories.create',
        'store'=>'admin.categories.store',
        'edit'=>'admin.categories.edit',
        'show'=>'admin.categories.show'

    ]]);

    Route::resource('admin/media', 'AdminMediaController',['names'=>[

        'index'=>'admin.medias.index',
        'create'=>'admin.medias.create',
        'store'=>'admin.medias.store',
        'edit'=>'admin.medias.edit',
        'destroy'=>'admin.medias.destroy'

    ]]);

    Route::delete('admin/delete/media', 'AdminMediaController@deleteMedia');


    Route::resource('admin/comments', 'PostCommentsController',['names'=>[

        'index'=>'admin.comments.index',
        'create'=>'admin.comments.create',
        'store'=>'admin.comments.store',
        'edit'=>'admin.comments.edit',
        'show'=>'admin.comments.show'

    ]]);


    Route::resource('admin/comment/replies', 'CommentRepliesController',['names'=>[

        'index'=>'admin.replies.index',
        'create'=>'admin.replies.create',
        'createReply'=>'admin.replies.createReply',
        'store'=>'admin.replies.store',
        'edit'=>'admin.replies.edit',
        'show'=>'admin.replies.show'
    
    ]]);

});