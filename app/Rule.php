<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $casts = [
        'rule_type_id' => 'int',
        'rule_owner_id' => 'int',
        'orgtype' => 'json', // casting to array for storing donation request preferences in json format
        'dntype' => 'json', // casting to array for storing donation request preferences in json format
        'taxex' => 'boolean',
        'active' => 'boolean',
    ];
    protected $fillable = ['rule_type_id', 'rule_owner_id', 'orgtype', 'dntype', 'amtreq', 'active' ];
    public function ruleType() {
        return $this->belongsTo('App\Rule_type', 'rule_type_id', 'id');
    }
}
