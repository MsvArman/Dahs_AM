<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CallHistorydb;
use App\Models\customers;


class CallHistory extends Controller
{
    
    public function Show_Calls(){

        // $users = CallHistorydb::all()->sortBy("id");
        $users = CallHistorydb::orderBy('id')->get();

        
        return view("HistoryCall", compact("users"));


    }


    public function Profile_Customer(Request $request){

        $NationalCode = $request->get("NationalCode");
        $user = customers::where('NationalCode', $NationalCode)->first();

        $calls = CallHistorydb::where('NationalCode', $NationalCode)->get();

        $count = count($calls);
        $end = $calls[$count - 1];
        // return $end;
        return view("ProfileCustomer", compact("user","calls","NationalCode","end"));



        // اپدیت کردن کدملی در دیتابیس مکلمات 
        

    }

    public function Comment(Request $request){

        try {
            
            $user = CallHistorydb::find($request->get("id"));
            $user->update([
                "comment" => $request->get("comment"),
            ]);
    
            return redirect()->route("callhistory");

        } catch (\Exception $ex) {
            
            return redirect()->back();

        }

    }

}
