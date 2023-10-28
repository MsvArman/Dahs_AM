<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CallHistorydb;
use App\Models\customers;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class CallHistory extends Controller
{

    public function Show_Calls()
    {

        // $users = CallHistorydb::all()->sortBy("id");
        $users = CallHistorydb::orderBy('id')->get();


        return view("HistoryCall", compact("users"));


    }
    public function Show_Calls_refresh()
    {
        $users = CallHistorydb::orderBy('startcall', 'DESC')->get()->toArray();
        return $users;
    }

    public function Update_Calls()
    {

        // $users = CallHistorydb::all()->sortBy("id");
        $users = CallHistorydb::orderBy('id')->get();


        return $users;


    }


    public function Profile_Customer(Request $request)
    {

        $NationalCode = $request->get("NationalCode");
        $user = customers::where('NationalCode', $NationalCode)->first();

        // $calls = CallHistorydb::where('NationalCode', $NationalCode)->get();


        $tickets = CallHistorydb::where('NationalCode', $NationalCode)->orderBy("time")->get();
        // dd($ticket);

        // if ($calls) {
        //     $count = count($calls);

        //     if ($count == 0) {
        //         // oke
        //     } else {
        //         $end = $calls[$count - 1];
        //         return view("ProfileCustomer", compact("user", "calls", "NationalCode", "end"));
        //     }

        // }

        // return $end;

        return view("ProfileCustomer", compact("user", "NationalCode", "tickets"));


        // اپدیت کردن کدملی در دیتابیس مکلمات


    }

    public function Comment(Request $request)
    {

        try {

            $user = CallHistorydb::find($request->get("id"));

            if ($request->get("id")) {
                $user->update([
                    "comment" => $request->get("comment"),
                ]);
            }


            return redirect()->route("callhistory");

        } catch (\Exception $ex) {

            return redirect()->back();

        }

    }


    public function addTicket(Request $request)
    {
        // dd($request->all());

        $request->validate([
            "text" => "required",
            "NationalCode" => "required"
        ]);

        DB::beginTransaction();
        try {
            DB::commit();

            CallHistorydb::create([
                "operator_name" => auth()->user()->name,
                "comment" => $request->get("text"),
                "NationalCode" => $request->get("NationalCode"),
                "time" => time()
            ]);

            Alert::success("موفق", "پیام با موفقیت ارسال شد.");
            return redirect()->back();

        } catch (\Exception $ex) {
            DB::rollBack();
            Alert::error("نا موفق", $ex->getMessage());
            return redirect()->back();
        }
    }

}
