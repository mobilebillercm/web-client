<?php

namespace App\Http\Controllers;

use App\domain\model\ClientServiceValidity;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
        //return $retVal->response;
        return view('transactions.menu',array('balance'=>$retVal->response));
    }

    public function showTransactionForm(Request $request, $userid){
        $users = User::where('userid' , '=', $userid)->orWhere('email', '=', $userid)->orWhere('username', '=', $userid)->get();
        if (!(count($users) === 1)){
            return view('transactions.accounts',array());
        }

        return view('transactions.topupaccount',array('beneficiary'=>$users[0]));

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
}
