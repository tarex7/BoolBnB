<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    //proteggo i dati
    private $sender;
    private $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sender, $message)
    {
        $this->sender = $sender;
        $this->message   = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->sender)
            ->markdown('emails.contacts_message')
            ->with(['message' => $this->message, 'sender' => $this->sender]);
    }
}
