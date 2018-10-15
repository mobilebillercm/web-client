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
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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


    ///COMMAND OPERATIONS
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



            $url = env('HOST_IDENTITY_AND_ACCESS').'/api/users-invitations';

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


//Route::post('/users/{inviteduserid}/registration-invitations', 'UserController@registerInvitedUser');

}