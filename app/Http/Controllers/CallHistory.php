<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CallHistorydb;
use App\Models\customers;


class CallHistory extends Controller
{
    
    public function Show_Calls(){

        $users = CallHistorydb::all();
        return view("HistoryCall", compact("users"));


    }


    public function Profile_Customer(Request $request){

        $mobile = $request->get("mobilecustomer");
        $user = customers::where('phone', $mobile)->orWhere('number', $mobile)->get();

        $calls = CallHistorydb::where('mobilecustomer', $mobile)->get();

        return view("ProfileCustomer", compact("user","calls"));
        // return $user;

    }

}
