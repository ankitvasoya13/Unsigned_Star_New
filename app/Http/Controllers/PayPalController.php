<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Used to process plans
use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Common\PayPalModel;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

// use to process billing agreements
use PayPal\Api\Agreement;
use PayPal\Api\AgreementStateDescriptor;
use PayPal\Api\Payer;
use PayPal\Api\ShippingAddress;
use PayPal\Transport\PayPalRestCall;
use Session;
use DB;
use Auth;
use Carbon\Carbon;
use App\FrontUser;
use App\PaypalPlans;
use App\PaypalSubscribers;
use App\PaypalSubscriptions;

class PayPalController extends Controller
{
    private $apiContext;
    private $mode;
    private $client_id;
    private $secret;
    private $plan_id;

    // Create a new instance with our paypal credentials
    public function __construct()
    {
        // Detect if we are running in live mode or sandbox
        if (config('paypal.settings.mode') == 'live') {
            $this->client_id = config('paypal.live_client_id');
            $this->secret = config('paypal.live_secret');
            $this->plan_id = env('PAYPAL_LIVE_PLAN_ID', '');
        } else {
            $this->client_id = config('paypal.sandbox_client_id');
            $this->secret = config('paypal.sandbox_secret');
            $this->plan_id = env('PAYPAL_SANDBOX_PLAN_ID', '');
        }

        // Set the Paypal API Context/Credentials
        $this->apiContext = new ApiContext(new OAuthTokenCredential($this->client_id, $this->secret));
        $this->apiContext->setConfig(config('paypal.settings'));
    }

    public function PAYPAL_API($request)
    {
        $baseUrl = (env('PAYPAL_MODE') == 'live') ? 'https://api.paypal.com/v1' : 'https://api.sandbox.paypal.com/v1' ;
        $client = new \GuzzleHttp\Client();

        $res = $client->request($request['method'], $baseUrl.$request['urlPath'],
            [
                'headers' => ['Content-type' => 'application/json'],
                'auth' => [ $this->client_id, $this->secret ],
                'json' =>  $request['body'],
            ]);

        $data['body'] = json_decode($res->getBody(), TRUE);
        $data['statusCode'] = $res->getStatusCode();
        // $data['header'] = $res->getHeader('Content-Type')[0];
        $data['status'] = $res->getReasonPhrase();
        return $data;
    }

    public function add_plan(Request $request)
    {
        $states = array('ACTIVE', 'INACTIVE');
        $frequency = array('Year', 'Month', 'Week', 'Day');
        // $planDetails = Plan::get($request->id, $this->apiContext);
        // pr($planDetails);
        return view('admin.subscription-plan.create')->with(compact('states', 'frequency'));
    }

