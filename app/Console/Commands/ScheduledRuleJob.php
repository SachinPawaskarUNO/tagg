<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

/*
const REJECTED = 'Rejected';

const APPROVED = 'Approved';
*/

class ScheduledRuleJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CronJob:scheduledrulejob';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Request status updated successfully.';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        date_default_timezone_set("America/Belize");

        app('App\Http\Controllers\RuleEngineController')->runBudgetCheckRule();
        app('App\Http\Controllers\RuleEngineController')->runMinimumNoticeCheckRule();
        Log::error('Donation Requests over budget has been updated To Pending Rejection!');
        $this->error('Request Status Updated Successfully!');
    }
}
