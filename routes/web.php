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
    Route::get('/profils', 'Administration\ProfilsController@index');


    Route::group(['middleware' => ['role:sup_admin|admin']], function() {

        Route::group(['middleware' => ['permission:access_user_edit']], function(){
            Route::get('/users', 'Administration\UsersController@index');
            Route::post('/users/permissions/{user}', 'Administration\UsersController@assign_role');
        });


        Route::group(['middleware' => ['permission:access_role']], function(){
            Route::get('/roles', 'Administration\RolesController@index');
            Route::get('/roles/create', 'Administration\RolesController@create');
            Route::post('/roles/create', 'Administration\RolesController@store');
            Route::delete('/roles', 'Administration\RolesController@destroy');
            Route::get('/roles/edit-permission/{id}', 'Administration\RolesController@edit_permission');
            Route::put('/roles/edit-permission/{id}', 'Administration\RolesController@update_permission');
        });

        Route::group(['middleware' => ['permission:access_permission']], function(){
            Route::get('/permissions', 'Administration\PermissionsController@index');
            Route::get('/permissions/create', 'Administration\PermissionsController@create');
            Route::post('/permissions/create', 'Administration\PermissionsController@store');
            Route::delete('/permissions', 'Administration\PermissionsController@destroy');
        });

        Route::group(['middleware' => ['permission:access_securities']], function(){
            Route::get('securiter/accueil', 'Administration\SecuritiesController@index');
            Route::get('securiter/utilisateurs', 'Administration\SecuritiesController@user');
            Route::delete('securiter/login_connexion', 'Administration\SecuritiesController@drop_user_connexion');
        });

        Route::get('/forums', 'Administration\ChannelsController@index');

        Route::get('/forums/ajouter-sujet', [
            'middleware' => ['permission:add_thread_admin'],
            'uses' => 'Administration\ChannelsController@create']);
        Route::post('/forums/ajouter-sujet', [
            'middleware' => ['permission:add_thread_admin'],
            'uses' =>'Administration\ChannelsController@store']);
        Route::get('/forums/editer-sujet/{channel}', [
            'middleware' => ['permission:edit_thread_admin'],
            'uses' => 'Administration\ChannelsController@edit']);
        Route::put('/forums/editer-sujet/{channel}', [
            'middleware' => ['permission:edit_thread_admin'],
            'uses' => 'Administration\ChannelsController@update']);
        Route::get('/forums/activate', [
            'middleware' => ['permission:activate_forum'],
            'uses' => 'Administration\ChannelsController@activate_forum']);
        Route::get('/forums/desactivate', [
            'middleware' => ['permission:activate_forum'],
            'uses' =>'Administration\ChannelsController@desactivate_forum']);
        Route::post('/forums/add-categorie',  [
            'middleware' => ['permission:add_category_forum'],
            'uses' => 'Administration\ChannelsController@store_categorie']);
        Route::delete('/forums/supprimer-category/{category}', [
            'middleware' => ['permission:delete_category_forum'],
            'uses' => 'Administration\ChannelsController@destroy_category']);
        Route::delete('/forums/supprimer/{channel}', [
            'middleware' => ['permission:delete_channel'],
            'uses' => 'Administration\ChannelsController@destroy_channel']);

        Route::get('/channel/{channel}', 'Administration\ChannelsController@channel');
        Route::get('/thread/{thread}', 'Administration\ThreadsController@thread');
        Route::get('/thread/create/{channel}', 'Administration\ThreadsController@create');
        Route::put('/thread/create', 'Administration\ThreadsController@store');
        Route::delete('/thread/delete/{thread}', 'Administration\ThreadsController@destroy_thread');

        Route::get('/message/do_nothing/{msg}', 'Administration\MessagesController@do_nothing');
        Route::get('/message/do_moderate/{msg}', 'Administration\MessagesController@do_moderate');
        Route::put('/message/store_moderate/{msg}', 'Administration\MessagesController@store_moderate');
        Route::put('/message/lock/{msg}', 'Administration\MessagesController@lockMessages');
        Route::put('/message/unlock/{msg}', 'Administration\MessagesController@unlockMessages');

        Route::get('/jeux', 'Administration\GamesController@index');

        Route::get('mots-noir', [
            'middleware' => ['permission:list_blackWords'],
            'uses' => 'Administration\BlackWordsController@index']);
        Route::post('mots-noir', [
            'middleware' => ['permission:add_blackWords'],
            'uses' => 'Administration\BlackWordsController@store']);
        Route::delete('mots-noir', [
            'middleware' => ['permission:delete_blackWords'],
            'uses' => 'Administration\BlackWordsController@destroy']);
    });

});

Route::group(['prefix' => 'forum'], function(){
    Route::get('/', 'Pages\ForumsController@index');
    Route::get('/{channel}', 'Pages\ForumsController@channel');
    Route::get('/sujet/{thread_slug}', 'Pages\ForumsController@thread');
    Route::get('/sujet/alert/{message}', 'Pages\ForumsController@advertissement');

    Route::get('/nouveau-sujet/{channel}', ['middleware' => ['permission:add_thread'], 'uses' => 'Pages\ForumsController@create_thread']);
    Route::post('/nouveau-sujet', ['middleware' => ['permission:add_thread'], 'uses' => 'Pages\ForumsController@store_thread']);
    Route::get('/sujet/edit/{thread}', ['middleware' => ['permission:edit_thread'], 'uses' => 'Pages\ForumsController@edit_thread']);
    Route::put('/sujet/edit/{thread}', ['middleware' => ['permission:edit_thread'], 'uses' =>'Pages\ForumsController@update_thread']);
    Route::post('/answer/{thread_slug}', ['middleware' => ['permission:add_message'], 'uses' =>'Pages\ForumsController@answer']);
    Route::get('/sujet/edit-message/{message}', ['middleware' => ['permission:edit_message'], 'uses' =>'Pages\ForumsController@edit_message']);
    Route::put('/sujet/edit-message/{message}', ['middleware' => ['permission:edit_message'], 'uses' =>'Pages\ForumsController@update_message']);
});

Route::group(['prefix'=> 'api'], function(){
    Route::get('/markread', 'NotificationsController@__markread');
    Route::get('/destroyNotification', 'NotificationsController@destroyNotification');
});