    public function create_plan(Request $request)
    {

        // Create a new billing plan
        $plan = new Plan();
        $plan->setName($request->name)
            ->setDescription($request->description)
            ->setType('INFINITE');

        // Set billing plan definitions
        $paymentDefinition = new PaymentDefinition();
        $paymentDefinition->setName('Regular Payments')
            ->setType('REGULAR')
            ->setFrequency($request->frequency)
            ->setFrequencyInterval('1')
            ->setCycles('0')
            ->setAmount(new Currency(array('value' => $request->price, 'currency' => 'USD')));

        // $chargeModel = new ChargeModel();
        // $chargeModel->setType('SHIPPING')->setAmount(new Currency(array('value' => 10, 'currency' => 'USD')));

        // $paymentDefinition->setChargeModels(array($chargeModel));

        // Set merchant preferences
        $merchantPreferences = new MerchantPreferences();
        $merchantPreferences->setReturnUrl(url('subscribe/paypal/return'))
            ->setCancelUrl(url('subscribe/paypal/return'))
            ->setAutoBillAmount('yes')
            ->setInitialFailAmountAction('CONTINUE')
            ->setMaxFailAttempts('0');
            // ->setSetupFee(new Currency(array('value' => 50, 'currency' => 'USD')));

        $plan->setPaymentDefinitions(array($paymentDefinition));
        $plan->setMerchantPreferences($merchantPreferences);

        //create the plan
        try {
            $createdPlan = $plan->create($this->apiContext);
            // pr($createdPlan);
            /*INSERT INTO DB*/
                if ($createdPlan) {
                    $plan              = new PaypalPlans();
                    $plan->plan_id     = $createdPlan->id;
                    $plan->plan_name   = $createdPlan->name;
                    $plan->description = $createdPlan->description;
                    $plan->price       = $createdPlan->payment_definitions[0]->amount->value;
                    $plan->frequency   = $createdPlan->payment_definitions[0]->frequency;
                    $plan->state       = $createdPlan->state;
                    $plan->track_limit = $request->track_limit;
                    $plan->save();
                }
            // try {
            //     $patch = new Patch();
            //     $value = new PayPalModel('{"state":"ACTIVE"}');
            //     $patch->setOp('replace')
            //         ->setPath('/')
            //         ->setValue($value);
            //     $patchRequest = new PatchRequest();
            //     $patchRequest->addPatch($patch);
            //     $createdPlan->update($patchRequest, $this->apiContext);
            //     // $plan = Plan::get($createdPlan->getId(), $this->apiContext);



            //     return redirect('/admin/plan/list/');
            //     // Output plan id
            //     // echo 'Plan ID:' . $plan->getId();
            // } catch (PayPal\Exception\PayPalConnectionException $ex) {
            //     echo $ex->getCode();
            //     echo $ex->getData();
            //     die($ex);
            // } catch (Exception $ex) {
            //     die($ex);
            // }
            return redirect('/admin/plan/list/');
        } catch (PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        } catch (Exception $ex) {
            die($ex);
        }
    }

    public function list_plan()
    {
        $param = array('page_size' => 10, 'status' => 'ALL');
        // $planList = Plan::get('P-8FD90874EP223363VPED4KVY', $this->apiContext);
        // $listPlans = Plan::all($param, $this->apiContext);
        $listPlans = PaypalPlans::all();
        // pr($listPlans);
        return view('admin.subscription-plan.index')->with(compact('listPlans'));
    }

    public function list_subscriber()
    {
        $listSubscribers = DB::table('front_users')
        ->rightJoin('paypal_subscribers', 'paypal_subscribers.user_id', '=', 'front_users.id')
        ->selectRaw('front_users.*, paypal_subscribers.plan_name, paypal_subscribers.last_payment_amount, paypal_subscribers.agreement_state')
        ->get();
        
        // pr($listSubscribers);

        // $listSubscribers = PaypalSubscribers::all();
        return view('admin.subscription-plan.subscriber-list')->with(compact('listSubscribers'));
    }

    public function edit_plan(Request $request, $id=null)
    {
        $states = array('ACTIVE', 'INACTIVE');
        $frequency = array('Year', 'Month', 'Week', 'Day');
        // $planDetails = Plan::get($request->id, $this->apiContext);
        $localPlan = PaypalPlans::where(['plan_id' => $id])->first();
// pr($localPlan);
        return view('admin.subscription-plan.edit')->with(compact('localPlan', 'states', 'frequency'));
    }

