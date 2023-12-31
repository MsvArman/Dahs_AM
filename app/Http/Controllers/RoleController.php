<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\role;
use RealRashid\SweetAlert\Facades\Alert;



class RoleController extends Controller
{
    public function Show_Roles(){


        $roles = role::orderBy('id')->get();
        // return $roles;

        return view("role", compact("roles"));


    }

    public function Create_Role(Request $request){



        try {

            $role = $request->get("role");

            $roles = role::create([
                "role" => $role
            ]);


            Alert::success('موفق', 'سمت مورد نظر با موفقیت ساخته شد');
            return redirect()->back();

        } catch (\Exception $ex) {
            Alert::error('ناموفق', 'سمت مورد نظر ساخته نشد!');
            return redirect()->back();

        }


    }


    public function Del_Role(Request $request)
    {

        try {

            role::where('role', $request->get("role"))->delete();
            Alert::success('موفق', 'سمت مورد نظر با موفقیت حذف شد');            return redirect()->back();

} catch (\Exception $ex) {
            DB::rollBack();
            Alert::error("نا موفق", $ex->getMessage());
            return redirect()->back();
        }
        

    }


}
