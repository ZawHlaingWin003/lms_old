<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZoomSDKController extends Controller
{
    function get_signature() {
        $this->signature = $this->generate_signature('28ax5tXtS1-I61z0kPhNHw', '7PFkldJvK5qTq3BAWXIdrlbLZmmgMiTNJc0S', '75858267441', 0);
        // dd($this->signature);
        return view('zoom.join', [
            "signature" => $this->signature
        ]);
    }

    function generate_signature ($api_key, $api_secret, $meeting_number, $role){
        //Set the timezone to UTC
        date_default_timezone_set("UTC");
        $time = time() * 1000 - 30000;//time in milliseconds (or close enough)
        $data = base64_encode($api_key . $meeting_number . $time . $role);
        $hash = hash_hmac('sha256', $data, $api_secret, true);
        $_sig = $api_key . "." . $meeting_number . "." . $time . "." . $role . "." . base64_encode($hash);
        //return signature, url safe base64 encoded
        return rtrim(strtr(base64_encode($_sig), '+/', '-_'), '=');
      }
}
