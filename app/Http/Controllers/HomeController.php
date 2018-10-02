<?php

namespace App\Http\Controllers;

use App\domain\model\ClientServiceValidity;

use App\domain\model\PaymentMethodType;
use App\domain\model\Tickets;
use App\domain\model\TransactionType;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    private $freeeController;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->freeeController = new FreeController();
        if (!Auth::check()) {
            return redirect('/'); // redirect to your specific page which is public for all
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('home');
    }


    public function logout(Request $request){

        //Todo Revoke token

        $client = new Client();
        /*$url = env('HOST_IDENTITY_AND_ACCESS').'/api/lougout-user/'.Auth::user()->email;
        $res = $client->post($url, [
            'headers'=>[
                'Authorization' => 'Bearer '.Auth::user()->access_token,
            ]
        ]);

        $result = json_decode((string)$res->getBody());*/


        Auth::logout();
        Session::flush();
        Cache::flush();
        return redirect('id/login');
    }

    public function showInvitationForm(Request $request){

        return view('auth.invitation',array());
    }

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

        $tenants = User::distinct()->get(['tenant']);
        //return $tenants;

        $users  = User::whereIn('tenant', $tenants)->get();
        return view('transactions.topupother',
            array('transaction_type'=>$transactionTypes[0]->b_id,
                'paymentmethodtypes'=>$paymentMethodTypes, 'tenants'=>$users));

    }

    public function showTransfertForm(Request $request, $userid){
        $users = User::where('userid' , '=', $userid)->orWhere('email', '=', $userid)->orWhere('username', '=', $userid)->get();
        /*if (!(count($users) === 1)){
            $this->logout($request);
        }

        if (!($users[0]->email === Auth::user()->email)){
            $this->logout($request);
        }*/

        $transactionTypes = TransactionType::where('name', '=', 'TRANSFERT')->get();

        if (!(count($users) === 1)){
            return view('transactions.error',array());
        }

        $users = User::where('userid', '!=', Auth::user()->userid)->get();

        $balance = $this->getInfos($request, Auth::user()->userid)->original;
        $balance_and_unit = null;
        preg_match_all('/^(\d+)(\w+)$/', $balance['response'], $balance_and_unit);

        return view('transactions.transfert',
            array('transaction_type'=>$transactionTypes[0]->b_id, 'users'=>$users, 'balance'=>array('amount'=>$balance_and_unit[1][0], 'unit'=>$balance_and_unit[2][0])));
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

    public function getInfos(Request $request, $userId){
        $validator = Validator::make($request->all(), [
            'query' => 'required|string|min:1|max:150',
        ]);

        if ($validator->fails()) {
            return response(array('success' => 0, 'faillure' => 1, 'raison' => $validator->errors()->first()), 200);
        }

        $client = new Client();
        $url = env('HOST_WALLET').'/api/mobilebillercreditaccounts/'.$userId.'?query='.$request->get('query');
        $res = $client->get($url, []);


        return  response(json_decode((string)$res->getBody(), true), 200);
    }

    public function getServicePaymentFormStep2(Request $request){
        //return $request->all();
        $client = new Client();
        try {
            $response = $client->post(env('HOST_PAYMENT').'/api/payments', [
                'headers'=>[
                    'Authorization' => 'Bearer '.Auth::user()->access_token,
                ],
                'form_params'=> $request->all()
            ]);



            $retVal = json_decode((string)$response->getBody(), true);
            /*if ($retVal->success === 0 and $retVal->faillure === 1){
                return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                    'result'=>$retVal));
            }*/

            //$retVal['success'] = 0; $retVal['faillure'] = 1; $retVal['raison'] = 'simulated';

            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>$retVal));

        } catch (\Exception $e) {
            return response(array('success'=>0, 'faillure' => 1, 'raison' => $e->getMessage()), 200);
        }
    }

    public function getServicesForAUser(Request $request, $userid){
        $services = ClientServiceValidity::where('clientid', '=', $userid)->get();
        return view('services.myservices', array('services'=>$services));
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

    public function makeTransfert(Request $request){

        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6|max:150',
            'userid' => 'required|string|min:1|max:150',
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


    public function getTransactions(Request $request, $userid){
        $client = new Client();
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
        $paginator = new LengthAwarePaginator($currentItems, count($transactions), $perPage,$currentPage, ['path' => LengthAwarePaginator::resolveCurrentPath()]);

        //return (string)$res->getBody();
        return view('transactions.transactions',array('transactions'=>array('success'=>1, 'faillure'=>0, 'response'=>$paginator)));
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

    public function getTickets(Request $request, $userid){

        //return $userid;

        return view('tickets.tickets',array('tickets'=>array('success'=>1, 'faillure'=>0,
            'response'=>Tickets::where('belongs_to', '=', $userid)->orderBy('created_at', 'DESC')->paginate(env('NUMBER_ITEM_PER_PAGE_TICKET')))));
    }

    /*
     * Transfert de 100000 FCFA effectue avec succes a DIDIER JUNIOR NKALLA EHAWE (237671747569) le 2018-09-26 09:30:45. FRAIS 250 FCFA. Transaction Id: 395587665 ; Reference: . Nouveau solde est: 33000 FCFA.
    INSERT INTO `tickets` (`id`, `b_id`, `transaction_type`, `transaction_state`, `transaction_amount`, `transaction_beneficiary_name`, `transaction_beneficiary_account_number`, `transaction_date`, `transaction_id`, `transaction_reference`, `transaction_fees`, `transaction_balance`, `transaction_currency`, `sms_sender`, `sms_date`, `sms_body`, `sms_receiver`, `belongs_to`, `tenant`, `created_at`, `updated_at`) VALUES (NULL, '93ef8ffb-c3df-11e8-b60c-ac2b6ee888a2', 'Transfert', 'Succes', '100000', 'Nkalla Ehawe didier Junior', '237671747569', '2018-09-26 10:45:36', '123654789', '987456321', '2500', '330000', 'FCFA', '23791179154', '2018-09-26 10:46:50', 'Transfert de 100000 FCFA effectue avec succes a DIDIER JUNIOR NKALLA EHAWE (237671747569) le 2018-09-26 09:30:45. FRAIS 250 FCFA. Transaction Id: 395587665 ; Reference: . Nouveau solde est: 33000 FCFA.', NULL, '', '', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
    */



}
