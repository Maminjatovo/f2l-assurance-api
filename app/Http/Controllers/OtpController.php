<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class OtpController extends Controller
{

  /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $phoneNumber = $request->input('phone_number');

        $otp = mt_rand(100000, 999999);
        $twilio = new Client(config('services.twilio.sid'), config('services.twilio.auth_token'));
        $message = $twilio->messages->create(
            $phoneNumber,
            array(
                'from' => config('services.twilio.phone_number'),
                'body' => "Votre code OTP est : $otp"
            )
        );
    }


}
