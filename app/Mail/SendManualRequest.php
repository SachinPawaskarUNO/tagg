<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;

class SendManualRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $email;
    public function __construct($email)
    {
        $this-> email = $email;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('emails.decisionmail.senddecision')
            ->subject($this->email-> email_subject)
            ->from(Auth::user()->email);
    }
}
