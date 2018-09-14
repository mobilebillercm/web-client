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


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///
///
///                FREECONTROLLER
///
///
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::get('/', 'FreeController@welcome');

Route::get('/login', 'FreeController@showLoginForm');
Route::post('/login', 'FreeController@login');

Route::get('/signup', 'FreeController@showSignupForm');

Route::get('/password-forgot', 'FreeController@showPasswordForgotForm');



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///
///
///                HOMECONTROLLER
///
///
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::get('/home', 'HomeController@index');

Route::get('/logout', 'HomeController@logout');