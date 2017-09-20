<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Securityquestion extends Model
{
    protected $fillable=[
        'user_id',
        'question1',
        'answer1',
        'question2',
        'answer2',
        'question3',
        'answer3'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
