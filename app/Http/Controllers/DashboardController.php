<?php
/**
 * Created by PhpStorm.
 * User: SanKp
 * Date: 9/30/2017
 * Time: 9:51 PM
 */

namespace App\Http\Controllers;

use App\Custom\Constant;
use App\DonationRequest;
use App\Organization;
use App\ParentChildOrganizations;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->roleuser->role_id == 1 OR $request->user()->roleuser->role_id == 2 OR $request->user()->roleuser->role_id == 3) {
            $organizations = Organization::all();

            $orgIds = Organization::where('trial_ends_at', '>=', Carbon::now()->toDateTimeString())->pluck('id')->toArray();
            $organizationsArray = ParentChildOrganizations::whereIn('parent_org_id', $orgIds)->pluck('child_org_id')->toArray();
            array_push($organizationsArray, $orgIds);

            $numActiveLocations = sizeOf($organizationsArray);
            $userCount = User::whereIn('organization_id', $organizationsArray)->count();

            $userThisWeek = Organization::where('created_at', '>=', Carbon::now()->startOfWeek())->whereNotNull('trial_ends_at')->count();
            $userThisMonth = Organization::where('created_at', '>=', Carbon::now()->startOfMonth())->whereNotNull('trial_ends_at')->count();
            $userThisYear = Organization::where('created_at', '>=', Carbon::now()->startOfYear())->whereNotNull('trial_ends_at')->count();

            $avgAmountDonated = sprintf("%.2f", (DonationRequest::where('approval_status_id', Constant::APPROVED)->avg('approved_dollar_amount')));

            $rejectedNumber = DonationRequest::where('approval_status_id', Constant::REJECTED)->count();
            $approvedNumber = DonationRequest::where('approval_status_id', Constant::APPROVED)->count();
            $pendingNumber = DonationRequest::whereIn('approval_status_id', [Constant::PENDING_REJECTION, Constant::PENDING_APPROVAL])->count();

            return view('dashboard.admin-index', compact('organizations', 'avgAmountDonated', 'rejectedNumber', 'approvedNumber', 'pendingNumber', 'numActiveLocations', 'userCount', 'userThisWeek', 'userThisMonth', 'userThisYear'));
        } else {
            $organizationId = Auth::user()->organization_id;
            $organization = Organization::findOrFail($organizationId);

            $organizationName = $organization->org_name;
            $donationrequests = DonationRequest::whereIn('organization_id', $this->getAllMyOrganizationIds())
                ->whereIn('approval_status_id', [Constant::SUBMITTED, Constant::PENDING_REJECTION, Constant::PENDING_APPROVAL])->get();//dd($donationrequests);
            $amountDonated = DonationRequest::where('approval_status_id', Constant::APPROVED)->where('organization_id', $organizationId)->sum('approved_dollar_amount');
            $rejectedNumber = DonationRequest::where('approval_status_id', Constant::REJECTED)->where('organization_id', $organizationId)->count();
            $approvedNumber = DonationRequest::where('approval_status_id', Constant::APPROVED)->where('organization_id', $organizationId)->count();
            $pendingNumber = DonationRequest::whereIn('approval_status_id', [Constant::PENDING_REJECTION, Constant::PENDING_APPROVAL])->where('organization_id', $organizationId)->count();

            return view('dashboard.index', compact('donationrequests', 'organizationName', 'amountDonated', 'rejectedNumber', 'approvedNumber', 'pendingNumber'));
        }


    }

    protected function getAllMyOrganizationIds()
    {
        $organizationId = Auth::user()->organization->id;
        $orgIds = ParentChildOrganizations::where('parent_org_id', $organizationId)->pluck('child_org_id')->toArray();
        array_push($orgIds, $organizationId);
        return $orgIds;
    }

}