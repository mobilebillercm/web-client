<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

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
    public function index()
    {
        return view('home');
    }


    public function logout(){

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
        return redirect('/login');
    }
}
