<?php

namespace App\Http\Controllers;

use App\domain\model\PaymentMethodType;
use App\domain\model\Service;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class FreeController extends Controller
{

    public function welcome () {
        return view('welcome', array('services'=>Service::all(['b_id', 'name', 'short_description', 'detailed_description', 'unit_amount', 'currency', 'unit'])));
    }

    public function showLoginForm() {
        return view('auth.login');
    }

    public function showSignupForm() {
        return view('auth.register');
    }

    public function showPasswordForgotForm(){
        return view('auth.passwords.email');
    }

    public function login(Request $request){
        //return $request;

        $validator = Validator::make($request->all(), [
            'email'=>'required|email|min:5|max:255',
            'password'=>'required|string|min:8|max:50',
        ]);
        if ($validator->fails()){
            Redirect::back()->withErrors($validator->errors());
        }

        $credentials = $request->only('email', 'password');


        $users = User::where('email', '=', $request->get('email'))->get();

        $access_token = null;

        //return json_encode($users);


        if(count($users) === 1){

            $user = $users[0];

            //if($access_token === null or $user->expires_in < time()){

            $client = new Client();
            /*

            try {
                $response = $client->post(env('HOST_IDENTITY_AND_ACCESS').'/api/access-token', [
                    'form_params' => [
                        'client_id' => env('IDENTITY_AND_ACCESS_CLIENT_ID'),
                        'client_secret' => env('IDENTITY_AND_ACCESS_SECRET'),
                        'grant_type' => env('IDENTITY_AND_ACCESS_GRANT_TYPE'),
                        'username' => $request->get('email'),
                        'password' => $request->get('password'),
                    ]
                ]);

                // You'd typically save this payload in the session
                $auth = json_decode( (string) $response->getBody() );

                $isjson = $this->is_JSON((string)$response->getBody());

                if(!($isjson == 0)){

                    return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                        'result'=>array("success"=>0, 'faillure'=>1, 'raison'=>'Unable to login')));
                }

                $access_token = $auth->access_token;

                $user->access_token = $access_token;
                $user->expires_in = $auth->expires_in;



            } catch (BadResponseException  $e) {
                //echo "Unable to retrieve access token login. ".$e->getMessage();
                //Redirect::back()->withErrors("Unable to retrieve access token login. ".$e->getMessage());
                return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                    'result'=>json_decode(json_encode(array('success'=>0, 'faillure'=>1, 'raison'=>'Unable to login. ')), true)));
            }*/


            //}
           /* try{

                $url = env('HOST_IDENTITY_AND_ACCESS').'/api/users/'.$user->email.'/login';


                //return $url;
                $body = json_encode(array('password'=>$request->get('password')));
                //return $body;
                $response = $client->post($url, [
                    'headers'=>[
                        'Authorization' => 'Bearer '.$user->access_token,
                    ],
                    'content-type' => 'application/json',
                    'body'=>$body
                ]);

                $isjson = $this->is_JSON((string)$response->getBody());

                if(!($isjson == 0)){

                    return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                        'result'=>array("success"=>0, 'faillure'=>1, 'raison'=>'Something Went Wrong')));
                }

                $login = json_decode( (string) $response->getBody());

                //return (string) $response->getBody();

                if($login->success === 0 and $login->faillure === 1){

                    return Redirect::back()->with('message',array('receiveResultStatusCode' => 200, 'result'=>json_decode((string)$response->getBody(), true)));

                }

                //Login locally and get a session
                if (Auth::attempt($credentials)) {
                    // Authentication passed...
                    $user->save();
                    return  view('welcome', array('divisions'=>$this->getDivisions()));//redirect()->intended('protected.home');
                }else{

                    return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                        'result'=>json_decode(json_encode(array('success'=>0, 'faillure'=>1, 'raison'=> 'Unable to authenticate the user')), true)));

                }

                //return response(array('success' => 0, 'faillure' => 1, 'raison' => $validator->errors()), 200);
            }catch (BadResponseException  $e){

                return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                    'result'=>json_decode(json_encode(array('success'=>0, 'faillure'=>1, 'raison'=>'Unable to authenticate the user. ')),true)));

            }*/

            if (Auth::attempt($credentials)) {
                // Authentication passed...
                $user->save();

                return  view('welcome', array('services'=>Service::all(['b_id', 'name', 'short_description', 'detailed_description', 'unit_amount', 'currency', 'unit'])));
            }else{

                return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                    'result'=>json_decode(json_encode(array('success'=>0, 'faillure'=>1, 'raison'=> 'Unable to authenticate the user')), true)));

            }


        }else{
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>json_decode(json_encode(array('success'=>0, 'faillure'=>1, 'raison'=>'Unable to authenticate the user.')),true)));

        }

    }

    public function getServices(Request $request){
        return  view('welcome', array('services'=>Service::all(['b_id', 'name', 'short_description', 'detailed_description', 'unit_amount', 'currency', 'unit'])));
    }

    public function getPaymentMethodTypes(Request $request){

        $client = new Client();
        $url = env('HOST_WALLET').'/api/paymentmethodtypes';
        $res = $client->get($url, []);

        return  response(json_decode((string)$res->getBody(), true), 200);
    }

    public function getServicePaymentFormStep1(Request $request){
        $request->session()->put('servicepayment-step1', $request->all());
        //$paymentMethodTypes = json_decode(json_encode($this->getPaymentMethodTypes($request)->original));
        //return json_encode($paymentMethodTypes);
        $paymentMethodTypes = PaymentMethodType::all();
        $request->session()->put('paymentmethodtypes', $paymentMethodTypes);
        return view('services.payform', array('paymentmethodtypes'=>$paymentMethodTypes));
    }



    public function getIcon($serviceid){

        $services = Service::where('b_id', '=', $serviceid)->get();

        if (!(count($services) === 1)){
            return response()->make(null, 200, array(
                'Content-Type' => (new \finfo(FILEINFO_MIME))->buffer(null)
            ));
        }

        $contents = $services[0]->icon;
        return response()->make($contents, 200, array(
            'Content-Type' => (new \finfo(FILEINFO_MIME))->buffer($contents)
        ));
    }
}
