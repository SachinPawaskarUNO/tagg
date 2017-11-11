<?php
namespace App\Http\Controllers;
use App\Organization;
use App\ParentChildOrganizations;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Http\Controllers\WebhookController;

class SubscriptionController extends Controller
{
    protected $organization;

    public function getIndex()
    {
        $id = Auth::user()->organization_id;

        //if organization is child and it's sparent org does not have a active subscription redirect it to 'subscription expired' page
        $ischild = ParentChildOrganizations::where('child_org_id', '=', $id)->exists();
        $subscriptionends = Organization::findOrFail($id);
        if ($ischild) {
            
            $parentorgid = ParentChildOrganizations::where('child_org_id', $id)->value('parent_org_id');
            $subscriptionends = Organization::findOrFail($parentorgid);
            $organization = Organization::find($parentorgid);
            if($organization->subscribed('main')) {

                if ($subscriptionends->trial_ends_at->gte(Carbon::now())) {

                    return redirect('/dashboard');

                }
                else {

                    return view('subscriptions.expiredsubscription');

                }
            }
            else {

                return view('subscriptions.expiredsubscription');

            }

        }
        else {

            $organization = Organization::find($id);
            if($organization->subscribed('main')) {
                if ($subscriptionends->trial_ends_at->gte(Carbon::now())) {

                    return redirect('/dashboard');
                }
                else {

                    return view('subscriptions.payment');
                }
            }
            else {

                return view('subscriptions.payment');

            }
        }

    }

    public function validateCoupon($coupon)
    {
        $coupon_validate = \Stripe\Coupon::retrieve($coupon);
        if ($coupon_validate == '') {
            return false;
        } else {
            return true;
        }
    }
    public function postJoin(Request $request)
    {
        $id = Auth::user()->organization_id;
        $organization = Organization::find($id);
        $pickedPlan = $request->get('plan');
        $coupon = $request->get('coupon');
        if ($organization->subscribedToPlan($pickedPlan, 'main')) {
            return redirect('subscription')->with('status', 'Plan Already Submitted!');
        } else {

            if ($request->input('plan') == "annually") {
                if (isset($coupon)) {
                    $organization->newSubscription('main', $request->input('plan'))->withCoupon("OFF20")->withCoupon($coupon)->withMetadata(array('organization_id' => $organization->id))->quantity($request->input('user_locations'))->create($request->input('token'), [
                        'email' => $organization->org_name

                    ]);

                } else {
                    $organization->newSubscription('main', $request->input('plan'))->withCoupon("OFF20")->withMetadata(array('organization_id' => $organization->id))->quantity($request->input('user_locations'))->create($request->input('token'), [
                        'email' => $organization->org_name

                    ]);

                }
                $organization->trial_ends_at = Carbon::now()->addYear(1);
                $organization->save();
            } else {
                if ($request->input('plan') == "monthly") {
                    if (isset($coupon)) {
                        $organization->newSubscription('main', $request->input('plan'))->withCoupon($coupon)->withMetadata(array('organization_id' => $organization->id))->quantity($request->input('user_locations'))->create($request->input('token'), [
                            'email' => $organization->org_name
                        ]);

                    } else {
                        $organization->newSubscription('main', $request->input('plan'))->withMetadata(array('organization_id' => $organization->id))->quantity($request->input('user_locations'))->create($request->input('token'), [
                            'email' => $organization->org_name
                        ]);

                    }
                    $organization->trial_ends_at = Carbon::now()->addMonth(1);
                    $organization->save();
                }
            }

            return redirect('/dashboard')->with('status', 'Successfully Submitted!');

        }
    }

    public function chargeSuccess(Request $request)
    {
        $date = \Carbon\Carbon::now();
        $organization = organization::find(1);
        $webhook = new WebhookController;
        $arrData = $webhook->handleWebhook($request);
        $objHookObject = $arrData->object;
        $objMetaData = $objHookObject->metadata;
        $table = config('variables.tbl_subscription');
        $arrInsert = array('name' => 'main', 'stripe_id' => $arrData->object->id, 'stripe_plan' => $arrData->plan->id, 'quantity' => $arrData->quantity, 'organization_id' => $objMetaData->organization_id, 'created_at' => date('Y-m-d h:i:s', strtotime($date)), 'updated_at' => date('Y-m-d h:i:s', strtotime($date)));
        $data = DB::table($table)->insertGetId($arrInsert);

    }

    public function subscribe(Request $request)
    {
        return view('stripe.subscribe');
    }

}
