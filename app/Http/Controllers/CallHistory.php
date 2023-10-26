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

        $NationalCode = $request->get("NationalCode");
        $user = customers::where('NationalCode', $NationalCode)->first();

        $calls = CallHistorydb::where('NationalCode', $NationalCode)->get();

        return view("ProfileCustomer", compact("user","calls","NationalCode"));



        // اپدیت کردن کدملی در دیتابیس مکلمات 
        // return $user;

    }

}
