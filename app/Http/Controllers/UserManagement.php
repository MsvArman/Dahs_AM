<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\users;
use RealRashid\SweetAlert\Facades\Alert;

class UserManagement extends Controller
{
    public function Show_Users(){
        $users = users::all();
        return view("UserManagement", compact("users"));
    }

    public function Create_User(Request $request){



        return dd($request);


        // $user = User::create([
        //     "name" => $request->get("name"),
        //     "mobile" => $request->get("mobile"),
        //     "phone" => $request->get("phone"),
        //     "phone2" => $request->get("phone2"),
        //     "role" => $request->get("role"),
        //     "password" => Hash::make($request->get("password")),
        // ]);

        Alert::success("موفق", "پروفایل شما با موفقیت ویرایش شد");
        // return redirect()->route("profile.my-profile.index");
    }
}
