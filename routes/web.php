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

Route::get('/', 'UrlController@index')->name('home');;
Route::get('/{terse}', 'UrlController@verbose');

Route::get('/p/about', function() {
	return view('pages.about');
})->name('about');

Route::post('/terse', 'UrlController@terse');

$this->get('/p/login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('/p/login', 'Auth\LoginController@login');

$this->get('/p/logout', 'Auth\LoginController@logout');
$this->post('/p/logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('/p/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('p/register', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('p/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('p/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('p/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('p/password/reset', 'Auth\ResetPasswordController@reset');
