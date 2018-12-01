<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('tenants/{username}', 'ApiController@getTenantByUsername');


///From external systems
Route::post('tenant-provisions', 'ApiController@provisionTenant')->middleware('rabbitmq.client');

Route::post('tenant-collaborators-invitations', 'ApiController@registerTenantCollaboratorInvitation')->middleware('rabbitmq.client');

Route::post('tenant-collaborators-registrations', 'ApiController@registerTenantCollaboratorRegistered')->middleware('rabbitmq.client');


//tenant-collaborator-register


Route::post('service_with_no_unit_price_assigned', 'ApiController@addServiceWithNoUnitPriceAssigned');

Route::post('services', 'ApiController@addService');


//Wallet

Route::post('mobile-credit-accounts', 'ApiController@createMobileCreditAccount');
 
Route::post('cash-topup', 'ApiController@topupCash');

Route::post('transfert_operation_created', 'ApiController@saveTransfertOperation');

Route::post('payement-with-mobile-biller-credit-acount-made', 'ApiController@savePayementOperationWithMobileBillerCreditAccount')->middleware('rabbitmq.client');


//receipts

Route::post('register-receipt', 'ApiController@registerReceipt')->middleware('rabbitmq.client');
Route::post('register-bulk-receipt', 'ApiController@registerBulkReceipt')->middleware('rabbitmq.client');


//service access
Route::post('register-service-access', 'ApiController@saveServiceAccess')->middleware('rabbitmq.client');


//identity and access
Route::post('change-user-password', 'ApiController@changePassword')->middleware('rabbitmq.client');

Route::get('services/{userid}/', 'ApiController@getServicesForAUser')->middleware('android.client');














Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
