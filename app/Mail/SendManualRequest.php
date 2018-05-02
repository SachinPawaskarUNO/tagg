<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;
use App\ParentChildOrganizations;
use App\User;

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
        $this->email = $email;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $p_org = ParentChildOrganizations::select('parent_org_id')->where('child_org_id', $this->email->organization_id)->pluck('parent_org_id')->first();
        $usr = User::where('organization_id', $p_org)->firstOrFail();
        return $this->view('emails.decisionmail.senddecision')
            ->subject($this->email-> email_subject)
            ->from($usr->email);
    }
}
