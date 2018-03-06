<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class RegistrationSuccessful extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $emailTemplate;
    public $userName;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    //public function __construct()
    public function __construct($emailTemplate, User $user)
    {
        $this->user = $user;
        $this->emailTemplate = $emailTemplate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $this->userName = $this->user->first_name.' '.$this->user->last_name;
        // Adding first name only in email template.
        $this->userName = $this->user->first_name;
        $this->emailTemplate->email_message = str_replace('{Addressee}', $this->userName, $this->emailTemplate->email_message);
        $this->emailTemplate->email_message = str_replace('{My Business}', getenv('APP_NAME'), $this->emailTemplate->email_message);
        return $this ->from('noreply@charityq.com')
                     ->subject($this->emailTemplate->email_subject)
                     ->view('emails.user.welcomemail');
    }
}
