<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->command->info("Roles table seeded");
        $this->call(StatesTableSeeder::class);
        $this->call(email_template_types::class);
        $this->call(Approval_statusesTableSeeder::class);
        $this->call(Security_questionsTableSeeder::class);
        $this->call(RuleTypesTableSeeder::class);
        $this->call(Organization_typesTableSeeder::class);
        $this->call(RequesterTypesTableSeeder::class);
        $this->call(Request_item_typesTableSeeder::class);
        $this->call(Request_item_purposesTableSeeder::class);
        $this->call(Request_event_typesTableSeeder::class);
        $this->call(OrganizationsTableSeeder::class);
        $this->command->info("Organizations table seeded");
        $this->call(UsersTableSeeder::class);
        $this->call(RulesTableSeeder::class);
        $this->call(email_template::class);
        $this->command->info("Users table seeded");
        $this->call(RolesUserTableSeeder::class);
        $this->command->info("role_user table seeded");
        $this->call(donation_requests::class);
        $this->command->info("donation_requests table seeded");
    }
}
