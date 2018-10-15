<?php

namespace App\Http\Controllers;

use App\domain\GlobalDbRecordCounter;
use App\domain\GlobalResultHandler;
use App\domain\model\Currency;
use App\domain\model\MobileBillerCreditAccountTransactionView;
use App\domain\model\PaymentMethodType;
use App\domain\model\TransactionType;
use App\MobileBillerCreditAccountView;
use App\TenantView;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class WalletController extends Controller
{
    public function showTransactionMenu(Request $request){
        $client = new Client();
        $url = env('HOST_WALLET').'/api/mobilebillercreditaccounts/'.Auth::user()->email.'?query=balance';
        $res = $client->get($url, []);
        $retVal = json_decode((string)$res->getBody());
        //return (string)$res->getBody();
        return view('transactions.menu',array('balance'=>$retVal->response));
    }

    public function showTopupForm(Request $request, $userid){

        $users = User::where('userid' , '=', $userid)->orWhere('email', '=', $userid)->orWhere('username', '=', $userid)->get();

        //return json_encode($users);
        /*if (!(count($users) === 1)){
            $this->logout($request);
        }

        if (!($users[0]->email === Auth::user()->email)){
            $this->logout($request);
        }*/

        $transactionTypes = TransactionType::where('name', '=', 'TOPUP')->get();

        if (!(count($users) === 1)){
            return view('transactions.error',array());
        }

        $paymentMethodTypes = PaymentMethodType::all();
        $request->session()->put('paymentmethodtypes', $paymentMethodTypes);
        //return view('services.payform', array());

        return view('transactions.topupaccount',array('beneficiary'=>$users[0],
            'transaction_type'=>$transactionTypes[0]->b_id, 'paymentmethodtypes'=>$paymentMethodTypes));

    }

    public function makeTopup(Request $request){

        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6|max:150',
        ]);

        if (!$validator->fails()) {
            if (!Auth::attempt(['email' => Auth::user()->email, 'password' => $request->get('password')])) {
                return Redirect::back()->with('message',array('receiveResultStatusCode' => 200, 'result'=>array('success'=>0, 'faillure'=>1, 'raison'=>'Authentication Failed!!!')));
            }
            //return response(array('success' => 0, 'faillure' => 1, 'raison' => $validator->errors()->first()), 200);
        }


        $client = new Client();
        try {
            $response = $client->post(env('HOST_WALLET').'/api/topups', [
                'headers'=>[
                    'Authorization' => 'Bearer '.Auth::user()->access_token,
                ],
                'form_params'=> $request->all()
            ]);

            //return (string)$response->getBody();

            $retVal = json_decode((string)$response->getBody(), true);
            /*if ($retVal->success === 0 and $retVal->faillure === 1){
                return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                    'result'=>$retVal));
            }*/

            //$retVal['success'] = 0; $retVal['faillure'] = 1; $retVal['raison'] = 'simulated';

            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200, 'result'=>$retVal));

        } catch (\Exception $e) {
            return response(array('success'=>0, 'faillure' => 1, 'raison' => $e->getMessage()), 200);
        }

    }

    public function makeCashTopup(Request $request){

        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6|max:150',
        ]);

        if (!$validator->fails()) {
            if (!Auth::attempt(['email' => Auth::user()->email, 'password' => $request->get('password')])) {
                return Redirect::back()->with('message',array('receiveResultStatusCode' => 200, 'result'=>array('success'=>0, 'faillure'=>1, 'raison'=>'Authentication Failed!!!')));
            }
            //return response(array('success' => 0, 'faillure' => 1, 'raison' => $validator->errors()->first()), 200);
        }


        $client = new Client();
        try {
            $response = $client->post(env('HOST_WALLET').'/api/cash-topups', [
                'headers'=>[
                    'Authorization' => 'Bearer '.Auth::user()->access_token,
                ],
                'form_params'=> $request->all()
            ]);

            //return (string)$response->getBody();

            $retVal = json_decode((string)$response->getBody(), true);
            /*if ($retVal->success === 0 and $retVal->faillure === 1){
                return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                    'result'=>$retVal));
            }*/

            //$retVal['success'] = 0; $retVal['faillure'] = 1; $retVal['raison'] = 'simulated';

            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200, 'result'=>$retVal));

        } catch (\Exception $e) {
            return response(array('success'=>0, 'faillure' => 1, 'raison' => $e->getMessage()), 200);
        }

    }

    public function getSubaccounts(Request $request, $userid){


        $users = User::where('userid' , '=', $userid)->orWhere('email', '=', $userid)->orWhere('username', '=', $userid)->get();
        //return json_encode($users);
        /* if (!(count($users) === 1)){
             $this->logout($request);
         }

         if (!($users[0]->email === Auth::user()->email)){
             $this->logout($request);
         }*/

        $parent = $users[0]->userid;

        $subusers = User::where('parent', '=', $parent)->get();
        //return $subusers;

        return view('transactions.subaccount',array('subaccounts'=>$subusers));
    }

    public function showTopupOtherForm(Request $request, $userid){

        $users = User::where('userid' , '=', $userid)->orWhere('email', '=', $userid)->orWhere('username', '=', $userid)->get();

        //return json_encode($users);
        /*if (!(count($users) === 1)){
            $this->logout($request);
        }

        if (!($users[0]->email === Auth::user()->email)){
            $this->logout($request);
        }*/

        $transactionTypes = TransactionType::where('name', '=', 'TOPUP')->get();

        if (!(count($users) === 1)){
            return view('transactions.error',array());
        }

        $paymentMethodTypes = PaymentMethodType::all();
        $request->session()->put('paymentmethodtypes', $paymentMethodTypes);

        //return view('services.payform', array());

        //$tenants = User::distinct()->get(['tenant']);
        //return $tenants;

       // $tenants  = User::whereIn('tenant', TenantView::all())->get();
        return view('transactions.topupother',
            array('transaction_type'=>$transactionTypes[0]->b_id, 'paymentmethodtypes'=>$paymentMethodTypes, 'tenants'=>TenantView::all()));

    }

    public function showTransfertForm(Request $request, $userid){
        $users = User::where('userid' , '=', $userid)->orWhere('email', '=', $userid)->orWhere('username', '=', $userid)->get();

        $transactionTypes = TransactionType::where('name', '=', 'TRANSFERT')->get();

        if (!(count($users) === 1)){
            return view('transactions.error',array());
        }

        //$users = User::where('userid', '!=', Auth::user()->userid)->get();



        $balance = $this->getInfos($request, Auth::user()->userid);
        $balance_and_unit = null;
        preg_match_all('/^(\d+)\s*(\w+)$/', $balance['response'], $balance_and_unit);

        return view('transactions.transfert',
            array('transaction_type'=>$transactionTypes[0]->b_id,
                'tenants'=>TenantView::all(), 'balance'=>array('amount'=>$balance_and_unit[1][0],
                'unit'=>$balance_and_unit[2][0])));
    }

    public function makeTransfert(Request $request){

        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6|max:150',
            'userid' => 'required|string|min:1|max:150',
            'tenantid' => 'required|string|min:1|max:150',
            'beneficiary' => 'required|string|min:1|max:150',
            'amount' => 'required|numeric|min:100',
            'user_transaction_number' => 'required|numeric',
        ]);

        //return $request;

        if ($validator->fails()) {
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('success'=>0, 'faillure'=>1, 'raison'=>$validator->errors()->first())));
        }
        if (!Auth::attempt(['email' => Auth::user()->email, 'password' => $request->get('password')])) {
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200, 'result'=>array('success'=>0, 'faillure'=>1, 'raison'=>'Authentication Failed!!!')));
        }

        $client = new Client();
        try {
            //return $request;

            $response = $client->post(env('HOST_WALLET').'/api/transferts', [
                'headers'=>[
                    'Authorization' => 'Bearer '.Auth::user()->access_token,
                ],
                'form_params'=> $request->all()
            ]);

            //return (string)$response->getBody();

            $retVal = json_decode((string)$response->getBody(), true);
            /*if ($retVal->success === 0 and $retVal->faillure === 1){
                return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                    'result'=>$retVal));
            }*/

            //$retVal['success'] = 0; $retVal['faillure'] = 1; $retVal['raison'] = 'simulated';

            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200, 'result'=>$retVal));

        } catch (\Exception $e) {
            return response(array('success'=>0, 'faillure' => 1, 'raison' => $e->getMessage()), 200);
        }

    }

    public function getUserByTenant(Request $request, $tenant){
        //sleep(3);
        return User::where('tenant', '=', $tenant)->where('userid', '!=', Auth::user()->userid)->get();
    }

    public function getInfos(Request $request, $userId){
        $validator = Validator::make($request->all(), [
            'query' => 'required|string|min:1|max:150',
        ]);

        if ($validator->fails()) {
            return response(array('success' => 0, 'faillure' => 1, 'raison' => $validator->errors()->first()), 200);
        }

        /*$client = new Client();
        $url = env('HOST_WALLET').'/api/mobilebillercreditaccounts/'.$userId.'?query='.$request->get('query');
        $res = $client->get($url, []);*/


        $mobileCreditAccounts = MobileBillerCreditAccountView::where('holder', '=', $userId)->get();

        if(!GlobalDbRecordCounter::countDbRecordIsExactlelOne($mobileCreditAccounts)){

            return GlobalResultHandler::buildFaillureReasonArray('Account not found');
        }

        $currencies = Currency::where('currencyid', '=', $mobileCreditAccounts[0]->currency)->get();


        return  GlobalResultHandler::buildSuccesResponseArray($mobileCreditAccounts[0]->balance.' '.$currencies[0]->name);
    }

    public function getTransactions(Request $request, $userid){
        /*$client = new Client();
        $url = env('HOST_WALLET').'/api/transactions/'.$userid;
        $res = $client->get($url, []);
        $retVal = json_decode((string)$res->getBody(), true);
        if ($retVal['success'] === 0 and $retVal['faillure'] === 1){
            return view('transactions.transactions',array('transactions'=>$retVal));
        }

        $transactions  = $retVal['response'];

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = env('NUMBER_ITEM_PER_PAGE');
        $currentItems = array_slice($transactions, $perPage * ($currentPage - 1), $perPage);
        $paginator = new LengthAwarePaginator($currentItems, count($transactions), $perPage,$currentPage, ['path' => LengthAwarePaginator::resolveCurrentPath()]);*/


        $mobilebillerCreditAccount = MobileBillerCreditAccountView::where('holder', '=', $userid)->get();

        if (!GlobalDbRecordCounter::countDbRecordIsExactlelOne($mobilebillerCreditAccount)){
            return view('transactions.transactions',array('transactions'=>'User Account not Found'));
        }


        return view('transactions.transactions',
            array('transactions'=>MobileBillerCreditAccountTransactionView::where('mobilebillercreditaccount', '=', $mobilebillerCreditAccount[0]->accountnumber)->paginate(env('NUMBER_ITEM_PER_PAGE'))));
    }

    public function getTransactionDetails(Request $request, $transactionid){
        $client = new Client();
        $url = env('HOST_WALLET').'/api/transactions/details/'.$transactionid;
        $res = $client->get($url, []);
        $retVal = json_decode((string)$res->getBody(), true);
        if ($retVal['success'] === 0 and $retVal['faillure'] === 1){
            return view('transactions.transactions',array('transactions'=>$retVal));
        }

        $transactions  = $retVal['response'];
        //return $transactions;
        return view('transactions.transaction-sheet',array('transaction'=>array('success'=>1, 'faillure'=>0, 'response'=>$transactions)));
    }
}
