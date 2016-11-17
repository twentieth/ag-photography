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
/*
Route::get('/', function () {
    return view('welcome');
});
*/

/*
system
*/
Auth::routes();
Route::any('/', 'PhotosController@index')->name('index');
Route::get('/home', 'HomeController@index');


/*
ag-photography
*/
Route::any('/ag-photography', 'PhotosController@index')->name('index');

Route::any('/ag-photography/tag/{tag?}', 'PhotosController@index')->name('index');

Route::any('/ag-photography/contact', 'PhotosController@contact')->name('contact');

Route::any('/ag-photography/admin/uploadphoto', 'PhotosAdminController@uploadphoto')->name('uploadphoto')->middleware('auth');

Route::any('/ag-photography/admin/addtag', 'PhotosAdminController@addtag')->name('addtag')->middleware('auth');

Route::get('/ag-photography/admin/list', 'PhotosController@photoslist')->name('photoslist');

Route::get('/ag-photography/admin/photo/{id}', 'PhotosController@photo');

Route::get('/ag-photography/admin/logout', 'PhotosAdminController@logout')->name('logout');

Route::get('/ag-photography/admin/previous', 'PhotosAdminController@previous')->name('previous');


/*
tests
*/
Route::any('test', 'TestController@test');

Route::get('date', function(){
	return date('Y-m-d H:i:s');
});

Route::get('/sessions', 'TestController@sessions')->name('sessions');