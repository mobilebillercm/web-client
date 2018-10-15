<?php

namespace App\Http\Controllers;

use App\domain\model\ClientServiceValidity;
use App\domain\model\Currency;
use App\domain\model\ServiceWithNoUnitPriceAssigned;
use App\domain\model\Unit;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
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
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('success'=>0,'faillure'=>1,'raison'=>"Something went wrong  " . $e->getMessage())));
            //return response(array('success'=>0, 'faillure' => 1, 'raison' => $e->getMessage()), 200);
        }
    }

    public function getServicesForAUser(Request $request, $userid){
        $services = ClientServiceValidity::where('clientid', '=', $userid)->get();
        return view('services.myservices', array('services'=>$services));
    }

    public function showCreateServiceForm(){

        return view('services.addserviceform', array());
    }

    public function addService(Request $request){
        $validator = Validator::make($request->all(),
            [
                'name'=>'required|string|max:250',
                'description'=>'required|string|max:5000',
                'created_by'=>'required|string|max:150',
                'icon'=>'required|file|mimes:jpg,jpeg,png,bmp'
            ]);

        if ($validator->fails()){
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('success'=>0,'faillure'=>1,'raison'=>$validator->errors()->first())));
        }

        $client = new Client();
        try {

            $multipart = [];
            foreach ($request->all() as $key => $value) {
                if (!($request->get($key) === null)){
                    array_push($multipart,['name'=>$key, 'contents'=>$value]);
                }else if (!($request->file($key) === null)){

                    array_push($multipart,['name'=>$key, 'contents'=>fopen($request->file($key)->path(), 'r')/*$request->file($key)*/]);
                }

            }

            array_push($multipart, ['name'=>'scope',  'contents'=>'SCOPE_MANAGE_ACTIVITIES_AND_PROJECTS']);

            $response = $client->post(env('HOST_SERVICES').'/api/services', [
                'headers'=>[
                    'Authorization' => 'Bearer '.Auth::user()->access_token,
                ],
                'multipart'=>$multipart
            ]);



            $retVal = json_decode((string)$response->getBody(), true);

            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200, 'result'=>$retVal));

        } catch (\Exception $e) {
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('success'=>0,'faillure'=>1,'raison'=>"Something went wrong  " . 'Bearer '.Auth::user()->access_token . ">>>>>>>>>>>>" . $e->getMessage())));
            //return response(array('success'=>0, 'faillure' => 1, 'raison' => $e->getMessage()), 200);
        }
    }

    public function showUnpricedServiceList(Request $request){

        return view('services.unpriced-services-list', array('unpricedservices'=>ServiceWithNoUnitPriceAssigned::all()));
    }

    public function showPrarametrerPrixForm(Request $request, $serviceid){

        $service = ServiceWithNoUnitPriceAssigned::where('service_id', '=', $serviceid)->get();

        return view('services.parametrer-prix-service-form', array('service'=>$service[0], 'units'=>Unit::all(), 'currencies'=>Currency::all()));
    }


    public function defineServiceUnitPrice(Request $request, $serviceid){
        $client = new Client();
        try {
            $response = $client->post(env('HOST_PRICING').'/api/define-price-for-unpriced-services?scope=SCOPE_MANAGE_IDENTITIES_AND_ACCESSES', [
                'headers'=>[
                    'Authorization' => 'Bearer '.Auth::user()->access_token,
                ],
                'form_params'=> $request->all()
            ]);


            //return $response->getBody();

            $retVal = json_decode((string)$response->getBody(), true);
            /*if ($retVal->success === 0 and $retVal->faillure === 1){
                return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                    'result'=>$retVal));
            }*/

            //$retVal['success'] = 0; $retVal['faillure'] = 1; $retVal['raison'] = 'simulated';

            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>$retVal));

        } catch (\Exception $e) {
            return Redirect::back()->with('message',array('receiveResultStatusCode' => 200,
                'result'=>array('success'=>0,'faillure'=>1,'raison'=>"Something went wrong  " . $e->getMessage())));
            //return response(array('success'=>0, 'faillure' => 1, 'raison' => $e->getMessage()), 200);
        }
    }
}
