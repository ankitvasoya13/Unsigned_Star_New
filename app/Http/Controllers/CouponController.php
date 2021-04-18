<?php

namespace App\Http\Controllers;
use App\PaypalPlans;
use App\Coupons;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function __construct()
    {
    }
    public function index(Request $request)
    {
        $coupons = DB::table('coupons')->get();
        return view('admin/coupons/index')->with(compact('coupons'));
    }
    public function create(Request $request)
    {
         if ($request->method() == 'POST') {
             $input = $request->all();
            //  pr($input);
            $coupon = new Coupons();
            $coupon->coupon_code = $input['coupon_code'];
            $coupon->plan_id = $input['plan_id'];
            $coupon->type = $input['type'];
            $coupon->amount = $input['amount'];
            $coupon->status = $input['status'];
            $coupon->expiry_date = $input['expiry_date'];
            $coupon->save();
            return redirect('/admin/coupons/list')->with('success', 'Coupon created successfully.');
         }else{
            $paypal_plans = DB::table('paypal_plans')->where('first_cycle_price','>','0')->get();
            return view('admin/coupons/create')->with(compact('paypal_plans'));
         }
        
    }

    public function edit(Request $request)
    {
        $input = $request->all();
         if ($request->method() == 'POST') {
             Coupons::where(['id' => $request->id])->update([
                                'coupon_code' => $input['coupon_code'],
                                'plan_id'     => $input['plan_id'],
                                'type'        => $input['type'],
                                'amount'      => $input['amount'],
                                'status'      => $input['status'],
                                'expiry_date' => $input['expiry_date'],
                            ]);            
            return redirect('/admin/coupons/list')->with('success', 'Coupon updated successfully.');
         }else{
            $paypal_plans = DB::table('paypal_plans')->where('first_cycle_price','>','0')->get();
            $coupon       = Coupons::where('id','=', $request->id)->first();            
            return view('admin/coupons/edit')->with(compact('paypal_plans','coupon'));
         }
        
    }
    
    public function checkApply(Request $request)
    {
        $input = $request->all();
         if ($request->method() == 'POST') {
             $coupon = Coupons::where('coupon_code','=', $request->promocode)->where('status','=', '1')->where('expiry_date','>', Carbon::today())->get();            
             
             if (count($coupon)) {
                 return response()->json([ 'coupon' => $coupon[0] ], 201);
             } else {
                 return response()->json([ 'error' => "Coupon code is not valid" ], 500);
             }             
         }
        
    }
}
