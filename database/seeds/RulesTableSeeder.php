<?php

use Illuminate\Database\Seeder;
use App\Rule;

class RulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rules')->delete();
        Rule::create(['id' => 1, 'rule_type_id' => 1, 'rule_owner_id' => 1, 'active' => true,
            'rule' => "{ \"condition\": \"OR\", \"rules\": [ { \"id\": \"requester\", \"field\": \"requester\", \"type\": \"string\", \"input\": \"text\", \"operator\": \"contains\", \"value\": \"tool\" }, { \"id\": \"needed_by_date\", \"field\": \"needed_by_date\", \"type\": \"datetime\", \"input\": \"text\", \"operator\": \"less_or_equal\", \"value\": \"10/22/2017\" } ], \"not\": false, \"valid\": true }"
        ]);
        Rule::create(['id' => 2, 'rule_type_id' => 2, 'rule_owner_id' => 1, 'active' => true,
            'rule' => "{  \"condition\": \"AND\",  \"rules\": [ {\"id\": \"dollar_amount\",\"field\": \"dollar_amount\",\"type\": \"double\",\"input\": \"number\",\"operator\": \"less\",\"value\": \"300\" }, {\"id\": \"requester_type\",\"field\": \"requester_type\",\"type\": \"integer\",\"input\": \"checkbox\",\"operator\": \"in\",\"value\": [  \"1\",  \"4\",  \"8\"] }  ],  \"not\": false,  \"valid\": true};"
        ]);
    }
}
