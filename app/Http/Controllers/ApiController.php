<?php

namespace App\Http\Controllers;

use App\domain\GlobalDbRecordCounter;
use App\domain\GlobalDtoValidator;
use App\domain\GlobalResultHandler;
use App\domain\model\ClientServiceValidity;
use App\domain\model\Receipt;
use App\domain\model\Service;
use App\domain\model\ServiceWithNoUnitPriceAssigned;
use App\domain\model\MobileBillerCreditAccountTransactionView;
use App\domain\model\TransactionDetail;
use App\MobileBillerCreditAccountView;
use App\TenantCollaboratorsRegistrationInvitationsView;
use App\TenantView;
use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;


class ApiController extends Controller
{

    public function provisionTenant(){



        $userToRegisterJsonString = file_get_contents('php://input');
        $userToRegisterArray =  json_decode($userToRegisterJsonString, true);

        $tenant =  $userToRegisterArray['tenant'];
        $adminuser =  $userToRegisterArray['adminuser'];

        DB::beginTransaction();

        try{



            $userToSave = new User(
                $adminuser['userid'],
                $adminuser['firstname'],
                $adminuser['lastname'],
                $adminuser['email'],
                $adminuser['username'],
                $adminuser['tenantid'],
                $tenant['name'],
                $adminuser['parent'],
                Hash::make($adminuser['password']),
                '[]',
                null,
                null
            );

	    $tenantToSave = new TenantView(
                $tenant['tenantid'],
                $tenant['name'],
                $tenant['city'],
                $tenant['region'],
                $tenant['description'],
                $tenant['logo'],
                $tenant['enablement'],
                json_encode(array($userToSave)),
                $tenant['taxpayernumber'],
                $tenant['numbertraderegister']
            );



            $userToSave->save();
            $tenantToSave->save();

        }catch (\Exception $e){

            DB::rollBack();

            return response(GlobalResultHandler::buildFaillureReasonArray('Tenant View Projection KO'), 200);

        }

        DB::commit();

        return response(GlobalResultHandler::buildSuccesResponseArray('Tenant View Projection OK'), 200);


    }

    public function registerTenantCollaboratorRegistered(){

        $userJsonString = file_get_contents('php://input');
 
	$fp = fopen('a1.txt', 'w');
	fprintf($fp, '%s', $userJsonString);
	fclose($fp);
       $userArray =  json_decode($userJsonString , true);

        $validator = Validator::make($userArray,
            [
                'userid'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'tenantid'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'firstname'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'lastname'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'email'=>'required|email|max:150',
                'phone' => ['required', 'regex:/^(22|23|24|67|69|65|68|66)[0-9]{7}$/'],
                'parent'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'enablement'=>GlobalDtoValidator::requireInteger(),
            ]);

        if($validator->fails())
        {
            return GlobalResultHandler::buildFaillureReasonArray($validator->errors()->first());
        }

        DB::beginTransaction();

        try{


            $invitations = TenantCollaboratorsRegistrationInvitationsView::where('userid', '=', $userArray['userid'])->get();
	    if ((count($invitations) === 1)){
                $invitation = $invitations[0];
                $invitation->active = 0;
		$invitation->save();
                //return GlobalResultHandler::buildFaillureReasonArray("Something went wrong");
            }

            $userToSave = new User(
                $userArray['userid'],
                $userArray['firstname'],
                $userArray['lastname'],
                $userArray['email'],
                $userArray['username'],
                $userArray['tenantid'],
                $userArray['tenantname'],
                $userArray['parent'],
                Hash::make($userArray['password']),
                '[]',
                null,
                null
            );


           // $invitation->save();
            $userToSave->save();



        }catch (\Exception $e){

            DB::rollBack();

            return response(GlobalResultHandler::buildFaillureReasonArray('Something went wrong '.$e->getMessage()), 200);

        }

        DB::commit();

        return response(GlobalResultHandler::buildSuccesResponseArray('User created successfully'), 200);

    }

    public function registerTenantCollaboratorInvitation(){
        $userJsonString = file_get_contents('php://input');
        $userArray =  json_decode($userJsonString , true);

        $validator = Validator::make($userArray,
            [
                'userid'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'tenantid'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'firstname'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'lastname'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'email'=>'required|email|max:150',
                'phone' => ['required', 'regex:/^(22|23|24|67|69|65|68|66)[0-9]{7}$/'],
                'invited_by'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'invited_at'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'url'=>GlobalDtoValidator::requireStringMinMax(1, 5000),
                'active'=>GlobalDtoValidator::requireInteger(),
            ]);

        if($validator->fails())
        {
            return GlobalResultHandler::buildFaillureReasonArray($validator->errors()->first());
        }

        DB::beginTransaction();

        try{



            $tenantCollaboratorsRegistrationInvitationsView = new TenantCollaboratorsRegistrationInvitationsView(
                $userArray['userid'],
                $userArray['tenantid'],
                $userArray['firstname'],
                $userArray['lastname'],
                $userArray['email'],
                $userArray['phone'],
                $userArray['invited_by'],
                $userArray['invited_at'],
                $userArray['url'],
                $userArray['active']
            );


            $tenantCollaboratorsRegistrationInvitationsView->save();

        }catch (\Exception $e){

            DB::rollBack();

            return response(GlobalResultHandler::buildFaillureReasonArray('Something went wrong '.$e->getMessage()), 200);

        }

        DB::commit();

        return response(GlobalResultHandler::buildSuccesResponseArray('User created successfully'), 200);
    }

