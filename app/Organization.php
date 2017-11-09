<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class Organization extends Model
{
    use Notifiable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = [
        'trial_ends_at',
        'subscription_ends_at'
    ];

    protected $fillable = [
        'id',
        'org_name',
        'organization_type_id',
        'org_description',
        'street_address1',
        'street_address2',
        'city',
        'zipcode',
        'state',
        'phone_number',
        'required_days_notice',
        'monthly_budget',
        'trial_ends_at',
        'subscription_ends_at',
    ];

    protected $cardUpFront = false;

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function organizationType() {
        return $this->belongsTo('App\Organization_type');
    }

    public function parentChildOrganization() {
        return $this->hasMany('App\ParentChildOrganizations');
    }

    public function donationRequest()
    {
        return $this->hasMany('App\DonationRequest');
    }

}
