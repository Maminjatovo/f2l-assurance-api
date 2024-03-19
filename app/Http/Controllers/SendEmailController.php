<?php
namespace App\Http\Controllers;
use App\Mail\SendMail;
use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class SendEmailController extends Controller
{
     public function index(Request $request)
    {

        try{
            $nom = $request->nom;
            $email = $request->email;
            $phone = $request->phone;
            $message = $request->message;


            $content = $nom . " (" . $email . ") : " . $message;

            $recipient = 'playbazik@gmail.com';
            $subject = 'Document';
            Mail::to($recipient)->send(new SendMail($recipient, $subject, $content));

            return response()->json(['status' => 'success', 'message' => 'Email sent successfully']);
          }catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
        }

  // try{
        //     $recipient = 'playbazik@gmail.com';
        //     $message = 'Ceci est un message de test.';
        //     Mail::to($recipient)->send(new SendMail($message));

        //     return response()->json(['status' => 'success', 'message' => 'Email envoye']);
        //   }catch (\Exception $e) {
        // return response()->json(['error' => $e->getMessage()], 500);
        // }
    }
}