    public function addServiceWithNoUnitPriceAssigned(){

        $serviceJsonString = file_get_contents('php://input');
        $serviceArray =  json_decode($serviceJsonString , true);

        $validator = Validator::make($serviceArray,
            [
                'b_id'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'name'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'description'=>GlobalDtoValidator::requireStringMinMax(1, 5000)
            ]);

        if($validator->fails())
        {
            return GlobalResultHandler::buildFaillureReasonArray($validator->errors()->first());
        }

        DB::beginTransaction();

        try{

            $service = new ServiceWithNoUnitPriceAssigned(
                $serviceArray['b_id'],
                $serviceArray['name'],
                $serviceArray['description']
            );

            $service->save();

        }catch (\Exception $e){

            DB::rollBack();

            return response(GlobalResultHandler::buildFaillureReasonArray('Something went wrong '.$e->getMessage()), 200);

        }

        DB::commit();

        return response(GlobalResultHandler::buildSuccesResponseArray('Service Saved successfully'), 200);
    }

    public function addService(){

        $serviceJsonString = file_get_contents('php://input');
        $serviceArray =  json_decode($serviceJsonString , true);


        $validator = Validator::make($serviceArray,
            [
                'serviceid'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'name'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'description'=>GlobalDtoValidator::requireStringMinMax(1, 5000),
                'unit'=>GlobalDtoValidator::requireStringMinMax(1, 5000),
                'amount'=>'required',
                'currency'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'unitquantityintervaldiscountsactors'=>'required'
            ]);

        if($validator->fails())
        {
            return GlobalResultHandler::buildFaillureReasonArray($validator->errors()->first());
        }

        DB::beginTransaction();

        try{

            $service = new Service(
                $serviceArray['serviceid'],
                $serviceArray['name'],
                $serviceArray['description'],
                $serviceArray['description'],
                $serviceArray['amount'],
                $serviceArray['currency'],
                $serviceArray['unit'],
                $serviceArray['unitquantityintervaldiscountsactors'],
                null
            );


            $client = new Client();

            $token = null;

            try {


               // return __DIR__.'/../../Infrastructure/Messaging/global-var-config.ini';

                $tokenUrl = env('HOST_SERVICES') . '/oauth/token';


                $tokenData = $client->post($tokenUrl, [
                    'form_params' => [
                        'grant_type' => 'client_credentials',
                        'client_id' => env('HOST_SERVICE_CLIENT_ID'),//parse_ini_file(__DIR__.'/../../Infrastructure/Messaging/global-var-config.ini', true)['LOGINS']['HOST_SERVICE_CLIENT_ID'],
                        'client_secret' => env('HOST_SERVICE_CLIENT_SECRET')//parse_ini_file(__DIR__.'/../../Infrastructure/Messaging/global-var-config.ini', true)['LOGINS']['HOST_SERVICE_CLIENT_SECRET'],
                    ],
                ]);

                $token = json_decode((string)$tokenData->getBody());

                $url = env('HOST_SERVICES').'/api/services/'.$serviceArray['serviceid'].'/icon';
                $res = $client->get($url, [
                    'headers' => [
                        'Authorization' => $token->access_token,
                    ]
                ]);

                $service->icon = $res->getBody();

                $service->save();


            } catch (BadResponseException $e) {

                return $e->getMessage();

            }

        }catch (\Exception $e){

            DB::rollBack();

            return response(GlobalResultHandler::buildFaillureReasonArray('Something went wrong '.$e->getMessage()), 200);

        }

        DB::commit();

        return response(GlobalResultHandler::buildSuccesResponseArray('User created successfully'), 200);
    }

