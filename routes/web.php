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

Auth::routes();
Route::any('/', 'PhotosController@index')->name('home');
Route::get('/home', 'HomeController@index');


/*
ag-photography
 */
Route::any('/ag-photography', 'PhotosController@index')->name('ag-photography');

Route::any('/ag-photography/tag/{tag?}', 'PhotosController@index')->name('tag');

Route::get('/ag-photography/contact_form', 'ContactController@contactForm')->name('contactForm');
Route::post('/ag-photography/contact_send', 'ContactController@contactSend')->name('contactSend');

Route::get('/ag-photography/admin/uploadphoto/', 'PhotosAdminController@uploadphoto')->name('uploadphoto')->middleware('auth');
Route::get('/ag-photography/admin/updatephoto/{id}', 'PhotosAdminController@updatephoto')->name('updatephoto')->middleware('auth');
Route::post('/ag-photography/admin/upload/{id?}', 'PhotosAdminController@upload')->name('upload')->middleware('auth');

Route::any('/ag-photography/admin/addtag', 'PhotosAdminController@addtag')->name('addtag')->middleware('auth');

Route::get('/ag-photography/previous', 'PhotosController@previous')->name('previous');

Route::get('/ag-photography/login', 'Auth\LoginController@showLoginForm');
Route::get('/ag-photography/register', 'Auth\RegisterController@showRegistrationForm');
Route::get('/ag-photography/logout', 'PhotosController@logout')->name('logout');

Route::get('/ag-photography/admin/photoslist/{search?}', 'PhotosAdminController@photoslist')->name('photoslist')->middleware('auth');
