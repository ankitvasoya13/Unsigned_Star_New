<?php

namespace App\Http\Controllers;
use App\PaypalPlans;
use App\PaypalSubscribers;
use App\FrontUser;
use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;

class PaypalAPIController extends Controller
{
    // Create a new instance with our paypal credentials
    public function __construct()
    {
        if (env('PAYPAL_MODE') == 'live') {
            $this->client_id = env('PAYPAL_LIVE_CLIENT_ID');
            $this->secret = env('PAYPAL_LIVE_SECRET');
            $this->product_id = env('PAYPAL_PRODUCT_ID');
        } else {
            $this->client_id = env('PAYPAL_SANDBOX_CLIENT_ID');
            $this->secret = env('PAYPAL_SANDBOX_SECRET');
            $this->product_id = env('PAYPAL_PRODUCT_ID');
        }
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
    public function index(Request $request)
    {
        $request = array(
            'method'  => 'GET',
            'urlPath' => '/billing/subscriptions/I-1MLFT0CSUCB7',
            'body' => ['reason' => '']
            );
        $response = $this->PAYPAL_API($request);
        

        pr($response);
         //Old subscription suspend  
        if ($response) {
            $req = new Request();
            $req->subscriptionID = $response->subscriptionID;
            $req->changeStatus = 'suspend';
            try {
                $this->SubscriberChangeStatus($req);                
            } catch (\Throwable $th) {
                return false;
            }
            
        }
   
    }
    public function syncPlan(Request $request)
    {
        $request = array(
            'method'  => 'GET',
            'urlPath' => '/billing/plans?page_size=20&page=1',
            'body' => ['reason' => '']
            );
        $planList = $this->PAYPAL_API($request);

        // DB::table('paypal_plans')->truncate();
        $i = 0;
        foreach ($planList['body']['plans'] as $key => $plan) {
            $getPlanDetails = DB::table('paypal_plans')->where('plan_id', '=', $plan['id'])->first();
            if (!$getPlanDetails) {
                $PaypalPlan              = new PaypalPlans();
                $PaypalPlan->plan_id     = $plan['id'];
                $PaypalPlan->plan_name   = $plan['name'];
                $PaypalPlan->description = $plan['description'];
                $PaypalPlan->status      = $plan['status'];
                $PaypalPlan->save();
                echo "created";
            }else {
                PaypalPlans::where(['plan_id' => $plan['id']])->update([
                    'plan_id'          => $plan['id'],
                    'plan_name'        => $plan['name'],
                    'description' => $plan['description'],
                    'status'           => $plan['status']
                ]);
                echo "updated";
            }            
        }
        $allPlanArray = array();
        foreach ($planList['body']['plans'] as $key => $plan) {
            $request = array(
            'method'  => 'GET',
            'urlPath' => '/billing/plans/'.$plan['id'],
            'body' => ['reason' => '']
            );

            $planDetails = $this->PAYPAL_API($request);
            $allBodyPlanArray = array();
            foreach ($planDetails['body']['billing_cycles'] as $key => $billingCycle) {

                if(array_key_exists('pricing_scheme', $billingCycle)) {
                    if ($billingCycle['tenure_type'] === 'TRIAL') {
                        PaypalPlans::where(['plan_id' => $plan['id']])->update([
                            //'trial_price' => $billingCycle['pricing_scheme']['fixed_price']['value'],
                            'trial_price' => $billingCycle['pricing_scheme']['fixed_price']['value'],
                            'frequency' => $billingCycle['frequency']['interval_unit'],
                            'is_trial' => 1,
                        ]);
                    }
                    if ($billingCycle['tenure_type'] === 'REGULAR') {
                        PaypalPlans::where(['plan_id' => $plan['id']])->update([
                            'price' => $billingCycle['pricing_scheme']['fixed_price']['value'],
                            'frequency' => $billingCycle['frequency']['interval_unit']
                        ]);
                    }/*else{
                        PaypalPlans::where(['plan_id' => $plan['id']])->update([
                            'trial_price' => $billingCycle['pricing_scheme']['fixed_price']['value'],
                            'frequency' => $billingCycle['frequency']['interval_unit']
                        ]);


                    }*/
                }
                //$allBodyPlanArray[] = $planDetails['body'];
            }
            $allPlanArray [] =  $planDetails['body'];
            $i++;
        }
        /*echo "<pre>";
        print_r($allPlanArray);
        exit();*/

        //dd($allPlanArray);

        return redirect('/admin/plan/list')->with('success', 'Paypal plans are updated.');
        
    }
    public function plan_detail(Request $request, $id = null)
    {
        // pr(Session::all());
        $userDetails = DB::table('front_users')->where('email', '=', $request->session()->get('userSession'))->first();
        
        if ($userDetails) {
            $dateTime                   = Carbon::now();
            $currentDate                = $dateTime->toDateString();
            $datediff                   = strtotime($userDetails->end_validity) - strtotime($currentDate);
            $userDetails->remainingDays = round($datediff / (60 * 60 * 24));
            
            $uploadedTracks = DB::table('tracks')->where('artist_id', '=', $userDetails->id)->count();            
            $planDetails = DB::table('paypal_plans')->where('plan_id', '=', $id)->first();

            if ($planDetails->track_limit < $uploadedTracks) {
             return redirect()->back()->with('error', 'Your uploaded track is higher than new plan. Please delete some track before downgrade plan');   
            }

            return view('plan_detail')->with(compact('userDetails', 'planDetails'));
        } else {
            return redirect('/dashboard');
        }
    }
    public function SubscriberCreate(Request $request)
    {
        $response = DB::table('paypal_subscribers')->where('user_id', '=', $request->session()->get('userId'))->orderBy('id','desc')->first();
        
        // New subscriber saved
        $newSubscriber                       = new PaypalSubscribers();
        $newSubscriber->user_id              = Session::get('userId');
        $newSubscriber->user_email           = Session::get('userSession');
        $newSubscriber->subscriptionID       = $request->subscriptionID;
        // $newSubscriber->plan_id              = $newPlan->plan_id;
        // $newSubscriber->plan_name            = $newPlan->plan_name;
        // $newSubscriber->plan_description     = $newPlan->plan_description;
        // $newSubscriber->plan_type            = $newPlan->plan_type;
        // $newSubscriber->agreement_start_date = $newPlan->agreement_start_date;
        $newSubscriber->save();
        $this->SubscriberUpdate($request, $newSubscriber->id);
        
        //Old subscription Cancel  
        if ($response) {
            $req = new Request();
            $req->subscriptionID = $response->subscriptionID;
            // $req->changeStatus = 'cancel';
            try {
                $request = array(
                    'method'  => 'post',
                    'urlPath' => '/billing/subscriptions/'.$response->subscriptionID.'/cancel',
                    'body' => ['reason' => 'Not satisfied with the service']
                    );
                $responseData = $this->PAYPAL_API($request);

                //Update cancel status on database side also

                PaypalSubscribers::where(['user_id' => Session::get('userId'), 'id' =>  $response->subscriptionID ])->update([
                    'status'                => $responseData['status']
                ]);

            } catch (\Throwable $th) {
                return false;
            }
            
        }
        return response()->json([ 'success' => 'Subscribption is created!' ], 201);        
    }
    public function SubscriberUpdate(Request $request, $subscriptionId)
    {
        // .$request->subscriptionID
        $request = array(
            'method'  => 'GET',
            'urlPath' => '/billing/subscriptions/'.$request->subscriptionID,
            'body' => ['reason' => '']
            );
            $result = $this->PAYPAL_API($request);
            $subscriptions = $result['body'];

            $planDetails = DB::table('paypal_plans')->where('plan_id', '=', $subscriptions['plan_id'])->first();
            // pr($planDetails);
            PaypalSubscribers::where(['user_id' => Session::get('userId'), 'id' => $subscriptionId ])->update([
                'status'                => $subscriptions['status'],
                'plan_id'               => $subscriptions['plan_id'],
                'is_trial'               => 1,
                'plan_name'             => $planDetails->plan_name,
                'track_limit'           => $planDetails->track_limit,
                'remain_track_limit'    => 0,
                'payer_id'              => $subscriptions['subscriber']['payer_id'],
                'payer_email'           => $subscriptions['subscriber']['email_address'],
                'payer_first_name'      => $subscriptions['subscriber']['name']['given_name'],
                'payer_last_name'       => $subscriptions['subscriber']['name']['surname'],
                // 'next_billing_date'     => $subscriptions->billing_info->next_billing_time,
                'next_billing_date'     => $subscriptions['billing_info']['next_billing_time'],
            ]);
                
            if ($subscriptions['status'] == 'ACTIVE') {
                FrontUser::where(['id' => Session::get('userId')])->update([
                    'end_validity' => $subscriptions['billing_info']['next_billing_time']
                ]);                
            }

            
            // return redirect('/dashboard');
    }
    public function list_subscriber()
    {
        $listSubscribers = DB::table('front_users')
        ->rightJoin('paypal_subscribers', 'paypal_subscribers.user_id', '=', 'front_users.id')
        ->selectRaw('front_users.*, paypal_subscribers.plan_name, paypal_subscribers.last_payment_amount, paypal_subscribers.status, paypal_subscribers.next_billing_date')
        ->get();
        
        return view('admin.subscription-plan.subscriber-list')->with(compact('listSubscribers'));
    }
    public function SubscriberChangeStatus(Request $request)
    {

        $status = ($request->changeStatus == 'activate') ? 'Auto Renewal is ON' : 'Auto Renewal is OFF' ;
        $status1 = ($request->changeStatus == 'activate') ? 'ACTIVE' : 'SUSPENDED' ;
        $subscriptionID = $request->subscriptionID;

        $payPalSubscriptionData = PaypalSubscribers::where('subscriptionID', $subscriptionID)->first();

        $paypalPlanData = PaypalPlans::where('plan_id',$payPalSubscriptionData->plan_id)->first();

        if($paypalPlanData->status == 'INACTIVE'){
            return back()->with('error', 'Your plan has been deactivated by administrator');
        }

        try {
           $request = array(
            'method'  => 'POST',
            'urlPath' => '/billing/subscriptions/'.$request->subscriptionID.'/'.$request->changeStatus,
            'body' => ['reason' => 'Requested by user']
            );
            $res = $this->PAYPAL_API($request);

            if ($res['statusCode'] == 204) {
                
                PaypalSubscribers::where(['subscriptionID' => $subscriptionID])->update([
                    'status' => $status1,
                ]);
                
                return redirect('/dashboard')->with('success', 'Subscription '.$status);
            }
        } catch (\Throwable $th) {
            return redirect('/dashboard')->with('error', 'Something is wrong'.$th);
        }
          
    }

    public function reactivePlan(Request $request)
    {

        $status = ($request->changeStatus == 'activate') ? 'Auto Renewal is ON' : 'Auto Renewal is OFF' ;
        $status1 = ($request->changeStatus == 'activate') ? 'ACTIVE' : 'SUSPENDED' ;
        $subscriptionID = $request->subscriptionID;

       /* $payPalSubscriptionData = PaypalSubscribers::where('subscriptionID', $subscriptionID)->first();

        $paypalPlanData = PaypalPlans::where('plan_id',$payPalSubscriptionData->plan_id)->first();

        if($paypalPlanData->status == 'INACTIVE'){
            return back()->with('error', 'Your plan has been deactivated by administrator');
        }*/

        try {
           $request = array(
            'method'  => 'POST',
            'urlPath' => '/billing-agreements/'.$request->subscriptionID.'/re-activate',
            'body' => ['reason' => 'Requested by user']
            );
            $res = $this->PAYPAL_API($request);

            echo "<pre>";
            print_r($res);
            exit();
            if ($res['statusCode'] == 204) {

                PaypalSubscribers::where(['subscriptionID' => $subscriptionID])->update([
                    'status' => $status1,
                ]);

                return redirect('/dashboard')->with('success', 'Subscription '.$status);
            }
        } catch (\Throwable $th) {
            return redirect('/dashboard')->with('error', 'Something is wrong'.$th);
        }

    }

    public function Re(Request $request)
    {

        $status = ($request->changeStatus == 'activate') ? 'Auto Renewal is ON' : 'Auto Renewal is OFF' ;
        $status1 = ($request->changeStatus == 'activate') ? 'ACTIVE' : 'SUSPENDED' ;
        $subscriptionID = $request->subscriptionID;

        $payPalSubscriptionData = PaypalSubscribers::where('subscriptionID', $subscriptionID)->first();

        $paypalPlanData = PaypalPlans::where('plan_id',$payPalSubscriptionData->plan_id)->first();

        if($paypalPlanData->status == 'INACTIVE'){
            return back()->with('error', 'Your plan has been deactivated by administrator');
        }

        try {
           $request = array(
            'method'  => 'POST',
            'urlPath' => '/billing/subscriptions/'.$request->subscriptionID.'/'.$request->changeStatus,
            'body' => ['reason' => 'Requested by user']
            );
            $res = $this->PAYPAL_API($request);

            if ($res['statusCode'] == 204) {

                PaypalSubscribers::where(['subscriptionID' => $subscriptionID])->update([
                    'status' => $status1,
                ]);

                return redirect('/dashboard')->with('success', 'Subscription '.$status);
            }
        } catch (\Throwable $th) {
            return redirect('/dashboard')->with('error', 'Something is wrong'.$th);
        }

    }

}
