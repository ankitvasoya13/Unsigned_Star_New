<?php

namespace App\Console\Commands;

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

use Illuminate\Console\Command;

class AutoRenewal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:Autorenewal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    private $mode;
    private $client_id;
    private $secret;
    private $plan_id;
    private $apiContext;

    public function __construct()
    {
        parent::__construct();
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

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
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

            echo "Auto renewal cron run successfully at ". now()." <br> --------------------------------------------- <br>";

            // return redirect('/dashboard')->with('success', 'Subscription has been updated successfully');
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