    public function topupCash(){


        $cashTopupJsonString = file_get_contents('php://input');
        $cashTopupJsonStringArray = json_decode($cashTopupJsonString , true);


        $mobileCreditAccountToTopup =  $cashTopupJsonStringArray['mobilebillercreditaccount'];
        $transactions =  $cashTopupJsonStringArray['transactions'];




        $mobileCreditAccountValidatoralidator = Validator::make($mobileCreditAccountToTopup,
            [
                'b_id'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'accountnumber'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'holder'=>GlobalDtoValidator::requireStringMinMax(1, 5000),
                'balance'=>GlobalDtoValidator::requireNumeric()
            ]);

        $transactionValidatoralidator0 = Validator::make($transactions[0],
            [
                'b_id'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'date'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'mobilebillercreditaccount'=>GlobalDtoValidator::requireStringMinMax(1, 5000),
                'made_by'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'amount'=>GlobalDtoValidator::requireNumeric(),
                'transaction_type'=>GlobalDtoValidator::requireStringMinMax(1, 50),
                'transaction_details'=>GlobalDtoValidator::requireStringMinMax(1, 5000),
                'user_transaction_number'=>GlobalDtoValidator::requireInteger(),
                'state'=>GlobalDtoValidator::requireStringMinMax(1, 50),
                'accountstate'=>GlobalDtoValidator::required(),
            ]);

        $transactionValidatoralidator1 = Validator::make($transactions[1],
            [
                'b_id'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'date'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'mobilebillercreditaccount'=>GlobalDtoValidator::requireStringMinMax(1, 5000),
                'made_by'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'amount'=>GlobalDtoValidator::requireNumeric(),
                'transaction_type'=>GlobalDtoValidator::requireStringMinMax(1, 50),
                'transaction_details'=>GlobalDtoValidator::requireStringMinMax(1, 5000),
                'user_transaction_number'=>GlobalDtoValidator::requireInteger(),
                'state'=>GlobalDtoValidator::requireStringMinMax(1, 50),
                'accountstate'=>GlobalDtoValidator::required(),
            ]);


        if($mobileCreditAccountValidatoralidator->fails())
        {
            return GlobalResultHandler::buildFaillureReasonArray($mobileCreditAccountValidatoralidator->errors()->first());
        }

        if($transactionValidatoralidator0->fails())
        {
            return GlobalResultHandler::buildFaillureReasonArray($transactionValidatoralidator0->errors()->first());
        }

        if($transactionValidatoralidator1->fails())
        {
            return GlobalResultHandler::buildFaillureReasonArray($transactionValidatoralidator1->errors()->first());
        }

        DB::beginTransaction();

        try{

            $mobileBillerCreditAccountViews = MobileBillerCreditAccountView::where('b_id', '=', $mobileCreditAccountToTopup['b_id'])->
            where('accountnumber', '=', $mobileCreditAccountToTopup['accountnumber'])->where('holder', '=', $mobileCreditAccountToTopup['holder'])->get();

            if(!GlobalDbRecordCounter::countDbRecordIsExactlelOne($mobileBillerCreditAccountViews)){
                return response(GlobalResultHandler::buildFaillureReasonArray('User mobile credit account not found'), 200);
            }


            $mobileBillerCreditAccountViews[0]->balance = $mobileCreditAccountToTopup['balance'];

            $mobileBillerCreditAccountViews[0]->save();


            $transactionDetailsObject0 = json_decode($transactions[0]['transaction_details'], true);

            $transactionDetails0 = new TransactionDetail($transactionDetailsObject0['made_by'], $transactionDetailsObject0['account_number'],
                $transactionDetailsObject0['account_holder'],  $transactionDetailsObject0['account_security_code'],
                $transactionDetailsObject0['account_type'], $transactionDetailsObject0['beneficiary'], $transactionDetailsObject0['transactionType']);


            $transactionDetailsObject1 = json_decode($transactions[1]['transaction_details'], true);

            $transactionDetails1 = new TransactionDetail($transactionDetailsObject1['made_by'], $transactionDetailsObject1['account_number'],
                $transactionDetailsObject1['account_holder'],  $transactionDetailsObject1['account_security_code'],
                $transactionDetailsObject1['account_type'], $transactionDetailsObject1['beneficiary'], $transactionDetailsObject1['transactionType']);
            //return json_encode($transactionDetailsObject);

            $mobileBillerCreditAccountTransactionView0 = new MobileBillerCreditAccountTransactionView(
                $transactions[0]['b_id'],
                $transactions[0]['date'],
                $transactions[0]['mobilebillercreditaccount'],
                $transactions[0]['made_by'],
                $transactions[0]['amount'],
                $transactions[0]['transaction_type'],
                $transactionDetails0,
                $transactions[0]['user_transaction_number'],
                $transactions[0]['state'],
                $transactions[0]['returned_result'],
                $transactions[0]['accountstate']

            );

            $mobileBillerCreditAccountTransactionView0->save();

            $mobileBillerCreditAccountTransactionView1 = new MobileBillerCreditAccountTransactionView(
                $transactions[1]['b_id'],
                $transactions[1]['date'],
                $transactions[1]['mobilebillercreditaccount'],
                $transactions[1]['made_by'],
                $transactions[1]['amount'],
                $transactions[1]['transaction_type'],
                $transactionDetails1,
                $transactions[1]['user_transaction_number'],
                $transactions[1]['state'],
                $transactions[1]['returned_result'],
                $transactions[1]['accountstate']

            );

            $mobileBillerCreditAccountTransactionView1->save();


        }catch (\Exception $e){

            DB::rollBack();

            return response(GlobalResultHandler::buildFaillureReasonArray('Unable register cash topup '.$e->getMessage()), 200);

        }

        DB::commit();

        return response(GlobalResultHandler::buildSuccesResponseArray('Cash topup registered successfully'), 200);


    }

