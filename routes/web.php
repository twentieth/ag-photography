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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('date', function(){
	return date('Y-m-d H:i:s');
});

Route::get('/home', 'HomeController@index');

Route::any('/admin/photos/upload', 'FormsController@uploadphoto')->name('uploadphoto');

Route::any('/admin/tags/add', 'FormsController@addtag')->name('addtag');

Route::get('/admin/photos/list', 'PhotosController@photoslist')->name('photoslist');

Route::get('/admin/photos/photo/{id}', 'PhotosController@photo');

Route::get('/sessions', 'TestController@sessions')->name('sessions');