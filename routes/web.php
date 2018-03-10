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

Route::get('/', 'UrlController@index');
Route::get('/{terse}', 'UrlController@verbose');

Route::get('/p/about', function() {
	return view('pages.about');
});
Route::post('/terse', 'UrlController@terse');