    public function createMobileCreditAccount(){


        $mobileCreditAccountToCreateJsonString = file_get_contents('php://input');
        $mobileCreditAccountToCreateArray =  json_decode($mobileCreditAccountToCreateJsonString , true);



        //return $mobileCreditAccountToCreateArray;

        $validator = Validator::make($mobileCreditAccountToCreateArray,
            [
                'b_id'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'accountnumber'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'holder'=>GlobalDtoValidator::requireStringMinMax(1, 5000),
                'balance'=>GlobalDtoValidator::requireNumeric(),
                'issuer'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'active'=>GlobalDtoValidator::requireInteger(),
                'currency'=>GlobalDtoValidator::requireStringMinMax(1, 150),
            ]);

        if($validator->fails())
        {
            return GlobalResultHandler::buildFaillureReasonArray($validator->errors()->first());
        }

        DB::beginTransaction();

        try{


            //return '\n'.$mobileCreditAccountToCreateArray['currency'];

            $mobileBillerCreditAccount = new MobileBillerCreditAccountView(
                $mobileCreditAccountToCreateArray['b_id'],
                $mobileCreditAccountToCreateArray['accountnumber'],
                $mobileCreditAccountToCreateArray['holder'],
                $mobileCreditAccountToCreateArray['balance'],
                $mobileCreditAccountToCreateArray['photo'],
                $mobileCreditAccountToCreateArray['issuer'],
                $mobileCreditAccountToCreateArray['active'],
                $mobileCreditAccountToCreateArray['currency']);


            //return 'Nkalla'.json_encode($mobileBillerCreditAccount);

            $mobileBillerCreditAccount->save();

        }catch (\Exception $e){


            //return 'In try';


            DB::rollBack();

            return response(GlobalResultHandler::buildFaillureReasonArray('Unable to user mobile biller credit account '.$e->getMessage()), 200);

        }

        DB::commit();

        return response(GlobalResultHandler::buildSuccesResponseArray('User mobile biller credit account created successfully'), 200);

    }

