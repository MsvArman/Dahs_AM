<?php

namespace App\Http\Controllers;

use App\Mail\send_message;
use App\Models\customers;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;
use RealRashid\SweetAlert\Facades\Alert;

class MessageController extends Controller
{
    public function submit_message(Request $request)
    {
        // dd(Message::all());
        $request->validate([
            "title" => "required",
            "text" => "required",
            "customer_id" => "required"
        ]);

        DB::beginTransaction();
        try {
            DB::commit();

            $user = customers::find($request->get("customer_id"));

            if ($request->has("send_to_email")) {
                $request->validate([
                    "send_to_email" => "required"
                ]);


                Message::create([
                    "customer_id" => $user->id,
                    "title" => $request->get("title"),
                    "text" => $request->get("text"),
                    "email_or_phone" => $user->email,
                ]);


                $content = [
                    'subject' => $request->get("title"),
                    'body' => $request->get("text")
                ];

                Mail::to($user->email)->send(new send_message($content));

            }

            if ($request->has("send_to_phone_number")) {
                $request->validate([
                    "send_to_phone_number" => "required"
                ]);


                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'http://www.aboorse.ir/SMS.php?Type=WebsiteVerificationCode&Mobile=' . $user->phone . '&VerificationCode=' . $request->get("text"),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                )
                );
                $response = curl_exec($curl);
                curl_close($curl);

                Message::create([
                    "customer_id" => $user->id,
                    "title" => $request->get("title"),
                    "text" => $request->get("text"),
                    "email_or_phone" => $user->phone,
                ]);

            }


            Alert::success("موفق", "پیام با موفقیت ارسال شد.");
            return redirect()->back();

        } catch (\Exception $ex) {
            DB::rollBack();
            Alert::error("نا موفق", $ex->getMessage());
            return redirect()->back();
        }
    }
}
