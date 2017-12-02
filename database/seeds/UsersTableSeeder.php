<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'id' => '1',
            'first_name' => 'Rahul',
            'last_name' => 'Dravid',
            'user_name' => 'email1@mailinator.com',
            'email' => 'email1@mailinator.com',
            'password' => bcrypt('password'),
            'organization_id' => '1',
            'street_address1' => 'Root User',
            'street_address2' => 'Root User',
            'city' => 'Root',
            'zipcode' => '67654',
            'state' => 'LA',
            'phone_number' => '9876543210',]);

        User::create([
            'id' => '2',
            'first_name' => 'Zaheer',
            'last_name' => 'Khan',
            'user_name' => 'email2@mailinator.com',
            'email' => 'email2@mailinator.com',
            'password' => bcrypt('password'),
            'organization_id' => '1',
            'street_address1' => 'CharityQ Owner',
            'street_address2' => 'CharityQ Owner',
            'city' => 'CharityQ',
            'zipcode' => '67654',
            'state' => 'NE',
            'phone_number' => '9876543210',]);

        User::create([
            'id' => '3',
            'first_name' => 'Sachin',
            'last_name' => 'Tendulkar',
            'user_name' => 'email3@mailinator.com',
            'email' => 'email3@mailinator.com',
            'password' => bcrypt('password'),
            'organization_id' => '1',
            'street_address1' => 'CharityQ user',
            'street_address2' => 'CharityQ user',
            'city' => 'CharityQ',
            'zipcode' => '67654',
            'state' => 'NE',
            'phone_number' => '9876543210',]);

        User::create([
            'id' => '4',
            'first_name' => 'Gil',
            'last_name' => 'Christ',
            'user_name' => 'email4@mailinator.com',
            'email' => 'email4@mailinator.com',
            'password' => bcrypt('password'),
            'organization_id' => '1',
            'street_address1' => 'business admin',
            'street_address2' => 'business admin',
            'city' => 'CharityQ',
            'zipcode' => '67654',
            'state' => 'NE',
            'phone_number' => '9876543210',]);

        User::create([
            'id' => '5',
            'first_name' => 'Wasim',
            'last_name' => 'Akram',
            'user_name' => 'email5@mailinator.com',
            'email' => 'email5@mailinator.com',
            'password' => bcrypt('password'),
            'organization_id' => '1',
            'street_address1' => 'business user',
            'street_address2' => 'business user',
            'city' => 'CharityQ',
            'zipcode' => '67654',
            'state' => 'NE',
            'phone_number' => '9876543210',]);

        User::create([
            'id' => '6',
            'first_name' => 'Fabio',
            'last_name' => 'Lanzoni',
            'user_name' => 'email6@mailinator.com',
            'email' => 'email6@mailinator.com',
            'password' => bcrypt('password'),
            'organization_id' => '2',
            'street_address1' => 'business user',
            'street_address2' => 'business user',
            'city' => 'CharityQ',
            'zipcode' => '67654',
            'state' => 'NE',
            'phone_number' => '9876543210',]);

        User::create([
            'id' => '7',
            'first_name' => 'Reginald',
            'last_name' => 'Howe',
            'user_name' => 'email7@mailinator.com',
            'email' => 'email7@mailinator.com',
            'password' => bcrypt('password'),
            'organization_id' => '3',
            'street_address1' => 'business user',
            'street_address2' => 'business user',
            'city' => 'CharityQ',
            'zipcode' => '67654',
            'state' => 'NE',
            'phone_number' => '9876543210',]);
    }
}
