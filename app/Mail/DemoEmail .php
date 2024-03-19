<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DemoEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function build()
    {
        return $this->from('playbazik@example.com', 'Playbaka')
                    ->subject('Sujet de email')
                    ->view('welcome');
    }
}
