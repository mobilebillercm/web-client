<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PricingController extends Controller
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

    public function getPrice($serviceid, $quantity){

        $client = new Client();
        $url = env('HOST_PRICING').'/api/calculate-paid-service-price/'.$serviceid.'/'.$quantity.'?scope=SCOPE_MANAGE_IDENTITIES_AND_ACCESSES';
        $res = $client->get($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . Auth::user()->access_token,
            ]
        ]);

        //$response = json_decode((string));

        return  (string) $res->getBody();
    }
}
