<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\DonationRequest;

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
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@charityq.com')
            ->subject('Thank you for Donation')
            ->markdown('emails.donationrequestmail');
    }
}
