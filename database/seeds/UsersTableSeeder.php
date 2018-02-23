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
            'first_name' => 'root',
            'last_name' => 'admin',
            'user_name' => 'charityq@mailinator.com',
            'email' => 'charityq@mailinator.com',
            'password' => bcrypt('secret'),
            'organization_id' => '1',
            'street_address1' => '17117 Oak Drive',
            'street_address2' => 'Ste. A',
            'city' => 'Omaha',
            'zipcode' => '68130',
            'state' => 'NE',
            'phone_number' => '(402) 715-5230',]);


//        DB::table('users')->insert([
//            'id' => '3',
//            'first_name' => 'root2',
//            'last_name' => 'admin2',
//            'user_name' => 'cq@admin.com',
//            'email' => 'cq@admin.com',
//            'password' => bcrypt('secret'),
//            'organization_id' => '1',
//            'street_address1' => '17117 Oak Drive',
//            'street_address2' => 'Ste. A',
//            'city' => 'Omaha',
//            'zipcode' => '68130',
//            'state' => 'NE',
//            'phone_number' => '(402) 715-5230',]);

    }
}
