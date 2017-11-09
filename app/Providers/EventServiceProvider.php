<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\NewBusiness' => [
            'App\Listeners\SendWelcomeMail',
        ],
        'App\Events\PasswordUpdate' => [
            'App\Listeners\PasswordUpdateEmail',
        ],
        'App\Events\DonationRequestReceived' => [
            'App\Listeners\RequestReceivedMail',
        ],
        'App\Events\NewSubBusiness' => [
            'App\Listeners\SendWelcomeMailSubOrg',
        ],
        'App\Events\SendAutoRejectEmail' => [
            'App\Listeners\SendAutoRejectMessage',
        ],
        'App\Events\TriggerAcceptEmailEvent' => [
            'App\Listeners\TriggerAcceptMailView',
        ],
        'App\Events\TriggerRejectEmailEvent' => [
            'App\Listeners\TriggerRejectMailView',
        ],
        'App\Events\SendRemindersEvent' => [
            'App\Listeners\SendRemindersMessage',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
