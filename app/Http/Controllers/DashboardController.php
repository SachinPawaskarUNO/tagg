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
use App\Subscription;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->roleuser->role_id == Constant::ROOT_USER OR $request->user()->roleuser->role_id == Constant::TAGG_ADMIN OR $request->user()->roleuser->role_id == Constant::TAGG_USER) {
            // $organizations = Organization::all();
            $organizations = Organization::where('id', '!=', Constant::CHARITYQ_ID)->get(); // non CharityQ user selection
            $activeParent = Organization::active()->where('trial_ends_at', '>=', Carbon::now()->toDateTimeString())->pluck('id')->toArray();
            $activeOrgIds = ParentChildOrganizations::active()->whereIn('parent_org_id', $activeParent)->pluck('child_org_id')->toArray();
            $idCount = count($activeOrgIds);
            foreach ($activeParent as $key => $activeID) {
                $test = [$idCount => $activeID];
                $activeOrgIds = $activeOrgIds + $test;
                $idCount+= 1;
            }
            $activeLocations = Organization::whereIn('id', $activeOrgIds)->get();
            $numActiveLocations = count($activeLocations);
            // Only parent organizations have 'trial_ends_at' field in the Organizations table
            $organizationsArray = Organization::active()->where('trial_ends_at', '>=', Carbon::now()->toDateTimeString())->pluck('id')->toArray();
            // Counting the number of parent organizations
            $userCount = count($organizationsArray);
            $userThisWeek = Organization::active()->where('created_at', '>=', Carbon::now()->startOfWeek())->whereNotNull('trial_ends_at')->count();
            $userThisMonth = Organization::active()->where('created_at', '>=', Carbon::now()->startOfMonth())->whereNotNull('trial_ends_at')->count();
            $userThisYear = Organization::active()->where('created_at', '>=', Carbon::now()->startOfYear())->whereNotNull('trial_ends_at')->count();
            $avgAmountDonated = sprintf("%.2f", (DonationRequest::where('approval_status_id', Constant::APPROVED)->avg('approved_dollar_amount')));
            $rejectedNumber = DonationRequest::where('approval_status_id', Constant::REJECTED)->count();
            $approvedNumber = DonationRequest::where('approval_status_id', Constant::APPROVED)->count();
            $pendingNumber = DonationRequest::whereIn('approval_status_id', [Constant::PENDING_REJECTION, Constant::PENDING_APPROVAL])->count();
            $subscriptions = DB::table('subscriptions')->whereNotNull('organization_id')->get();
            return view('dashboard.admin-index', compact('organizations', 'avgAmountDonated', 'rejectedNumber', 'approvedNumber', 'pendingNumber', 'numActiveLocations', 'userCount', 'userThisWeek', 'userThisMonth', 'userThisYear','subscriptions'));
        } else {
            $organizationId = Auth::user()->organization_id;
            $organization = Organization::findOrFail($organizationId);
            $organizationName = $organization->org_name;
            $donationrequests = DonationRequest::whereIn('organization_id', $this->getAllMyOrganizationIds())
                ->whereIn('approval_status_id', [Constant::SUBMITTED, Constant::PENDING_REJECTION, Constant::PENDING_APPROVAL])->get();
            $amountDonated = DonationRequest::where('approval_status_id', Constant::APPROVED)->where('approved_organization_id', $organizationId)->sum('approved_dollar_amount');
            $rejectedNumber = DonationRequest::where('approval_status_id', Constant::REJECTED)->where('approved_organization_id', $organizationId)->count();
            $approvedNumber = DonationRequest::where('approval_status_id', Constant::APPROVED)->where('approved_organization_id', $organizationId)->count();
//            $pendingNumber = DonationRequest::whereIn('approval_status_id', [Constant::PENDING_REJECTION, Constant::PENDING_APPROVAL])-> count(); //where('approved_organization_id', $organizationId)->count();
            $pendingNumber = DonationRequest::whereIn('approval_status_id', [Constant::PENDING_REJECTION, Constant::PENDING_APPROVAL])->where('approved_organization_id', $organizationId)->count();

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

    public function destroy($id)
    {
        if (in_array($id, $this->getAllMyOrganizationIds())) {
            $organization = Organization::find($id);
            $organization->active = Constant::INACTIVE;
            $organization->save();
            $users = User::active()->where('organization_id', $id);
            $users->update(['active' => Constant::INACTIVE]);
            return redirect()->back()->with('message', 'Successfully deactivated the Business Location');
        } else {
            return redirect('organizations')->withErrors(array('0' => 'You do not have access to remove this Business!!'));
        }
    }
}
