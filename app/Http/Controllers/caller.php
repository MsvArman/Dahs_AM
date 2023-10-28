<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class caller extends Controller
{
    public function caller(Request $request){

        $number = $request->get("number");
        $ext = $request->get("ext");
        $id = time();
        $ip = '176.65.253.69';

        // $curl = curl_init();
        // curl_setopt_array($curl, array(
        //   CURLOPT_URL => 'http://'.$ip.'/Api/ApiDial.php?number='.$number.'&ext='.$ext.'&id='.$id.'&codemeli='.$id,
        //   CURLOPT_RETURNTRANSFER => true,
        //   CURLOPT_ENCODING => '',
        //   CURLOPT_MAXREDIRS => 10,
        //   CURLOPT_TIMEOUT => 0,
        //   CURLOPT_FOLLOWLOCATION => true,
        //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //   CURLOPT_CUSTOMREQUEST => 'GET',
        // ));


            
        $url="https://$ip/Api/ApiDial.php?number=$number&ext=$ext&id=$id&codemeli=$id";
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false
            ]
        ]);
        
        $content = file_get_contents($url, false, $context);
        // echo $content;
        
        // $response = curl_exec($curl);
        // curl_close($curl);
        // echo $response;
        
        if($content){

            Alert::success('تماس موفق', 'تماس با موفقیت برقرار شد');

        }else{

            Alert::error('تماس ناموفق', 'متاسفانه در برقراری تماس مشکلی پیش آمده');

        }
       
        return redirect()->back();
     
    }
}