    public function update_plan(Request $request)
    {
        $localPlan = PaypalPlans::where(['plan_id' => $request->plan_id])->get();
        if (count($localPlan)) {
            PaypalPlans::where(['plan_id' => $request->id])->update([
                'track_limit' => $request->track_limit
                // 'first_cycle_price' => $request->first_cycle_price,
                // 'price' => $request->price
            ]);
            $paypalSubscribers = PaypalSubscribers::where(['plan_id' => $request->id])->orderBy('id','desc')->first();

            if($paypalSubscribers) {
                PaypalSubscribers::where(['plan_id' => $request->id])->update([
                    'track_limit' => $request->track_limit
                ]);
            }
        }
        return redirect('/admin/plan/list/');        
    }
    public function activate_plan(Request $request)
    {
        try {
            $createdPlan = new Plan();
            $createdPlan->id = $request->id;
            $patch = new Patch();
            $value = new PayPalModel('{
                "state":"ACTIVE"
            }');
            $patch->setOp('replace')
            ->setPath('/')
                ->setValue($value);
            $patchRequest = new PatchRequest();
            $patchRequest->addPatch($patch);
            $createdPlan->update($patchRequest, $this->apiContext);

            PaypalPlans::where(['plan_id' => $request->id])->update([
                'state' => "ACTIVATE",                
            ]);
            return redirect('/admin/plan/list/');
        } catch (Exception $ex) {
            pr("Updated the Plan to Active State", "Plan", null, $patchRequest, $ex);
            exit(1);
        }
    }
    public function deactivate_plan(Request $request)
    {
        // pr($request->all());
        try {
            $createdPlan = new Plan();
            $createdPlan->id = $request->id;
            $patch = new Patch();
            $value = new PayPalModel('{
                "state":"INACTIVE"
            }');
            $patch->setOp('replace')
            ->setPath('/')
                ->setValue($value);
            $patchRequest = new PatchRequest();
            $patchRequest->addPatch($patch);
            $createdPlan->update($patchRequest, $this->apiContext);
            PaypalPlans::where(['plan_id' => $request->id])->update([
                'state' => "INACTIVE",
            ]);
            return redirect('/admin/plan/list/');
        } catch (Exception $ex) {
            pr("Updated the Plan to DeActive State", "Plan", null, $patchRequest, $ex);
            exit(1);
        }
    }
    public function delete_plan(Request $request)
    {
        $plan_id = $request->id;
        $createdPlan = new Plan();
        $createdPlan->id = $plan_id;
        $patch = new Patch();

        // $value = new PayPalModel('{
	    //    "state":"DELETED"
	    //  }');

        // $patch->setOp('replace')
        // ->setPath('/')
        //     ->setValue($value);
        // $patchRequest = new PatchRequest();
        // $patchRequest->addPatch($patch);
        // $createdPlan->update($patchRequest, $this->apiContext);

        PaypalPlans::where(['plan_id' => $plan_id])->delete();

        return redirect('/admin/plan/list');
    }

   

    




    // Front User ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function plan_detail(Request $request, $id = null)
    {
        // pr(Session::all());
        $userDetails = DB::table('front_users')->where('email', '=', $request->session()->get('userSession'))->first();
        if ($userDetails) {
            $dateTime                   = Carbon::now();
            $currentDate                = $dateTime->toDateString();
            $datediff                   = strtotime($userDetails->end_validity) - strtotime($currentDate);
            $userDetails->remainingDays = round($datediff / (60 * 60 * 24));
            $planDetails                = Plan::get($id, $this->apiContext);
            // pr($planDetails);
            return view('plan_detail')->with(compact('userDetails', 'planDetails'));
        } else {
            return redirect('/dashboard');
        }        
    }
    public function plan_checkout(Request $request, $id = null)
    {
        // Get plan details
        $planDetails = Plan::get($id, $this->apiContext);
        
        // Create new agreement
        $agreement = new Agreement();
        $agreement->setName($planDetails->name)
        ->setDescription($planDetails->description)
        ->setStartDate(\Carbon\Carbon::now()->addMinutes(5)->toIso8601String());

        // Set plan id
        $plan = new Plan();
        // $plan->setId($this->plan_id);
        $plan->setId($planDetails->id);
        $agreement->setPlan($plan);

        // Add payer type
        $payer = new Payer();
        $payer->setPaymentMethod('bank');
        $agreement->setPayer($payer);

        try {
            // Create agreement
            $agreement = $agreement->create($this->apiContext);
            if (Session::get('userId')) {
                

                $newPlan = (object) [
                    'plan_id'              => $agreement->plan->id,
                    'plan_name'            => $agreement->name,
                    'plan_description'     => $agreement->description,
                    'plan_type'            => $agreement->plan->type,
                    'agreement_start_date' => $agreement->start_date
                ];
                Session::put('newPlan', $newPlan);
                
                // Extract approval URL to redirect user
                $approvalUrl = $agreement->getApprovalLink();
                return redirect($approvalUrl);
            } else {
                return redirect('/dashboard')->with('error', 'Please login with your artist account');
            }
            
        } catch (PayPal\Exception\PayPalConnectionException $ex) {
            Session::forget('newPlan');
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        } catch (Exception $ex) {
            Session::forget('newPlan');
            die($ex);
        }
    }

