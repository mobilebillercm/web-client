<?php

namespace App\Http\Controllers;

use App\domain\model\Receipt;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public function getTickets(Request $request, $tenantid, $userid){
        return view('tickets.tickets',array('tickets'=>array('success'=>1, 'faillure'=>0,
            'response'=>Receipt::where('tenantid', '=', $tenantid)->where('userid', '=', $userid)->orderBy('created_at', 'DESC')->paginate(env('NUMBER_ITEM_PER_PAGE_TICKET')))));
    }
}
