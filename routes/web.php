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

