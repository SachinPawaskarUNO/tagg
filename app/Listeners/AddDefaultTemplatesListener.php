<?php

namespace App\Listeners;

use App\Custom\Constant;
use App\EmailTemplate;
use App\Events\AddDefaultTemplates;

class AddDefaultTemplatesListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AddDefaultTemplates  $event
     * @return void
     */
    public function handle(AddDefaultTemplates $event)
    {

        //get default templates for Accept and Reject donations email templates from TAGG.
        $emailtemplates = EmailTemplate::where('organization_id', 1)->whereIn('template_type_id', [Constant::REQUEST_APPROVED,Constant::REQUEST_APPROVED_DEFAULT, Constant::REQUEST_REJECTED,Constant::REQUEST_REJECTED_DEFAULT])->get();

        foreach ($emailtemplates as $emailtemplate) {

            EmailTemplate::create(['template_type_id' => $emailtemplate->template_type_id, 'organization_id' => $event->orgid, 'email_desc' => $emailtemplate->email_desc,  'email_subject' => $emailtemplate->email_subject, 'email_message' => $emailtemplate->email_message]);
        }
    }
}
