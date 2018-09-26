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

Route::get('id/login', 'FreeController@showLoginForm');
Route::post('id/login', 'FreeController@login');

Route::get('id/signup', 'FreeController@showSignupForm');

Route::get('id/password-forgot', 'FreeController@showPasswordForgotForm');



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///
///
///                HOMECONTROLLER
///
///
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::get('id/home', 'HomeController@index');

Route::get('id/logout', 'HomeController@logout');

Route::get('id/invitation', 'HomeController@showInvitationForm');





////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///
///
///               WALLET
///
///
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('wallet/walet', 'HomeController@showTransactionMenu');
Route::get('wallet/topup/{userid}', 'HomeController@showTransactionForm');
Route::post('wallet/topup/{userid}', 'HomeController@makeTopup');
Route::get('wallet/mobilebillercreditaccounts/{n}', 'HomeController@getInfos');



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///
///
///           SERVICES
///
///
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


Route::get('services', 'FreeController@getServices');

Route::get('services/pay-step1', 'FreeController@getServicePaymentFormStep1');

Route::post('service/pay-step2', 'HomeController@getServicePaymentFormStep2');

Route::get('services/{userid}', 'HomeController@getServicesForAUser');

Route::get('services/{serviceid}/icon', 'FreeController@getIcon');
