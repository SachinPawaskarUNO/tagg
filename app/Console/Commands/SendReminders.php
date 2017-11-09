<?php

namespace App\Console\Commands;

use App\DonationRequest;
use App\Events\SendRemindersEvent;
use App\Organization;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SendReminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
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
        $organizations = Organization::all();

        foreach ($organizations as $organization) {
            $countPendingDonationRequests = DonationRequest::where('organization_id', $organization->id)
                ->wherenotin('approval_status_id', array(4, 5))
                ->where('needed_by_date', '<', Carbon::now()->addDays(21))->count();

            $users = User::where('organization_id', $organization->id)->get();

            foreach ($users as $user) {
                $email = $user->email;
                $name = $user->first_name;
//                $this->info($name);
//                $this->info($email);
//                $this->info($organization->org_name);
//                $this->info($countPendingDonationRequests);
                event(new SendRemindersEvent($email, $name, $organization->org_name, $countPendingDonationRequests));
            }
        }
    }
}
