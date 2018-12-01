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

Route::get('id/home', 'IdentityAndAccessController@index');

Route::get('id/logout', 'IdentityAndAccessController@logout');

Route::get('id/invitation', 'IdentityAndAccessController@showInvitationForm');

Route::post('id/invitation', 'IdentityAndAccessController@inviteCollaborator');

Route::get('id/create-subaccount', 'IdentityAndAccessController@createSubaccountForm');

Route::post('id/create-subaccount', 'IdentityAndAccessController@createSubaccount');

Route::get('id/block-subaccounts', 'IdentityAndAccessController@showBlockSubaccountForm');

Route::get('id/subaccounts/{tenantid}/{userid}', 'IdentityAndAccessController@getSubaccount');

Route::post('id/desable-user/tenant/{tenantid}/user/{userid}', 'IdentityAndAccessController@blockSubaccount');

Route::post('id/enable-user/tenant/{tenantid}/user/{userid}', 'IdentityAndAccessController@enableSubaccount');

Route::get('id/users/{userid}', 'IdentityAndAccessController@getUserById');



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///
///
///               WALLET
///
///
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('wallet/walets', 'WalletController@showTransactionMenu');
Route::get('wallet/topups/{userid}', 'WalletController@showTopupForm');
Route::post('wallet/topups', 'WalletController@makeTopup');
Route::post('wallet/cash-topups', 'WalletController@makeCashTopup');
Route::get('wallet/topups/subaccounts/{userid}', 'WalletController@getSubaccounts');
Route::get('wallet/topups/others/{userid}', 'WalletController@showTopupOtherForm');
Route::get('wallet/transferts/{userid}', 'WalletController@showTransfertForm');
Route::post('wallet/transferts', 'WalletController@makeTransfert');
Route::get('wallet/users/{tenant}', 'WalletController@getUserByTenant');
Route::get('wallet/mobilebillercreditaccounts/{n}', 'WalletController@getInfos');
Route::get('wallet/transactions/{userid}', 'WalletController@getTransactions');
Route::get('wallets/transactions/details/{transactionid}', 'WalletController@getTransactionDetails');




////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///
///
///           SERVICES
///
///
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


Route::get('services', 'FreeController@getServices');

Route::get('services/pay-step1', 'FreeController@getServicePaymentFormStep1');

Route::post('service/pay-step2', 'ServiceController@getServicePaymentFormStep2');

Route::get('services/{userid}', 'ServiceController@getServicesForAUser');

Route::get('services/{serviceid}/icon', 'FreeController@getIcon');

Route::get('/services/add/new', 'ServiceController@showCreateServiceForm');

Route::post('/services/add/new', 'ServiceController@addService');

Route::get('/parametrer-prix-service', 'ServiceController@showUnpricedServiceList');

Route::get('/services/{serviceid}/price', 'ServiceController@showPrarametrerPrixForm');

Route::post('/services/{serviceid}/price', 'ServiceController@defineServiceUnitPrice');





////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///
///
///
///              TICKETS
///
///
///
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


Route::get('tickets/tickets/{tenantid}/{userid}', 'ReceiptController@getTickets');









////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///
///
///
///              IAM CONTROLLER
///
///
///
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////









Route::get('tenants-that-matches-username/{username}', 'IdentityAndAccessReadController@getAllTenantHavingUserWithUsername');

Route::get('users/{invitationid}/registration-invitations/{tenantid}', 'FreeController@getTenantCollaboratorInvitation');

Route::post('users/{invitationid}/registration-invitations/{tenantid}', 'FreeController@registerInviterdUser');

Route::get('id/change-password', 'IdentityAndAccessController@showChangePasswordForm');

Route::post('id/change-password', 'IdentityAndAccessController@changePassword');

Route::get('id/reset-password', 'FreeController@showPasswordResetRequestForm');

Route::post('id/reset-password', 'FreeController@requestPasswordReset');

Route::get('users/{userid}/password-reset/{invitationid}', 'FreeController@showPasswordResetForm');

Route::post('users/{userid}/password-reset/{invitationid}', 'FreeController@resetPassword');


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///
///
///
///                 PRICING
///
///
///
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


Route::get('pricing/calculate-paid-service-price/{serviceid}/{quantity}', 'FreeController@getPrice');


Route::get('sms_regular_expressions', 'FreeController@sms_regular_expressions');