    public function paypalReturn(Request $request)
    {
        $token = $request->token;
        $agreement = new \PayPal\Api\Agreement();
        // $paypalSubscription = new PaypalSubscriptions();
        try {
            // Execute agreement
            $result = $agreement->execute($token, $this->apiContext);
            // $user = Auth::user();
            // $user->role = 'subscriber';
            // $user->paypal = 1;
            // if (isset($result->id)) {
            //     $user->paypal_agreement_id = $result->id;
            // }
            // $user->save();

            $newPlan = Session::get('newPlan');
            $oldSubscriber = PaypalSubscribers::where(['user_id' => Session::get('userId')])->get();
            
            if (count($oldSubscriber) > 0) {
                PaypalSubscribers::where(['user_id' => Session::get('userId')])->update([
                    'plan_id'              => $newPlan->plan_id,
                    'plan_name'            => $newPlan->plan_name,
                    'plan_description'     => $newPlan->plan_description,
                    'plan_type'            => $newPlan->plan_type,
                    'agreement_start_date' => $newPlan->agreement_start_date
                ]);
                echo "updated";
            } else {
                // Save plan details in subscriber table
                $newSubscriber                       = new PaypalSubscribers();
                $newSubscriber->user_id              = Session::get('userId');
                $newSubscriber->user_email           = Session::get('userSession');
                $newSubscriber->plan_id              = $newPlan->plan_id;
                $newSubscriber->plan_name            = $newPlan->plan_name;
                $newSubscriber->plan_description     = $newPlan->plan_description;
                $newSubscriber->plan_type            = $newPlan->plan_type;
                $newSubscriber->agreement_start_date = $newPlan->agreement_start_date;
                $newSubscriber->save();
                echo "Saved";
            }
            FrontUser::where(['id' => Session::get('userId')])->update([                
                'end_validity' => $result->agreement_details->next_billing_date
            ]);
            
            $planDetails = PaypalPlans::where(['plan_id' => $newPlan->plan_id])->first();
            
            PaypalSubscribers::where(['user_id' => Session::get('userId')])->update([                
                'track_limit'           => $planDetails->track_limit,
                'agreement_id'          => $result->id,
                'agreement_state'       => $result->state,
                'agreement_description' => $result->description,
                'agreement_start_date'  => $result->start_date,
                'payment_method'        => $result->payer->payment_method,
                'status'                => $result->payer->status,
                'payer_id'              => $result->payer->payer_info->payer_id,
                'payer_email'           => $result->payer->payer_info->email,
                'payer_first_name'      => $result->payer->payer_info->first_name,
                'payer_last_name'       => $result->payer->payer_info->last_name,
                'payer_status'          => $result->payer->status,
                'outstanding_balance'   => $result->agreement_details->outstanding_balance,
                'cycles_remaining'      => $result->agreement_details->cycles_remaining,
                'cycles_completed'      => $result->agreement_details->cycles_completed,
                'next_billing_date'     => $result->agreement_details->next_billing_date,
                'last_payment_date'     => $result->agreement_details->last_payment_date,
                // 'last_payment_amount'   => $result->agreement_details->last_payment_amount->value,
                // 'final_payment_date'    => $result->agreement_details->final_payment_date,
                'failed_payment_count'  => $result->agreement_details->failed_payment_count,
            ]);

            if ($result->agreement_details->last_payment_amount) {
                PaypalSubscribers::where(['user_id' => Session::get('userId')])->update([
                    'last_payment_date'     => $result->agreement_details->last_payment_date,
                    'last_payment_amount'   => $result->agreement_details->last_payment_amount->value,
                ]);
            }
            Session::forget('newPlan');
            return redirect('/dashboard')->with('success', 'Plan agrrement has been verified successfully. Please activate your plan after few minutes');
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            Session::forget('newPlan');
            return redirect('/dashboard')->with('error', 'You have either cancelled the request or your session has expired');            
        }
    }


