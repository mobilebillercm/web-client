<?php
/**
 * Created by PhpStorm.
 * User: el
 * Date: 10/9/18
 * Time: 9:01 AM
 */

namespace App\Http\Controllers;


use App\domain\GlobalDbRecordCounter;
use App\domain\GlobalResultHandler;
use App\TenantCollaboratorsRegistrationInvitationsView;
use App\TenantView;
use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class IdentityAndAccessController extends Controller
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

    }

    public function is_JSON($args) {
        json_decode($args);
        return (json_last_error());
    }

    public function index(Request $request)
    {
        return view('home');
    }

    public function logout(Request $request){




        $client = new Client();
        $url = env('HOST_IDENTITY_AND_ACCESS').'/api/lougout-user/'.Auth::user()->email.'/'.Auth::user()->tenant;

        //return $url;


        $res = $client->post($url, [
            'headers'=>[
                'Authorization' => 'Bearer '.Auth::user()->access_token,
            ],
        ]);

        $result = json_decode((string)$res->getBody());


        Auth::logout();
        Session::flush();
        Cache::flush();
        return redirect('id/login');
    }

    public function showInvitationForm(Request $request){

        return view('auth.invitation',array());
    }

    public  function inviteCollaborator(Request $request){

        //return $request;
        $validator = Validator::make(
            $request->all(),
            [
                'firstname' => 'required|string|min:1|max:100',
                'lastname' => 'required|string|min:1|max:100',
                'email' => 'required|email|min:1|max:50',
                'phone1' => ['required', 'regex:/^(22|23|24|67|69|65|68|66)[0-9]{7}$/'],
                'invited_by' => 'required|string|min:1|max:100',
                'tenantid' => 'required|string|min:1|max:100',
            ]
        );

        if ($validator->fails()){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>json_encode($validator->errors()), 'success'=>0, 'faillure'=>1)));
        }

        //return  'Bearer '.Auth::user()->access_token;

        $client = new Client();
        try {



            $url = env('HOST_IDENTITY_AND_ACCESS').'/api/users-invitations?scope='.env('SCOPE_MANAGE_COLLABORATORS');

            $response = $client->post($url, [
                'headers'=>[
                    'Authorization' => 'Bearer '.Auth::user()->access_token,
                ],
                'form_params'=>$request->all()
            ]);

            $isjson = $this->is_JSON((string)$response->getBody());

            if(!($isjson == 0)){

                return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                    'result'=>array("success"=>0, 'faillure'=>1, 'raison'=>'Something Went Wrong')));
            }


            $object = json_decode((string)$response->getBody(), true);
            if ($object['success'] == 0 and $object['faillure'] == 1){
                return  Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                    'result'=>array('success'=>$object['success'], 'faillure'=>$object['faillure'], 'raison'=>json_encode($object['raison']))));
            }

            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>json_decode((string)$response->getBody(), true)));

        } catch (\Exception $e) {
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>json_decode(json_encode(array('raison'=>"Unable to invite the user  : ".
                    $request->get('firstname') . " " . $request->get('lastname').' '.$e->getMessage(), 'success'=>0, 'faillure'=>1)), true)));
        }



    }

    public function showChangePasswordForm(Request $request){
        return view('auth.change-password-form');
    }

    public function changePassword(Request $request){

        if (!(Hash::check($request->get('oldpassword'), Auth::user()->password))) {
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('success'=>0, 'faillure'=>1, 'raison'=>"Your current password does not matches with the password you provided. Please try again.")));
        }

        if(strcmp($request->get('oldpassword'), $request->get('newpassword')) == 0){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('success'=>0, 'faillure'=>1, 'raison'=>"New Password cannot be same as your current password. Please choose a different password.")));
        }

        $validator = Validator::make($request->all(),
            [
                'oldpassword' => 'required|string|min:6',
                'newpassword' => 'required|string|min:6',
                'newpasswordconfirmation' => 'required|string|min:6',
                'tenantid' => 'required|string|min:1|max:150',
                'userid' => 'required|string|min:1|max:150',

            ]);

        if ($validator->fails()){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('success'=>0, 'faillure'=>1, 'raison'=>$validator->errors()->first() . " ")));
        }

        $client = new Client();
        try {
            $response = $client->post(env('HOST_IDENTITY_AND_ACCESS').'/api/users/'.Auth::user()->email.'/change-password', [
                'headers'=>[
                    'Authorization' => 'Bearer '.Auth::user()->access_token,
                ],
                'form_params'=>$request->all()
            ]);

            //return $response->getBody();
            $isjson = $this->is_JSON((string)$response->getBody());

            if(!($isjson == 0)){

                return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                    'result'=>array("success"=>0, 'faillure'=>1, 'raison'=>'Something Went Wrong')));
            }


            $result = json_decode((string)$response->getBody());

            if ($result->success===1 and $result->faillure === 0){
                return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                    'result'=>array('success'=>1, 'faillure'=>0, 'response'=>$result->response)));
            }

            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('success'=>0, 'faillure'=>1, 'raison'=>$result->raison)));



        } catch (\Exception $e) {

            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('success'=>0, 'faillure'=>1, 'raison'=>'Unable to change Password')));
        }

    }



    public function createSubaccountForm(Request $request){
        return view('auth.createsubaccount',array());
    }
    public function createSubaccount(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'firstname' => 'required|string|min:1|max:100',
                'lastname' => 'required|string|min:1|max:100',
                'email' => 'required|email|min:1|max:50',
                'phone1' => ['required', 'regex:/^(22|23|24|67|69|65|68|66)[0-9]{7}$/'],
                'invited_by' => 'required|string|min:1|max:100',
                'tenantid' => 'required|string|min:1|max:100',
            ]
        );

        if ($validator->fails()){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('raison'=>json_encode($validator->errors()), 'success'=>0, 'faillure'=>1)));
        }

        //return  'Bearer '.Auth::user()->access_token;

        $client = new Client();
        try {



            $url = env('HOST_IDENTITY_AND_ACCESS').'/api/users-subaccounts?scope='.env('SCOPE_MANAGE_COLLABORATORS');

            $response = $client->post($url, [
                'headers'=>[
                    'Authorization' => 'Bearer '.Auth::user()->access_token,
                ],
                'form_params'=>$request->all()
            ]);

            $isjson = $this->is_JSON((string)$response->getBody());

            if(!($isjson == 0)){

                return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                    'result'=>array("success"=>0, 'faillure'=>1, 'raison'=>'Something Went Wrong')));
            }


            $object = json_decode((string)$response->getBody(), true);
            if ($object['success'] == 0 and $object['faillure'] == 1){
                return  Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                    'result'=>array('success'=>$object['success'], 'faillure'=>$object['faillure'], 'raison'=>json_encode($object['raison']))));
            }

            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>json_decode((string)$response->getBody(), true)));

        } catch (\Exception $e) {
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>json_decode(json_encode(array('raison'=>"Unable to invite the user  : " . $e->getMessage(), 'success'=>0, 'faillure'=>1)), true)));
        }
    }

    public function showBlockSubaccountForm(Request $request){
        $client = new Client();
        $url = env('HOST_IDENTITY_AND_ACCESS').'/api/users/'.Auth::user()->userid .'/'. Auth::user()->tenant .'/subaccounts?scope='.env('SCOPE_MANAGE_ACCOUNT_ACCESSES');
        $res = $client->get($url, [
            'headers'=>[
                'Authorization' => 'Bearer '.Auth::user()->access_token,
            ]
        ]);
         //return $res->getBody();
        $response = json_decode((string)$res->getBody());
       // return  json_encode($response->response);
        return view('auth.subaccounts',array('subaccounts'=>$response->response));
    }

    public function getSubaccount(Request $request, $tenantid, $userid){
        $client = new Client();
        try {
        $url = env('HOST_IDENTITY_AND_ACCESS').'/api/users/'.$userid .'/'. $tenantid .'/subaccounts?scope='.env('SCOPE_MANAGE_SUBACCOUNT_ACCESSES');
        $res = $client->get($url, [
            'headers'=>[
                'Authorization' => 'Bearer '.Auth::user()->access_token,
            ]
        ]);
        //return $res->getBody();
        $response = json_decode((string)$res->getBody());
        // return  json_encode($response->response);
        //return view('auth.subaccounts',array('subaccounts'=>$response->response));
            //return $response->getBody();
            $isjson = $this->is_JSON((string)$res->getBody());

            if(!($isjson == 0)){

                return response(array('success'=>0, 'faillure'=>1, 'raison'=>"Something went wrong"));
            }


            $result = json_decode((string)$res->getBody(), true);

            return response($result, 200);

        } catch (\Exception $e) {

            return response(array('success'=>0, 'faillure'=>1, 'raison'=>"Something went wrong"));
        }
    }

    public function blockSubaccount(Request $request,$tenantid, $userid){

        $client = new Client();
        try {
            ///
            $response = $client->put(env('HOST_IDENTITY_AND_ACCESS').'/api/users/'. $userid .'/' .$tenantid.'/desable?scope='.env('SCOPE_MANAGE_ACCOUNT_ACCESSES') , [
                'headers'=>[
                    'Authorization' => 'Bearer '.Auth::user()->access_token,
                ],
                'form_params'=>$request->all()
            ]);



            //return $response->getBody();
            $isjson = $this->is_JSON((string)$response->getBody());

            if(!($isjson == 0)){

                return response(array('success'=>0, 'faillure'=>1, 'raison'=>"Something went wrong"));
            }


            $result = json_decode((string)$response->getBody(), true);

            return response($result, 200);

        } catch (BadResponseException $e) {

            return response(array('success'=>0, 'faillure'=>1, 'raison'=>"Something went wrong"));
        }
    }

    public function enableSubaccount(Request $request,$tenantid, $userid){

        $client = new Client();
        try {
            ///
            $response = $client->put(env('HOST_IDENTITY_AND_ACCESS').'/api/users/'. $userid .'/' .$tenantid.'/enable?scope='.env('SCOPE_MANAGE_ACCOUNT_ACCESSES') , [
                'headers'=>[
                    'Authorization' => 'Bearer '.Auth::user()->access_token,
                ],
                'form_params'=>$request->all()
            ]);

            //return $response->getBody();
            $isjson = $this->is_JSON((string)$response->getBody());

            if(!($isjson == 0)){

                return response(array('success'=>0, 'faillure'=>1, 'raison'=>"Something went wrong"));
            }


            $result = json_decode((string)$response->getBody(), true);

            return response($result, 200);

        } catch (BadResponseException $e) {

            return response(array('success'=>0, 'faillure'=>1, 'raison'=>"Something went wrong"));
        }
    }

    public function getUserById(Request $request, $userid){
        return User::where('userid', '=', $userid)->get()[0];
    }


}

