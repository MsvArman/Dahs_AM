<?php

namespace App\Http\Controllers;

use App\Models\CallHistorydb;
use App\Models\customers;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportsController extends Controller
{
    // public function date($date){
    //     $array_date = explode("/", $date);
    //     if(mb_strlen($array_date[1]) == 1){
    //         $array_date[1] = "0" . $array_date[1];
    //     }
    //     if(mb_strlen($array_date[2]) == 1){
    //         $array_date[2] = "0" . $array_date[2];
    //     }
    //     $compactDate = join("", $array_date);
    //     return $compactDate;
    // }

    public function show(){

        $customers = customers::join('callhistory', 'customers.NationalCode', '=', 'callhistory.NationalCode')
            ->groupBy('customers.NationalCode')
            ->get();

            return view("reports.show", compact("customers"));
    }


    public function give_report(Request $request){

        $customerNationalCode = $request->get("customers");
        $timeReport = $request->get("timeReport");

        if($customerNationalCode != "all"){
            if($timeReport == "all"){
                $incomingCall = CallHistorydb::all()->where("call", "incomingcall")->where("NationalCode", $customerNationalCode)->map(function($item){
                    if($item->mobileoperator != ""){
                        return $item->time;
                    }
                })->toArray();
                $outgoingCall = CallHistorydb::all()->where("call", "outgoingcall")->where("NationalCode", $customerNationalCode)->map(function($item){
                    if($item->mobileoperator != ""){
                        return $item->time;
                    }
                })->toArray();
                $incomingCallDontAnswer = CallHistorydb::all()->where("call", "incomingcall")->where("NationalCode", $customerNationalCode)->map(function($item){
                    if($item->mobileoperator == ""){
                        return $item->time;
                    }
                })->toArray();
                $outgoingCallDontAnswer = CallHistorydb::all()->where("call", "outgoingcall")->where("NationalCode", $customerNationalCode)->map(function($item){
                    if($item->mobileoperator == ""){
                        return $item->time;
                    }
                })->toArray();
            }else if($timeReport == "today"){

                $incomingCall = CallHistorydb::all()->where("call", "incomingcall")->where("NationalCode", $customerNationalCode)->map(function($item){
                    if($item->time > strtotime('today midnight') && $item->mobileoperator != ""){
                        return $item->time;
                    }
                })->toArray();

                $outgoingCall = CallHistorydb::all()->where("call", "outgoingcall")->where("NationalCode", $customerNationalCode)->map(function($item){
                    if($item->time > strtotime('today midnight') && $item->mobileoperator != ""){
                        return $item->time;
                    }
                })->toArray();
                $incomingCallDontAnswer = CallHistorydb::all()->where("call", "incomingcall")->where("NationalCode", $customerNationalCode)->map(function($item){
                    if($item->time > strtotime('today midnight') && $item->mobileoperator == ""){
                        return $item->time;
                    }
                })->toArray();
                $outgoingCallDontAnswer = CallHistorydb::all()->where("call", "outgoingcall")->where("NationalCode", $customerNationalCode)->map(function($item){
                    if($item->time > strtotime('today midnight') && $item->mobileoperator == ""){
                        return $item->time;
                    }
                })->toArray();


            }else if($timeReport == "weekly"){

                $incomingCall = CallHistorydb::all()->where("call", "incomingcall")->where("NationalCode", $customerNationalCode)->map(function($item){
                    if($item->time > strtotime("7 day ago") && $item->mobileoperator != ""){
                        return $item->time;
                    }
                })->toArray();
                $outgoingCall = CallHistorydb::all()->where("call", "outgoingcall")->where("NationalCode", $customerNationalCode)->map(function($item){
                    if($item->time > strtotime("7 day ago") && $item->mobileoperator != ""){
                        return $item->time;
                    }
                })->toArray();
                $incomingCallDontAnswer = CallHistorydb::all()->where("call", "incomingcall")->where("NationalCode", $customerNationalCode)->map(function($item){
                    if($item->time > strtotime("7 day ago") && $item->mobileoperator == ""){
                        return $item->time;
                    }
                })->toArray();
                $outgoingCallDontAnswer = CallHistorydb::all()->where("call", "outgoingcall")->where("NationalCode", $customerNationalCode)->map(function($item){
                    if($item->time > strtotime("7 day ago") && $item->mobileoperator == ""){
                        return $item->time;
                    }
                })->toArray();

            }else if($timeReport == "monthly"){

                $incomingCall = CallHistorydb::all()->where("call", "incomingcall")->where("NationalCode", $customerNationalCode)->map(function($item){
                    if($item->time > strtotime("1 month ago") && $item->mobileoperator != ""){
                        return $item->time;
                    }
                })->toArray();
                $outgoingCall = CallHistorydb::all()->where("call", "outgoingcall")->where("NationalCode", $customerNationalCode)->map(function($item){
                    if($item->time > strtotime("1 month ago") && $item->mobileoperator != ""){
                        return $item->time;
                    }
                })->toArray();
                $incomingCallDontAnswer = CallHistorydb::all()->where("call", "incomingcall")->where("NationalCode", $customerNationalCode)->map(function($item){
                    if($item->time > strtotime("1 month ago") && $item->mobileoperator == ""){
                        return $item->time;
                    }
                })->toArray();
                $outgoingCallDontAnswer = CallHistorydb::all()->where("call", "outgoingcall")->where("NationalCode", $customerNationalCode)->map(function($item){
                    if($item->time > strtotime("1 month ago") && $item->mobileoperator == ""){
                        return $item->time;
                    }
                })->toArray();


            }else if($timeReport == "yearly"){

                $incomingCall = CallHistorydb::all()->where("call", "incomingcall")->where("NationalCode", $customerNationalCode)->map(function($item){
                    if($item->time > strtotime("1 year ago") && $item->mobileoperator != ""){
                        return $item->time;
                    }
                })->toArray();
                $outgoingCall = CallHistorydb::all()->where("call", "outgoingcall")->where("NationalCode", $customerNationalCode)->map(function($item){
                    if($item->time > strtotime("1 year ago") && $item->mobileoperator != ""){
                        return $item->time;
                    }
                })->toArray();
                $incomingCallDontAnswer = CallHistorydb::all()->where("call", "incomingcall")->where("NationalCode", $customerNationalCode)->map(function($item){
                    if($item->time > strtotime("1 year ago") && $item->mobileoperator == ""){
                        return $item->time;
                    }
                })->toArray();
                $outgoingCallDontAnswer = CallHistorydb::all()->where("call", "outgoingcall")->where("NationalCode", $customerNationalCode)->map(function($item){
                    if($item->time > strtotime("1 year ago") && $item->mobileoperator == ""){
                        return $item->time;
                    }
                })->toArray();

            }
        }else{
            if($timeReport == "all"){
                $incomingCall = CallHistorydb::all()->where("call", "incomingcall")->map(function($item){
                    if($item->mobileoperator != ""){
                        return $item->time;
                    }
                })->toArray();
                $outgoingCall = CallHistorydb::all()->where("call", "outgoingcall")->map(function($item){
                    if($item->mobileoperator != ""){
                        return $item->time;
                    }
                })->toArray();
                $incomingCallDontAnswer = CallHistorydb::all()->where("call", "incomingcall")->map(function($item){
                    if($item->mobileoperator == ""){
                        return $item->time;
                    }
                })->toArray();
                $outgoingCallDontAnswer = CallHistorydb::all()->where("call", "outgoingcall")->map(function($item){
                    if($item->mobileoperator == ""){
                        return $item->time;
                    }
                })->toArray();
            }else if($timeReport == "today"){

                $incomingCall = CallHistorydb::all()->where("call", "incomingcall")->map(function($item){
                    if($item->time > strtotime('today midnight') && $item->mobileoperator != ""){
                        return $item->time;
                    }
                })->toArray();

                $outgoingCall = CallHistorydb::all()->where("call", "outgoingcall")->map(function($item){
                    if($item->time > strtotime('today midnight') && $item->mobileoperator != ""){
                        return $item->time;
                    }
                })->toArray();
                $incomingCallDontAnswer = CallHistorydb::all()->where("call", "incomingcall")->map(function($item){
                    if($item->time > strtotime('today midnight') && $item->mobileoperator == ""){
                        return $item->time;
                    }
                })->toArray();
                $outgoingCallDontAnswer = CallHistorydb::all()->where("call", "outgoingcall")->map(function($item){
                    if($item->time > strtotime('today midnight') && $item->mobileoperator == ""){
                        return $item->time;
                    }
                })->toArray();


            }else if($timeReport == "weekly"){

                $incomingCall = CallHistorydb::all()->where("call", "incomingcall")->map(function($item){
                    if($item->time > strtotime("7 day ago") && $item->mobileoperator != ""){
                        return $item->time;
                    }
                })->toArray();
                $outgoingCall = CallHistorydb::all()->where("call", "outgoingcall")->map(function($item){
                    if($item->time > strtotime("7 day ago") && $item->mobileoperator != ""){
                        return $item->time;
                    }
                })->toArray();
                $incomingCallDontAnswer = CallHistorydb::all()->where("call", "incomingcall")->map(function($item){
                    if($item->time > strtotime("7 day ago") && $item->mobileoperator == ""){
                        return $item->time;
                    }
                })->toArray();
                $outgoingCallDontAnswer = CallHistorydb::all()->where("call", "outgoingcall")->map(function($item){
                    if($item->time > strtotime("7 day ago") && $item->mobileoperator == ""){
                        return $item->time;
                    }
                })->toArray();

            }else if($timeReport == "monthly"){

                $incomingCall = CallHistorydb::all()->where("call", "incomingcall")->map(function($item){
                    if($item->time > strtotime("1 month ago") && $item->mobileoperator != ""){
                        return $item->time;
                    }
                })->toArray();
                $outgoingCall = CallHistorydb::all()->where("call", "outgoingcall")->map(function($item){
                    if($item->time > strtotime("1 month ago") && $item->mobileoperator != ""){
                        return $item->time;
                    }
                })->toArray();
                $incomingCallDontAnswer = CallHistorydb::all()->where("call", "incomingcall")->map(function($item){
                    if($item->time > strtotime("1 month ago") && $item->mobileoperator == ""){
                        return $item->time;
                    }
                })->toArray();
                $outgoingCallDontAnswer = CallHistorydb::all()->where("call", "outgoingcall")->map(function($item){
                    if($item->time > strtotime("1 month ago") && $item->mobileoperator == ""){
                        return $item->time;
                    }
                })->toArray();


            }else if($timeReport == "yearly"){

                $incomingCall = CallHistorydb::all()->where("call", "incomingcall")->map(function($item){
                    if($item->time > strtotime("1 year ago") && $item->mobileoperator != ""){
                        return $item->time;
                    }
                })->toArray();
                $outgoingCall = CallHistorydb::all()->where("call", "outgoingcall")->map(function($item){
                    if($item->time > strtotime("1 year ago") && $item->mobileoperator != ""){
                        return $item->time;
                    }
                })->toArray();
                $incomingCallDontAnswer = CallHistorydb::all()->where("call", "incomingcall")->map(function($item){
                    if($item->time > strtotime("1 year ago") && $item->mobileoperator == ""){
                        return $item->time;
                    }
                })->toArray();
                $outgoingCallDontAnswer = CallHistorydb::all()->where("call", "outgoingcall")->map(function($item){
                    if($item->time > strtotime("1 year ago") && $item->mobileoperator == ""){
                        return $item->time;
                    }
                })->toArray();

            }
        }

        return [count(array_filter($incomingCall)), count(array_filter($outgoingCall)), count(array_filter($incomingCallDontAnswer)), count(array_filter($outgoingCallDontAnswer))];

    }
}
