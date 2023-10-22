<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customers;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;

class CustomerManagement extends Controller
{

    public function Show_Customers(){

        $users = customers::all();
        return view("CustomerManagement", compact("users"));

    }


    public function Create_Customer(Request $request){

        try {

            $user = customers::create([
                "NationalCode" => $request->get("NationalCode"),
                "name" => $request->get("name"),
                "phone" => $request->get("phone"),
                "number" => $request->get("number"),
                "email" => $request->get("email"),
                "Investingin" => $request->get("Investingin"),
                "Amountofcapital" => $request->get("Amountofcapital"),

            ]);
    
            return redirect()->route("customermanagement");

        } catch (\Exception $ex) {
            
            // return redirect()->back();
            return $request;

        }

    }



    public function destroy(Request $request)
    {

        try {

            customers::find($request->get("id"))->delete();
            return redirect()->back();

        } catch (\Throwable $th) {

            return redirect()->back();

        }

    }


    public function Show_Customer(Request $request){


        $user = customers::find($request->get("id"));
        return view("UpdateCustomer", compact("user"));

    }


    public function Update_Customer(Request $request){

        try {
            
            $user = customers::find($request->get("id"));
            $user->update([
                "NationalCode" => $request->get("NationalCode"),
                "name" => $request->get("name"),
                "phone" => $request->get("phone"),
                "number" => $request->get("number"),
                "email" => $request->get("email"),
                "Investingin" => $request->get("Investingin"),
                "Amountofcapital" => $request->get("Amountofcapital"),
            ]);
    
            return redirect()->route("customermanagement");

        } catch (\Exception $ex) {
            
            return redirect()->back();

        }

    }

}
