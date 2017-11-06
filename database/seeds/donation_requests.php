<?php

use App\DonationRequest;
use Illuminate\Database\Seeder;

class donation_requests extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('donation_requests')->delete();

        DonationRequest::create([
            'id' => '1',
            'organization_id' => '1',
            'requester' => 'arthouse',
            'requester_type' => '2',
            'first_name' => 'Bob',
            'last_name' => 'Dylan',
            'email' => 'b@gmail.com',
            'phone_number' => '402-442-4448',
            'street_address1' => '7234 Dodge St',
            'street_address2' => 'Apt #8',
            'city' => 'Omaha',
            'state' => 'Nebraska',
            'zipcode' => '68116',
            'tax_exempt' => '0',
            'item_requested' => '2',
            'dollar_amount' => '50',
            'item_purpose' => '2',
            'other_item_purpose' => '1',
            'needed_by_date' => '2017-12-20',
            'event_name' => 'Charity',
            'event_type' => '1',
            'est_attendee_count' => '5',
            'event_start_date' => '2017-12-30',
            'event_end_date' => '2017-12-30',
            'venue' => 'Centurylink',
            'marketing_opportunities' => 'Yes',]);


        DonationRequest::create([
            'id' => '2',
            'organization_id' => '1',
            'requester' => 'Boystown',
            'requester_type' => '3',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'jd@gmail.com',
            'phone_number' => '402-522-5785',
            'street_address1' => '5455 L St',
            'street_address2' => 'Apt #2',
            'city' => 'Omaha',
            'state' => 'Nebraska',
            'zipcode' => '68126',
            'tax_exempt' => '0',
            'item_requested' => '1',
            'dollar_amount' => '100',
            'item_purpose' => '2',
            'other_item_purpose' => '1',
            'needed_by_date' => '2017-12-25',
            'event_name' => 'Charity',
            'event_type' => '1',
            'est_attendee_count' => '10',
            'event_start_date' => '2017-12-28',
            'event_end_date' => '2017-12-28',
            'venue' => 'Ralston',
            'marketing_opportunities' => 'Yes',]);

    }
}
