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
Route::any('test', 'TestController@test');

Auth::routes();

Route::get('date', function(){
	return date('Y-m-d H:i:s');
});

Route::get('/home', 'HomeController@index');

Route::any('/photos/index/{tag?}', 'PhotosController@index')->name('index');

Route::any('/photos/contact', 'PhotosController@contact')->name('contact');

Route::any('/photos/admin/uploadphoto', 'PhotosAdminController@uploadphoto')->name('uploadphoto')->middleware('auth');

Route::any('/photos/admin/addtag', 'PhotosAdminController@addtag')->name('addtag')->middleware('auth');

Route::get('/photos/admin/list', 'PhotosController@photoslist')->name('photoslist');

Route::get('/photos/admin/photo/{id}', 'PhotosController@photo');

Route::get('/sessions', 'TestController@sessions')->name('sessions');

Route::get('/photos/admin/logout', 'PhotosAdminController@logout')->name('logout');

Route::get('/photos/admin/previous', 'PhotosAdminController@previous')->name('previous');