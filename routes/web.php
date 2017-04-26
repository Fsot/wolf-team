<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/confirm/{id}/{token}', 'Auth\RegisterController@confirm');


Route::get('/profil/{username}', 'Pages\ProfilsController@index');
Route::get('/profil/edit/{username}', 'Pages\ProfilsController@edit');
Route::put('/profil/edit/{profil}', 'Pages\ProfilsController@update');



Route::get('/home', 'HomeController@index');




///// ROUTE ADMIN

Route::group(['prefix' => 'admin'], function() {
    Route::get('/users', 'Administration\UsersController@index');
    Route::get('/profils', 'Administration\ProfilsController@index');


    Route::group(['middleware' => ['role:sup_admin']], function() {
        Route::post('/users/permissions/{user}', 'Administration\UsersController@assign_role');
        Route::get('/roles', 'Administration\RolesController@index');
        Route::get('/role/create', 'Administration\RolesController@create');
        Route::post('/role/create', 'Administration\RolesController@store');
        Route::delete('/role', 'Administration\RolesController@destroy');
        Route::get('/role/edit-permission/{id}', 'Administration\RolesController@edit_permission');
        Route::put('/role/edit-permission/{id}', 'Administration\RolesController@update_permission');

        Route::get('/permissions', 'Administration\PermissionsController@index');
        Route::get('/permission/create', 'Administration\PermissionsController@create');
        Route::post('/permission/create', 'Administration\PermissionsController@store');
        Route::delete('/permission', 'Administration\PermissionsController@destroy');

        Route::get('/forums', 'Administration\ChannelsController@index');
        Route::get('/forums/ajouter-sujet', 'Administration\ChannelsController@create');
        Route::post('/forums/ajouter-sujet', 'Administration\ChannelsController@store');
        Route::get('/forums/editer-sujet/{channel}', 'Administration\ChannelsController@edit');
        Route::put('/forums/editer-sujet/{channel}', 'Administration\ChannelsController@update');
        Route::get('/forum/activate', 'Administration\ChannelsController@activate_forum');
        Route::get('/forum/desactivate', 'Administration\ChannelsController@desactivate_forum');
        Route::post('/forum/add-categorie', 'Administration\ChannelsController@store_categorie');

        Route::get('/channel/{channel}', 'Administration\ChannelsController@channel');
        Route::get('/thread/{thread}', 'Administration\ThreadsController@thread');


        Route::get('/message/do_nothing/{msg}', 'Administration\MessagesController@do_nothing');
        Route::get('/message/do_moderate/{msg}', 'Administration\MessagesController@do_moderate');
        Route::put('/message/store_moderate/{msg}', 'Administration\MessagesController@store_moderate');
    });
});

Route::group(['prefix' => 'forum'], function(){
    Route::get('/', 'Pages\ForumsController@index');
    Route::get('/sujet/{channel}', 'Pages\ForumsController@channel');
    Route::get('/nouveau-sujet/{channel}', 'Pages\ForumsController@create_thread');
    Route::post('/nouveau-sujet', 'Pages\ForumsController@store_thread');
    Route::get('/{thread_slug}', 'Pages\ForumsController@thread');
    Route::post('/answer/{thread_slug}', 'Pages\ForumsController@answer');
    Route::get('/sujet/edit/{thread}', 'Pages\ForumsController@edit_thread');
    Route::put('/sujet/edit/{thread}', 'Pages\ForumsController@update_thread');
    Route::get('/sujet/edit-message/{message}', 'Pages\ForumsController@edit_message');
    Route::put('/sujet/edit-message/{message}', 'Pages\ForumsController@update_message');
    Route::get('/sujet/alert/{message}', 'Pages\ForumsController@advertissement');
});
