<?php

namespace App\Listeners;

use App\Events\SendRemindersEvent;
use App\Mail\SendRemindersMail;
use Illuminate\Support\Facades\Mail;

class SendRemindersMessage
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
     * @param  SendRemindersEvent $event
     * @return void
     */
    public function handle(SendRemindersEvent $event)
    {
        Mail::to($event->email)->send(new SendRemindersMail($event));
    }
}
