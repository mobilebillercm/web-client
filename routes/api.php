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
















Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
