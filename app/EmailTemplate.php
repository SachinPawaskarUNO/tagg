<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $fillable = [
        'template_type_id',
        'organization_id',
        'email_desc',
        'email_subject',
        'email_message',
        'email_header',
        'email_footer',
    ];

    public function emailTemplateTypes()
    {
        return $this->belongsTo('App\EmailTemplateType', 'template_type_id');
    }
}
