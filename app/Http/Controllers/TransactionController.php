<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transaction;
use DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = DB::table('transaction')
        ->select('front_users.first_name', 'front_users.last_name', 'front_users.email', 'transaction.payment_email as t_email', 'transaction.payment_amount', 'transaction.status', 'transaction.currency', 'transaction.created_at' )
        ->leftJoin('front_users', 'transaction.front_user_id', '=', 'front_users.id')
        ->get();
        return view('admin.orders.index')->with(compact('transactions'));
    }
}
