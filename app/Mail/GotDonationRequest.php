<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\DonationRequest;
use App\User;
use App\Organization;
use App\ParentChildOrganizations;

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
        // 

        $p_org = ParentChildOrganizations::select('parent_org_id')->where('child_org_id', $donationRequest->organization_id)->pluck('parent_org_id')->first();
        
        if(is_null($p_org)){
            $p_org =  $donationRequest->organization_id;
        }

        $this->donationRequest->organization_id = $p_org;

        $esender = User::where('organization_id', $p_org)->firstOrFail();

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
