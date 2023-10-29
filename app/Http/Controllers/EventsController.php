<?php

namespace App\Http\Controllers;

use App\Models\events;
use App\Models\users;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class EventsController extends Controller
{
    // public function Show(){

    //     $operator = users::all();
    //     return view("ProfileCustomer", compact("operator"));

    // }


    public function store(Request $request){

        // return $request;

        $user_id = $request->get("user_id");
        $body = $request->get("body");
        $event_registration_date = time();
        $date_of_validity = $request->get("date_of_validity");
        $codemeli = $request->get("codemeli");
        $operator_id = $request->get("operator_id");
        $event_status = "باز";

        try {

            $event = events::create([
                "user_id" => $user_id,
                "operator_id" => $operator_id ,
                "body" => $body,
                "event_registration_date" => $event_registration_date,
                "date_of_validity" => $date_of_validity,
                "event_status" => $event_status,
                "codemeli" => $codemeli,

            ]);

            
            return redirect()->back();

        } catch (\Exception $ex) {

            // return redirect()->back();
            // return $request;

        }

    }
}