    public function update_agreement(Request $request, $agreementId = null){
        try {
            $result = Agreement::get($agreementId, $this->apiContext);

            if ($result->state == 'Active') {
                FrontUser::where(['id' => Session::get('userId')])->update([
                    'end_validity' => $result->agreement_details->next_billing_date
                ]);

                PaypalSubscribers::where(['user_id' => Session::get('userId'), 'subscriptionID'=> $agreementId])->update([
                    'subscriptionID'          => $result->id,
                    // 'agreement_state'       => $result->state,
                    // 'agreement_description' => $result->description,
                    // 'agreement_start_date'  => $result->start_date,
                    'payment_method'        => $result->payer->payment_method,
                    'status'                => strtoupper($result->state),
                    'payer_id'              => $result->payer->payer_info->payer_id,
                    'payer_email'           => $result->payer->payer_info->email,
                    'payer_first_name'      => $result->payer->payer_info->first_name,
                    'payer_last_name'       => $result->payer->payer_info->last_name,
                    'payer_status'          => $result->payer->status,
                    'outstanding_balance'   => $result->agreement_details->outstanding_balance,
                    'cycles_remaining'      => $result->agreement_details->cycles_remaining,
                    'cycles_completed'      => $result->agreement_details->cycles_completed,
                    'next_billing_date'     => $result->agreement_details->next_billing_date,
                    'last_payment_date'     => $result->agreement_details->last_payment_date,
                    // 'last_payment_amount'   => $result->agreement_details->last_payment_amount->value,
                    // 'final_payment_date'    => $result->agreement_details->final_payment_date,
                    'failed_payment_count'  => $result->agreement_details->failed_payment_count,
                ]);

                if ($result->agreement_details->last_payment_amount) {
                    PaypalSubscribers::where(['user_id' => Session::get('userId')])->update([
                        'last_payment_date'     => $result->agreement_details->last_payment_date,
                        'last_payment_amount'   => $result->agreement_details->last_payment_amount->value,
                    ]);

                    return redirect('/dashboard')->with('success', 'Subscription has been updated successfully');
                }else{
                    return redirect('/dashboard')->with('error', 'Something is wrong, please try after 5 minutes.');
                }

            }else{

                $status1 =  'ACTIVE';
                $subscriptionID = $agreementId;

                $payPalSubscriptionData = PaypalSubscribers::where('subscriptionID', $subscriptionID)->first();

                $paypalPlanData = PaypalPlans::where('plan_id',$payPalSubscriptionData->plan_id)->first();

                if($paypalPlanData->status == 'INACTIVE'){
                    return back()->with('error', 'Your plan has been deactivated by administrator');
                }

                try {
                    // Subscription activate from suspended status
                    $request = array(
                        'method'  => 'POST',
                        'urlPath' => '/billing/subscriptions/'.$subscriptionID.'/activate',
                        'body' => ['reason' => 'Requested by user']
                    );
                    $res = $this->PAYPAL_API($request);

                    if ($res['statusCode'] == 204) {

                        PaypalSubscribers::where(['subscriptionID' => $subscriptionID])->update([
                            'status' => $status1,
                        ]);

                        //return redirect('/dashboard')->with('success', 'Subscription '.$status);

                        //After subscription activated agreement update
                        $result = Agreement::get($agreementId, $this->apiContext);

                        if ($result->state == 'Active') {
                            FrontUser::where(['id' => Session::get('userId')])->update([
                                'end_validity' => $result->agreement_details->next_billing_date
                            ]);

                        }
                        PaypalSubscribers::where(['user_id' => Session::get('userId'), 'subscriptionID'=> $agreementId])->update([
                            'subscriptionID'          => $result->id,
                            // 'agreement_state'       => $result->state,
                            // 'agreement_description' => $result->description,
                            // 'agreement_start_date'  => $result->start_date,
                            'payment_method'        => $result->payer->payment_method,
                            'status'                => strtoupper($result->state),
                            'payer_id'              => $result->payer->payer_info->payer_id,
                            'payer_email'           => $result->payer->payer_info->email,
                            'payer_first_name'      => $result->payer->payer_info->first_name,
                            'payer_last_name'       => $result->payer->payer_info->last_name,
                            'payer_status'          => $result->payer->status,
                            'outstanding_balance'   => $result->agreement_details->outstanding_balance,
                            'cycles_remaining'      => $result->agreement_details->cycles_remaining,
                            'cycles_completed'      => $result->agreement_details->cycles_completed,
                            'next_billing_date'     => $result->agreement_details->next_billing_date,
                            'last_payment_date'     => $result->agreement_details->last_payment_date,
                            // 'last_payment_amount'   => $result->agreement_details->last_payment_amount->value,
                            // 'final_payment_date'    => $result->agreement_details->final_payment_date,
                            'failed_payment_count'  => $result->agreement_details->failed_payment_count,
                        ]);

                        if ($result->agreement_details->last_payment_amount) {
                            PaypalSubscribers::where(['user_id' => Session::get('userId')])->update([
                                'last_payment_date'     => $result->agreement_details->last_payment_date,
                                'last_payment_amount'   => $result->agreement_details->last_payment_amount->value,
                            ]);

                           // return redirect('/dashboard')->with('success', 'Subscription has been updated successfully');
                        }else{
                            return redirect('/dashboard')->with('error', 'Something is wrong, please try after 5 minutes.');
                        }

                    }
                    // Subscription again suspended from activate status
                    /*$status2 =  'SUSPENDED';
                    $request1 = array(
                        'method'  => 'POST',
                        'urlPath' => '/billing/subscriptions/'.$subscriptionID.'/suspend',
                        'body' => ['reason' => 'Requested by user']
                    );
                    $res1 = $this->PAYPAL_API($request1);

                    if ($res1['statusCode'] == 204) {

                        PaypalSubscribers::where(['subscriptionID' => $subscriptionID])->update([
                            'status' => $status2,
                        ]);
                    }*/

                    return redirect('/dashboard')->with('success', 'Subscription has been updated successfully');
                } catch (\Throwable $th) {
                    return redirect('/dashboard')->with('error', 'Something is wrong'.$th);
                }

            }

            // return redirect('/dashboard')->with('success', 'Subscription has been updated successfully');
        } catch (Exception $ex) {
            return redirect('/dashboard')->with('error', 'Something is wrong, please try later.');
        }
    }