    public function saveTransfertOperation(){
        $transfertOperationString = file_get_contents('php://input');
        $transfertOperationArray = json_decode($transfertOperationString , true);
        $sourceAccount = $transfertOperationArray['sourceaccount'];
        $destinationAccount = $transfertOperationArray['destinationaccount'];
        $sourceTransaction = $transfertOperationArray['sourcetransaction'];
        $destinationTransaction = $transfertOperationArray['destinationtransaction'];

        $validatorSrcAccount = Validator::make($sourceAccount,
            [
                'b_id'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'accountnumber'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'holder'=>GlobalDtoValidator::requireStringMinMax(1, 5000),
                'balance'=>GlobalDtoValidator::requireNumeric(),
                'issuer'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'active'=>GlobalDtoValidator::requireInteger(),
                'currency'=>GlobalDtoValidator::requireStringMinMax(1, 150),
            ]);

        if($validatorSrcAccount->fails())
        {
            return GlobalResultHandler::buildFaillureReasonArray($validatorSrcAccount->errors()->first());
        }


        $validatorDestAccount = Validator::make($destinationAccount,
            [
                'b_id'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'accountnumber'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'holder'=>GlobalDtoValidator::requireStringMinMax(1, 5000),
                'balance'=>GlobalDtoValidator::requireNumeric(),
                'issuer'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'active'=>GlobalDtoValidator::requireInteger(),
                'currency'=>GlobalDtoValidator::requireStringMinMax(1, 150),
            ]);

        if($validatorDestAccount->fails())
        {
            return GlobalResultHandler::buildFaillureReasonArray($validatorDestAccount->errors()->first());
        }


        $transactionSrcValidator = Validator::make($sourceTransaction,
            [
                'b_id'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'date'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'mobilebillercreditaccount'=>GlobalDtoValidator::requireStringMinMax(1, 5000),
                'made_by'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'amount'=>GlobalDtoValidator::requireNumeric(),
                'transaction_type'=>GlobalDtoValidator::requireStringMinMax(1, 50),
                'transaction_details'=>GlobalDtoValidator::requireStringMinMax(1, 5000),
                'user_transaction_number'=>GlobalDtoValidator::requireInteger(),
                'state'=>GlobalDtoValidator::requireStringMinMax(1, 50),
                'accountstate'=>GlobalDtoValidator::required(),
            ]);

        if($transactionSrcValidator->fails())
        {
            return GlobalResultHandler::buildFaillureReasonArray($transactionSrcValidator->errors()->first());
        }

        $transactionDestValidator = Validator::make($destinationTransaction,
            [
                'b_id'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'date'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'mobilebillercreditaccount'=>GlobalDtoValidator::requireStringMinMax(1, 5000),
                'made_by'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'amount'=>GlobalDtoValidator::requireNumeric(),
                'transaction_type'=>GlobalDtoValidator::requireStringMinMax(1, 50),
                'transaction_details'=>GlobalDtoValidator::requireStringMinMax(1, 5000),
                'user_transaction_number'=>GlobalDtoValidator::requireInteger(),
                'state'=>GlobalDtoValidator::requireStringMinMax(1, 50),
                'accountstate'=>GlobalDtoValidator::required(),
            ]);

        if($transactionDestValidator->fails())
        {
            return GlobalResultHandler::buildFaillureReasonArray($transactionDestValidator->errors()->first());
        }


        DB::beginTransaction();

        try{


            $mobileBillerCreditAccountViewsSrc = MobileBillerCreditAccountView::where('b_id', '=', $sourceAccount['b_id'])->
            where('accountnumber', '=', $sourceAccount['accountnumber'])->where('holder', '=', $sourceAccount['holder'])->get();

            if(!GlobalDbRecordCounter::countDbRecordIsExactlelOne($mobileBillerCreditAccountViewsSrc)){
                return response(GlobalResultHandler::buildFaillureReasonArray('User mobile credit account not found'), 200);
            }


            $mobileBillerCreditAccountViewsSrc[0]->balance = $sourceAccount['balance'];

            $mobileBillerCreditAccountViewsSrc[0]->save();

            $mobileBillerCreditAccountViewsDest = MobileBillerCreditAccountView::where('b_id', '=', $destinationAccount['b_id'])->
            where('accountnumber', '=', $destinationAccount['accountnumber'])->where('holder', '=', $destinationAccount['holder'])->get();

            if(!GlobalDbRecordCounter::countDbRecordIsExactlelOne($mobileBillerCreditAccountViewsDest)){
                return response(GlobalResultHandler::buildFaillureReasonArray('User mobile credit account not found'), 200);
            }


            $mobileBillerCreditAccountViewsDest[0]->balance = $destinationAccount['balance'];

            $mobileBillerCreditAccountViewsDest[0]->save();

            $transactionDetailsObjectSrc = json_decode($sourceTransaction['transaction_details'], true);

            $transactionDetailsSrc = new TransactionDetail($transactionDetailsObjectSrc['made_by'], $transactionDetailsObjectSrc['account_number'],
                $transactionDetailsObjectSrc['account_holder'],  $transactionDetailsObjectSrc['account_security_code'],
                $transactionDetailsObjectSrc['account_type'], $transactionDetailsObjectSrc['beneficiary'], $transactionDetailsObjectSrc['transactionType']);

            $mobileBillerCreditAccountTransactionViewSrc = new MobileBillerCreditAccountTransactionView(
                $sourceTransaction['b_id'],
                $sourceTransaction['date'],
                $sourceTransaction['mobilebillercreditaccount'],
                $sourceTransaction['made_by'],
                $sourceTransaction['amount'],
                $sourceTransaction['transaction_type'],
                $transactionDetailsSrc,
                $sourceTransaction['user_transaction_number'],
                $sourceTransaction['state'],
                $sourceTransaction['returned_result'],
                $sourceTransaction['accountstate']

            );

            $mobileBillerCreditAccountTransactionViewSrc->save();


            $transactionDetailsObjectDest = json_decode($destinationTransaction['transaction_details'], true);

            $transactionDetailsDest = new TransactionDetail($transactionDetailsObjectDest['made_by'], $transactionDetailsObjectDest['account_number'],
                $transactionDetailsObjectDest['account_holder'],  $transactionDetailsObjectDest['account_security_code'],
                $transactionDetailsObjectDest['account_type'], $transactionDetailsObjectDest['beneficiary'], $transactionDetailsObjectDest['transactionType']);

            $mobileBillerCreditAccountTransactionViewDest = new MobileBillerCreditAccountTransactionView(
                $destinationTransaction['b_id'],
                $destinationTransaction['date'],
                $destinationTransaction['mobilebillercreditaccount'],
                $destinationTransaction['made_by'],
                $destinationTransaction['amount'],
                $destinationTransaction['transaction_type'],
                $transactionDetailsDest,
                $destinationTransaction['user_transaction_number'],
                $destinationTransaction['state'],
                $destinationTransaction['returned_result'],
                $destinationTransaction['accountstate']

            );

            $mobileBillerCreditAccountTransactionViewDest->save();
        }catch (\Exception $e){

            DB::rollBack();

            return response(GlobalResultHandler::buildFaillureReasonArray('Unable to save transfert operation '.$e->getMessage()), 200);

        }

        DB::commit();

        return response(GlobalResultHandler::buildSuccesResponseArray('Transfert Operation Saved successfully'), 200);
    }

