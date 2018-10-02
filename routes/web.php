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

Route::get('id/login', 'FreeController@showLoginForm')->name('login');
Route::post('id/login', 'FreeController@login');

Route::get('id/signup', 'FreeController@showSignupForm');
Route::post('id/signup', 'FreeController@signup');

Route::get('id/password-forgot', 'FreeController@showPasswordForgotForm');

Route::get('test-signup', 'FreeController@testSignup');


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
Route::get('wallet/walets', 'HomeController@showTransactionMenu');
Route::get('wallet/topups/{userid}', 'HomeController@showTopupForm');
Route::post('wallet/topups', 'HomeController@makeTopup');
Route::get('wallet/topups/subaccounts/{userid}', 'HomeController@getSubaccounts');
Route::get('wallet/topups/others/{userid}', 'HomeController@showTopupOtherForm');
Route::get('wallet/transferts/{userid}', 'HomeController@showTransfertForm');
Route::post('wallet/transferts', 'HomeController@makeTransfert');
Route::get('wallet/users/{tenant}', 'HomeController@getUserByTenant');
Route::get('wallet/mobilebillercreditaccounts/{n}', 'HomeController@getInfos');
Route::get('wallet/transactions/{userid}', 'HomeController@getTransactions');
Route::get('wallets/transactions/details/{transactionid}', 'HomeController@getTransactionDetails');




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



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///
///
///
///              TICKETS
///
///
///
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


Route::get('tickets/tickets/{userid}', 'HomeController@getTickets');
