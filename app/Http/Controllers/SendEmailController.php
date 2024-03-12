<?php
namespace App\Http\Controllers;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;


use Illuminate\Http\Request;

class SendEmailController extends Controller
{
     public function index()
    {

            $content ="email@gmail.com";
            $recipient = 'playbazik@gmail.com';
            $attachmentLocation = public_path('neymar.jpg');
            $subject = 'sujet mail';
            Mail::to($content)->send(new SendMail($recipient, $attachmentLocation, $subject, $content));

            return response()->json(['status' => 'success', 'message' => 'Email sent successfully']);
        //} catch (\Exception $e) {
          //  return response()->json(['error' => 'Failed to send email. Please try again later.'], 500);
       // }


    }
}
