<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $recipient;
    protected $attachmentLocation;
    public $subject;
    public $content;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($recipient, $attachmentLocation, $subject, $content)
    {
        $this->recipient = $recipient;
        $this->attachmentLocation = $attachmentLocation;
        $this->subject = $subject;
        $this->content = $content;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'welcome',
        );
    }
       /**
        * Build the message.
        *
        * @return $this
        */
        public function build()
        {
            // your attachment location
            return $this->from($this->content, 'Expéditeur')
                        ->view('welcome')
                        ->attach($this->attachmentLocation)
                        ->to($this->recipient);
                        
        }
    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