    public function suspend_agreement(Request $request, $agreementId = null)
    {
        $agreementStateDescriptor = new AgreementStateDescriptor();
        $agreementStateDescriptor->setNote("Suspending the agreement");
        $agreement = new Agreement();
        $agreement->id = $agreementId;
        try {
        $agreement->suspend($agreementStateDescriptor, $this->apiContext);
        $agreement = Agreement::get($agreement->getId(), $this->apiContext);
            return redirect('/subscribe/agreement_update/'.$agreement->getId());
        } catch (Exception $ex) {

        }
    }

    public function reactivate_agreement(Request $request, $agreementId = null)
    {
        $agreementStateDescriptor = new AgreementStateDescriptor();
        $agreementStateDescriptor->setNote("Reactivating the agreement");
        $agreement = new Agreement();
        $agreement->id = $agreementId;
        try {
            $agreement->reActivate($agreementStateDescriptor, $this->apiContext);
            $agreement = Agreement::get($agreement->getId(), $this->apiContext);
            return redirect('/subscribe/agreement_update/' . $agreement->getId());
        } catch (Exception $ex) {
        }
    }

    public function transaction(Request $request)
    {
        $agreement = new \PayPal\Api\Agreement();
        $params = array('start_date' => date('Y-m-d', strtotime('-15 years')), 'end_date' => date('Y-m-d', strtotime('+5 days')));
        $result = Agreement::searchTransactions('I-7E08E6HL1HCK', $params, $this->apiContext);
        pr($result);
    }

