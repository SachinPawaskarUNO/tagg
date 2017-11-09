<?php
/**
 * Created by PhpStorm.
 * User: SanKp
 * Date: 9/30/2017
 * Time: 9:51 PM
 */

namespace App\Http\Controllers;

use Auth;
use App\Organization;
use App\DonationRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $organizationId = Auth::user()->organization_id;
        $organization = Organization::findOrFail($organizationId);

        $organizationName = $organization->org_name;
        $donationrequests = DonationRequest::where('organization_id', '=', $organizationId)->whereIn('approval_status_id', [1, 2, 3])->get();
        $amountDonated = DonationRequest::where('approval_status_id', 5)->where('organization_id', $organizationId)->sum('dollar_amount');
        $rejectedNumber = DonationRequest::where('approval_status_id', 4)->where('organization_id', $organizationId)->count();
        $approvedNumber = DonationRequest::where('approval_status_id', 5)->where('organization_id', $organizationId)->count();
        $pendingNumber = DonationRequest::whereIn('approval_status_id', [2, 3])->where('organization_id', $organizationId)->count();

        return view('dashboard.index', compact('donationrequests', 'organizationName', 'amountDonated', 'rejectedNumber', 'approvedNumber', 'pendingNumber'));
    }

    public function indexTaggAdmin() {

        $organizations = Organization::all();
        $amountDonated = DonationRequest::where('approval_status_id', 5)->sum('dollar_amount');
        $rejectedNumber = DonationRequest::where('approval_status_id', 4)->count();
        $approvedNumber = DonationRequest::where('approval_status_id', 5)->count();
        $pendingNumber = DonationRequest::whereIn('approval_status_id', [2, 3])->count();
        return view('dashboard.admin-index', compact('organizations', 'amountDonated', 'rejectedNumber', 'approvedNumber', 'pendingNumber'));
        
    }
}