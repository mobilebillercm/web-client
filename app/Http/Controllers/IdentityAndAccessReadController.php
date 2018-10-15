<?php

namespace App\Http\Controllers;

use App\domain\GlobalResultHandler;
use App\User;
use Illuminate\Http\Request;


class IdentityAndAccessReadController extends Controller
{

    public function getAllTenantHavingUserWithUsername($username){

        return GlobalResultHandler::buildSuccesResponseArray(User::where('username', '=', $username)->get(['tenant', 'tenant_name']));
    }

}
