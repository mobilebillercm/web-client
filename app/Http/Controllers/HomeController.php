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
    }


    public function is_JSON($args) {
        json_decode($args);
        return (json_last_error());
    }

    public function getTickets(Request $request, $userid){

        //return $userid;

        return view('tickets.tickets',array('tickets'=>array('success'=>1, 'faillure'=>0,
            'response'=>Tickets::where('belongs_to', '=', $userid)->orderBy('created_at', 'DESC')->paginate(env('NUMBER_ITEM_PER_PAGE_TICKET')))));
    }

}
