<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\users;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;

class UserManagement extends Controller
{

    public function Show_Users(){

        $users = users::all();
        return view("UserManagement", compact("users"));

    }


    public function Create_User(Request $request){

        try {

            $user = users::create([
                "name" => $request->get("name"),
                "email" => $request->get("email"),
                "mobile" => $request->get("mobile"),
                "phone" => $request->get("phone"),
                "phone2" => $request->get("phone2"),
                "role" => $request->get("role"),
                "password" => Hash::make($request->get("password")),
            ]);
    
            return redirect()->route("usermanagement");

        } catch (\Exception $ex) {
            
            return redirect()->back();

        }

    }



    public function destroy(Request $request)
    {

        try {

            users::find($request->get("id"))->delete();
            return redirect()->back();

        } catch (\Throwable $th) {

            return redirect()->back();

        }

    }


    public function Show_User(Request $request){

        $user = users::find($request->get("id"))->get();
        return view("UpdateUser", compact("user"));

    }


    public function Update_User(Request $request){

        try {

            $user->update([
                "name" => $request->get("name"),
                "email" => $request->get("email"),
                "mobile" => $request->get("mobile"),
                "phone" => $request->get("phone"),
                "phone2" => $request->get("phone2"),
                "role" => $request->get("role"),
                // "password" => Hash::make($request->get("password")),
            ]);
    
            return redirect()->route("usermanagement");

        } catch (\Exception $ex) {
            
            return redirect()->back();

        }

    }

}
