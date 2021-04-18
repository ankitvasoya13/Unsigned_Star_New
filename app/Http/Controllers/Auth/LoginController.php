<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Mail;
use Session;
use DB;
use App\FrontUser;
use Hash;
use URL;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function userLogin(Request $request)
    {
      if ($request->isMethod('post')) {
            $output = '<div class="alert alert-danger" role="alert">Invalid Email or Password!</div>';
            $outputVerifyError = '<div class="alert alert-danger" role="alert">Account is not verified by admin.</div>';
            $isUserExist = FrontUser::get()->where('email', '=', $request->email)->count();
            if ($isUserExist > 0) {
                $user = FrontUser::get()->where('email', '=', $request->email)->first();                
                if (Hash::check($request->password, $user->password)) {
                    Session::put('userSession', $user->email);
                    Session::put('userId', $user->id);
                    Session::put('userType', $user->user_type);
                    // return redirect('/dashboard');
                    if ($user->status == 0) {
                        return response()->json([
                            'message' => $outputVerifyError
                        ]);
                        exit;
                    }
                    return response()->json([
                        'message' => 'ok'
                    ]);                    
                } else {
                    return response()->json([
                        'message' => $output
                    ]);
                }   
            } else {
                return response()->json([
                    'message' => $output                    
                ]);
            }         
        }        
    }

    // Logout process function
    public function userLogout()
    {
        Session()->forget('userSession');
        Session()->forget('userId');
        Session()->forget('userType');
        return redirect('/')->with('success', 'Logged out successfully.');
    }

}
