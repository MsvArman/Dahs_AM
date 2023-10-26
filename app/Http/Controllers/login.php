<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class login extends Controller
{
    public function user_login(Request $request){

        $user = users::where("email", $request->get("email"))->first();

        if ($user){

            if(Hash::check($request->get("password"), $user->password)){
                Auth::loginUsingId($user->id);
                // return ["login_success", $user->id, auth()->user()];
                return redirect()->route("main");
            }
            return ["warn_password"];

        }else{
            return ["warn_email"];
        }


    }

    public function logout()
    {
        if (Auth::user()) {
            Auth::logout();
        }
        return redirect()->route("login");
    }

}