    public function savePayementOperationWithMobileBillerCreditAccount(){

        $paymentOperationString = file_get_contents('php://input');

        $paymentOperationArray = json_decode($paymentOperationString , true);

        $sourceAccount = $paymentOperationArray['mobilebillercreditaccount'];
        $sourceTransaction = $paymentOperationArray['transaction'];


        $validatorSrcAccount = Validator::make($sourceAccount,
            [
                'b_id'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'accountnumber'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'holder'=>GlobalDtoValidator::requireStringMinMax(1, 5000),
                'balance'=>GlobalDtoValidator::requireNumeric(),
                'issuer'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'active'=>GlobalDtoValidator::requireInteger(),
                'currency'=>GlobalDtoValidator::requireStringMinMax(1, 150),
            ]);

        if($validatorSrcAccount->fails())
        {
            return GlobalResultHandler::buildFaillureReasonArray($validatorSrcAccount->errors()->first());
        }


        $transactionSrcValidator = Validator::make($sourceTransaction,
            [
                'b_id'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'date'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'mobilebillercreditaccount'=>GlobalDtoValidator::requireStringMinMax(1, 5000),
                'made_by'=>GlobalDtoValidator::requireStringMinMax(1, 150),
                'amount'=>GlobalDtoValidator::requireNumeric(),
                'transaction_type'=>GlobalDtoValidator::requireStringMinMax(1, 50),
                'transaction_details'=>GlobalDtoValidator::requireStringMinMax(1, 5000),
                'user_transaction_number'=>GlobalDtoValidator::requireInteger(),
                'state'=>GlobalDtoValidator::requireStringMinMax(1, 50),
                'accountstate'=>GlobalDtoValidator::required(),
            ]);

        if($transactionSrcValidator->fails())
        {
            return GlobalResultHandler::buildFaillureReasonArray($transactionSrcValidator->errors()->first());
        }



        DB::beginTransaction();

        try{


            $mobileBillerCreditAccountViewsSrc = MobileBillerCreditAccountView::where('b_id', '=', $sourceAccount['b_id'])->
            where('accountnumber', '=', $sourceAccount['accountnumber'])->where('holder', '=', $sourceAccount['holder'])->get();

            if(!GlobalDbRecordCounter::countDbRecordIsExactlelOne($mobileBillerCreditAccountViewsSrc)){
                return response(GlobalResultHandler::buildFaillureReasonArray('User mobile credit account not found'), 200);
            }


            $mobileBillerCreditAccountViewsSrc[0]->balance = $sourceAccount['balance'];

            $mobileBillerCreditAccountViewsSrc[0]->save();



            $transactionDetailsObjectSrc = json_decode($sourceTransaction['transaction_details'], true);

            $transactionDetailsSrc = new TransactionDetail($transactionDetailsObjectSrc['made_by'], $transactionDetailsObjectSrc['account_number'],
                $transactionDetailsObjectSrc['account_holder'],  $transactionDetailsObjectSrc['account_security_code'],
                $transactionDetailsObjectSrc['account_type'], $transactionDetailsObjectSrc['beneficiary'], $transactionDetailsObjectSrc['transactionType']);

            $mobileBillerCreditAccountTransactionViewSrc = new MobileBillerCreditAccountTransactionView(
                $sourceTransaction['b_id'],
                $sourceTransaction['date'],
                $sourceTransaction['mobilebillercreditaccount'],
                $sourceTransaction['made_by'],
                $sourceTransaction['amount'],
                $sourceTransaction['transaction_type'],
                $transactionDetailsSrc,
                $sourceTransaction['user_transaction_number'],
                $sourceTransaction['state'],
                $sourceTransaction['returned_result'],
                $sourceTransaction['accountstate']

            );

            $mobileBillerCreditAccountTransactionViewSrc->save();


        }catch (\Exception $e){

            DB::rollBack();

            return response(GlobalResultHandler::buildFaillureReasonArray('Unable to save transfert operation '.$e->getMessage()), 200);

        }

        DB::commit();

        return response(GlobalResultHandler::buildSuccesResponseArray('Transfert Operation Saved successfully'), 200);
    }