    public function auto_renewal_agreement(Request $request){

        try {

            $allSubscriber = PaypalSubscribers::all();

            $next_billing_date = array();
            $next_billing_date1 = array();
            $plan_array = array();
            $plan_array1 = array();

            foreach ($allSubscriber as $value){

                $agreementId = $value->subscriptionID;

                if($value->status == 'ACTIVE') {

                    $result = Agreement::get($agreementId, $this->apiContext);

                    if ($result->state == 'Active' && isset($result->agreement_details->next_billing_date)) {

                        $plan_array['subscriptionID'] = $result->id;
                        $plan_array['next_billing_date'] = $result->agreement_details->next_billing_date;
                        $plan_array['state'] = $result->state;

                        $next_billing_date[] = $plan_array;

                        FrontUser::where(['id' => $value->user_id])->update([
                            'end_validity' => $result->agreement_details->next_billing_date
                        ]);

                        PaypalSubscribers::where('user_id',$value->user_id)->where('subscriptionID',$value->subscriptionID)->update([
                            'subscriptionID'          => $result->id,

                            'payment_method'        => $result->payer->payment_method,
                            'status'                => strtoupper($result->state),
                            'payer_id'              => $result->payer->payer_info->payer_id,
                            'payer_email'           => $result->payer->payer_info->email,
                            'payer_first_name'      => $result->payer->payer_info->first_name,
                            'payer_last_name'       => $result->payer->payer_info->last_name,
                            'payer_status'          => $result->payer->status,
                            'outstanding_balance'   => $result->agreement_details->outstanding_balance,
                            'cycles_remaining'      => $result->agreement_details->cycles_remaining,
                            'cycles_completed'      => $result->agreement_details->cycles_completed,
                            'next_billing_date'     => $result->agreement_details->next_billing_date,
                            'last_payment_date'     => $result->agreement_details->last_payment_date,
                            'failed_payment_count'  => $result->agreement_details->failed_payment_count,
                        ]);

                        if ($result->agreement_details->last_payment_amount) {
                            PaypalSubscribers::where(['user_id' => $value->user_id])->update([
                                'last_payment_date'     => $result->agreement_details->last_payment_date,
                                'last_payment_amount'   => $result->agreement_details->last_payment_amount->value,
                            ]);
                        }
                    }else{
                        PaypalSubscribers::where('user_id',$value->user_id)->where('subscriptionID',$value->subscriptionID)->update([
                            'subscriptionID'          => $result->id,
                            'payment_method'        => $result->payer->payment_method,
                            'status'                => strtoupper($result->state),
                            'payer_id'              => $result->payer->payer_info->payer_id,
                            'payer_email'           => $result->payer->payer_info->email,
                            'payer_first_name'      => $result->payer->payer_info->first_name,
                            'payer_last_name'       => $result->payer->payer_info->last_name,
                            'payer_status'          => $result->payer->status,
                            'outstanding_balance'   => $result->agreement_details->outstanding_balance,
                            'cycles_remaining'      => $result->agreement_details->cycles_remaining,
                            'cycles_completed'      => $result->agreement_details->cycles_completed,
                            'last_payment_date'     => $result->agreement_details->last_payment_date,
                            'failed_payment_count'  => $result->agreement_details->failed_payment_count,
                        ]);
                    }
                }else{

                    $result = Agreement::get($agreementId, $this->apiContext);

                    PaypalSubscribers::where('user_id',$value->user_id)->where('subscriptionID',$value->subscriptionID)->update([
                        'subscriptionID'          => $result->id,
                        'payment_method'        => $result->payer->payment_method,
                        'status'                => strtoupper($result->state),
                        'payer_id'              => $result->payer->payer_info->payer_id,
                        'payer_email'           => $result->payer->payer_info->email,
                        'payer_first_name'      => $result->payer->payer_info->first_name,
                        'payer_last_name'       => $result->payer->payer_info->last_name,
                        'payer_status'          => $result->payer->status,
                        'outstanding_balance'   => $result->agreement_details->outstanding_balance,
                        'cycles_remaining'      => $result->agreement_details->cycles_remaining,
                        'cycles_completed'      => $result->agreement_details->cycles_completed,
                        'last_payment_date'     => $result->agreement_details->last_payment_date,
                        'failed_payment_count'  => $result->agreement_details->failed_payment_count,
                    ]);

                    $plan_array1['subscriptionID'] = $result->id;
                    $plan_array1['state'] = $result->state;

                    $next_billing_date1[] = $plan_array1;
                }
            }

            /*echo "<pre>";
            print_r($next_billing_date);
            print_r($next_billing_date1);
            exit();*/
            // return redirect('/dashboard')->with('success', 'Subscription has been updated successfully');
        } catch (Exception $ex) {
            return redirect('/dashboard')->with('error', 'Something is wrong, please try later.');
        }
    }
}
