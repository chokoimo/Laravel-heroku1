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
//Route::group(['prefix' => 'admin'], function() {
    //Route::get('news/create', 'Admin\NewsController@add');
//});
//課題3
//Route::group(['prefix'=>'admin'],function() {
  //Route::get('xxx','Admin\AAAController@bbb');
//});

//Route::group(['prefix'=>'admin'], function() {
  //Route::get('profile/create','Admin\ProfileController@add');
  //Route::get('profile/edit','Admin\ProfileController@edit');
//});


//Auth::routes();


//Route::get('/home', 'HomeController@index')->name('home');
//Route::group(['prefix' => 'admin'], function() {
    //Route::get('profile/create', 'Admin\ProfileController@add')->middleware('auth');
//});
//Route::get('/home', 'HomeController@index')->name('home');
//Route::group(['prefix' => 'admin'], function() {
    //Route::get('profile/edit', 'Admin\ProfileController@edit')->middleware('auth');
//});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
     Route::get('news/create', 'Admin\NewsController@add');
     Route::post('news/create', 'Admin\NewsController@create'); 
     
     Route::get('profile/create','Admin\ProfileController@add');//Laravel13　課題2
     Route::post('profile/create' ,'Admin\ProfileController@create');//Laravel13　課題2
     
     Route::get('profile/edit', 'Admin\ProfileController@edit');//Laravel13　課題6
     Route::post('profile/edit' ,'Admin\ProfileController@update');//Laravel13　課題6
     Route::get('profile/delete', 'Admin\ProfileController@delete');//Laravel　17
     
     Route::get('news', 'Admin\NewsController@index');//Laravel 15
     Route::get('profile', 'Admin\ProfileController@index');//Laravel 17
     
     Route::get('news/edit', 'Admin\NewsController@edit');//Laravel 16
     Route::post('news/edit', 'Admin\NewsController@update');//Laravel 16
     Route::get('news/delete', 'Admin\NewsController@delete');//Laravel 16
     
     
     
});
Route::get('/', 'NewsController@index');
Route::get('/profile', 'ProfileController@index');