    public function registerReceipt(){

        $dataJson = file_get_contents('php://input');
        $dataArray =  json_decode($dataJson, true);

        if(!$dataArray){
            return response(GlobalResultHandler::buildFaillureReasonArray("Invalid Data"), 200);
        }


        $validationrules =  [
            'userid' => GlobalDtoValidator::requireStringMinMax(1, 150),
            'tenantid' => GlobalDtoValidator::requireStringMinMax(1, 150),
            'transactionid' => GlobalDtoValidator::requireStringMinMax(1, 500),
            'amount' => GlobalDtoValidator::requireNumeric(),
            'address' => GlobalDtoValidator::requireStringMinMax(1, 1000),
            'date' => GlobalDtoValidator::required(),
            'body' => GlobalDtoValidator::requireStringMinMax(1, 5000),
            'date_sent' => GlobalDtoValidator::required(),
            'current_balance' => GlobalDtoValidator::requireNumeric(),
            'available_balance' => GlobalDtoValidator::requireNumeric(),
            'beneficiary' => GlobalDtoValidator::requireStringMinMax(1, 100),
            'type' => GlobalDtoValidator::requireStringMinMax(1, 100),
            'verification_code' => GlobalDtoValidator::requireStringMinMax(1, 150),
            'made_by' => GlobalDtoValidator::requireStringMinMax(1, 250),
        ];



        if (GlobalDtoValidator::validateData($dataArray, $validationrules)->fails()) {
            return response(GlobalResultHandler::buildFaillureReasonArray(GlobalDtoValidator::validateData($dataArray, $validationrules)->errors()->first()), 200);
        }


        $receiptToRegister = new Receipt(
            $dataArray['receiptid'],
            $dataArray['userid'],
            $dataArray['tenantid'],
            $dataArray['transactionid'],
            $dataArray['amount'],
            $dataArray['address'],
            $dataArray['date'],
            $dataArray['body'],
            $dataArray['date_sent'],
            $dataArray['current_balance'],
            $dataArray['available_balance'],
            $dataArray['beneficiary'],
            $dataArray['type'],
            $dataArray['verification_code'],
            1,
            $dataArray['made_by'],
            $dataArray['currency']
        );

        DB::beginTransaction();

        try{

            $receiptToRegister->save();

        }catch (\Exception $e){

            DB::rollBack();

            return response(GlobalResultHandler::buildFaillureReasonArray('Unable to register Receipt ' . $e->getMessage()), 200);
        }

        DB::commit();

        return response(GlobalResultHandler::buildSuccesResponseArray('Receipt registered Successfully'), 200);
    }



     public function registerBulkReceipt(){

        $dataJson = file_get_contents('php://input');
        $dataArray =  json_decode($dataJson, true);

        if(!$dataArray){
            return response(GlobalResultHandler::buildFaillureReasonArray("Invalid Data"), 200);
        }



        $validationrules =  [
            'userid' => GlobalDtoValidator::requireStringMinMax(1, 150),
            'tenantid' => GlobalDtoValidator::requireStringMinMax(1, 150),
            'transactionid' => GlobalDtoValidator::requireStringMinMax(1, 500),
            'amount' => GlobalDtoValidator::requireNumeric(),
            'address' => GlobalDtoValidator::requireStringMinMax(1, 1000),
            'date' => GlobalDtoValidator::requireDate(),
            'body' => GlobalDtoValidator::requireStringMinMax(1, 5000),
            'date_sent' => GlobalDtoValidator::requireDate(),
            'current_balance' => GlobalDtoValidator::requireNumeric(),
            'available_balance' => GlobalDtoValidator::requireNumeric(),
            'beneficiary' => GlobalDtoValidator::requireStringMinMax(1, 100),
            'type' => GlobalDtoValidator::requireStringMinMax(1, 100),
            'verification_code' => GlobalDtoValidator::requireStringMinMax(1, 150),
            'made_by' => GlobalDtoValidator::requireStringMinMax(1, 250),
        ];


        foreach ($dataArray as $receipt){
            if (GlobalDtoValidator::validateData($receipt, $validationrules)->fails()) {return response(GlobalResultHandler::buildFaillureReasonArray(GlobalDtoValidator::validateData($dataArray, $validationrules)->errors()->first()), 200);}
        }

     //   $receipts = [];

        DB::beginTransaction();

        try{

            foreach ($dataArray as $receipt){
                $receiptToRegister = new Receipt(
                    $receipt['receiptid'],
                    $receipt['userid'],
                    $receipt['tenantid'],
                    $receipt['transactionid'],
                    $receipt['amount'],
                    $receipt['address'],
                    $receipt['date'],
                    $receipt['body'],
                    $receipt['date_sent'],
                    $receipt['current_balance'],
                    $receipt['available_balance'],
                    $receipt['beneficiary'],
                    $receipt['type'],
                    $receipt['verification_code'],
                    1,
                    $receipt['made_by'],
                    $receipt['currency']
                );
                $receiptToRegister->save();
                //array_push($receipts, $receiptToRegister);
            }

        }catch (\Exception $e){

            DB::rollBack();

	    return response(GlobalResultHandler::buildFaillureReasonArray('Unable to register bulk Receipt ' . $e->getMessage()), 200);
           // return response(GlobalResultHandler::buildFaillureReasonArray('Unable to register Receipts'), 200);

        }

        DB::commit();


        //ProcessMessages::dispatch(env('REGISTER_BULK_RECEIPT_EXCHANGE'), env('RABBIT_MQ_EXCHANGE_TYPE'), json_encode($dataArray));

        return response(GlobalResultHandler::buildSuccesResponseArray('Receipts registered Successfully'), 200);

    }


