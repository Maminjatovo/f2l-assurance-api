<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Twilio\Rest\Client;
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

    protected function sendOtpCode(Request $request) {
        $phoneNumber=$request->phone_number;
        try{

            $twilioSid = getenv("TWILIO_SID");
            $twilioToken = getenv("TWILIO_AUTH_TOKEN");
            $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
            $twilio = new Client($twilioSid, $twilioToken);

            $verification = $twilio->verify->v2->services($twilio_verify_sid)
                ->verifications
                ->create($phoneNumber, "sms");

            return response()->json([
                'status' => 'success',
                'message' => $verification->sid,
            ],200);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    protected function verifyOTP(Request $request) {
        $phoneNumber = $request->phone_number;
        $otp = $request->opt_code;
        $twilioSid = getenv("TWILIO_SID");
        $twilioToken = getenv("TWILIO_AUTH_TOKEN");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilioSid, $twilioToken);

        try {
            $verificationCheck = $twilio->verify->v2->services($twilio_verify_sid)
                ->verificationChecks
                ->create([
                    'code' => $otp,
                    'to' => $phoneNumber
                ]);

            if ($verificationCheck->valid) {
                return response()->json([
                    'status' => 'success',
                    'message' => "LE CODE EST VALIDE"
                ],200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => "LE CODE EST INVALIDE"
                ],200);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }




}
