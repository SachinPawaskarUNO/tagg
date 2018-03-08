<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\DonationRequest;
use App\User;

class GotDonationRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $donationRequest;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(DonationRequest $donationRequest)
    {
        
        $this->donationRequest = $donationRequest;
        $esender = User::where('organization_id', $donationRequest->organization_id)->firstOrFail();
        $this->from($esender->email);
        }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your donation request is received.')
            ->markdown('emails.donationrequestmail');
    }
}