    public function saveServiceAccess(){

        $dataJson = file_get_contents('php://input');
        $dataArray =  json_decode($dataJson, true);

        if(!$dataArray){
            return response(GlobalResultHandler::buildFaillureReasonArray("Invalid Data"), 200);
        }


        $validationrules =  [
            'serviceid' => GlobalDtoValidator::requireStringMinMax(1, 150),
            'clientid' => GlobalDtoValidator::requireStringMinMax(1, 150),
            'tenantid' => GlobalDtoValidator::requireStringMinMax(1, 150),
            'startdate' => GlobalDtoValidator::requireInteger(),
            'enddate' => GlobalDtoValidator::requireInteger(),
            'enablementstatus' => GlobalDtoValidator::requireInteger(),
            'expirationstatus' => GlobalDtoValidator::requireInteger(),
        ];


        //return "\n\n             OK \n\n";

        if (GlobalDtoValidator::validateData($dataArray, $validationrules)->fails()) {
            return response(GlobalResultHandler::buildFaillureReasonArray(GlobalDtoValidator::validateData($dataArray, $validationrules)->errors()->first()), 200);
        }



        $services = Service::where('b_id', '=', $dataArray['serviceid'])->get();

        if(!GlobalDbRecordCounter::countDbRecordIsExactlelOne($services)){
            return response(GlobalResultHandler::buildFaillureReasonArray('Invalid data'), 200);

        }




        $existingservices = ClientServiceValidity::where('serviceid', '=', $dataArray['serviceid'])->
        where('clientid', '=', $dataArray['clientid'])->where('tenantid', '=', $dataArray['tenantid'])->get();

        if(GlobalDbRecordCounter::countDbRecordIsExactlelOne($existingservices)){

            $existingservices[0]->startdate = $dataArray['startdate'];
            $existingservices[0]->enddate =  $dataArray['enddate'];

            $existingservices[0]->save();

            return response(GlobalResultHandler::buildSuccesResponseArray('Service access registered Successfully'), 200);

        }elseif (GlobalDbRecordCounter::countDbRecordIsExactlelZero($existingservices)){


            $serviceAccessToRegister = new ClientServiceValidity(
                $dataArray['serviceid'],
                $dataArray['clientid'],
                $dataArray['tenantid'],
                $dataArray['startdate'],
                $dataArray['enddate'],
                $dataArray['enablementstatus'],
                $dataArray['expirationstatus'],
                $dataArray['reasonenablementchanged'],
                $services[0]->name,
                $services[0]->short_description,
                $services[0]->detailed_description

            );



            DB::beginTransaction();

            try{

                $serviceAccessToRegister->save();

            }catch (\Exception $e){

                DB::rollBack();

                return response(GlobalResultHandler::buildFaillureReasonArray('Unable to register Service '), 200);
            }

            DB::commit();

            return response(GlobalResultHandler::buildSuccesResponseArray('Service access registered Successfully'), 200);
        }else{

            return response(GlobalResultHandler::buildFaillureReasonArray('Wrong state'), 200);

        }


    }

   /* public function changePassword(){
        $userToRegisterJsonString = file_get_contents('php://input');
        $userToRegisterArray =  json_decode($userToRegisterJsonString, true);

        //echo $userToRegisterArray['password'];

        $users = User::where('tenant', '=', $userToRegisterArray['tenantid'])->where('email', '=', $userToRegisterArray['email'])->get();


        if(!(count($users) === 1)){
            return response(GlobalResultHandler::buildFaillureReasonArray('Something went wrong '), 200);
            //return "Something went wrong";
        }


        $user = $users[0];


        $user->password = Hash::make($userToRegisterArray['password']);

        $user->save();
        return response(GlobalResultHandler::buildSuccesResponseArray('Password Changed Successfully'), 200);

    }*/


    public function changePassword(){
        $userToRegisterJsonString = file_get_contents('php://input');
        $userToRegisterArray =  json_decode($userToRegisterJsonString, true);

        //echo $userToRegisterArray['password'];

        $users = User::where('tenant', '=', $userToRegisterArray['tenantid'])->where('email', '=', $userToRegisterArray['email'])->get();


        if(!(count($users) === 1)){
            return response(GlobalResultHandler::buildFaillureReasonArray('Something went wrong '), 200);
            //return "Something went wrong";
        }


        $user = $users[0];


        $user->password = Hash::make($userToRegisterArray['password']);

        $user->save();
        return response(GlobalResultHandler::buildSuccesResponseArray('Password Changed Successfully'), 200);

    }


    public function getTenantByUsername($username){
        return response(array('success' => 1, 'faillure' => 0, 'response' => User::where('username', '=', $username)->get(['tenant', 'tenant_name'])),200);
    }


    public function getServicesForAUser(Request $request, $userid){
        $services = ClientServiceValidity::where('clientid', '=', $userid)->get();
        return response(array('success' => 1, 'faillure' => 0, 'response' => $services),200);
    }

}
