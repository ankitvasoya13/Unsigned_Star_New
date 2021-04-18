<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\FrontUser;
use App\AdminPhotos;

class AdminController extends Controller
{

    /*public function index(){
		return view('admin.layouts.index');
	}*/

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();            
            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                
                Session::put('adminSession', $data['email']);
                
                $artistCount = FrontUser::where('user_type', '=', '1')->where('status', '=', '1')->count();
                $panelCount = FrontUser::where('user_type', '=', '2')->where('status', '=', '1')->count();
                $fanCount = FrontUser::where('user_type', '=', '3')->where('status', '=', '1')->count();
                
                return redirect('/admin/dashboard')->with(compact('artistCount', 'panelCount', 'fanCount'));
            
            } else {
                return redirect('/admin')->with('error', 'Invalid Username or Password');
            }
        }
        return view('admin.login');
    }


    public function dashboard()
    {
        if (Session::has('adminSession')) {
            // Perform all actions
        } else {
            //return redirect()->action('AdminController@login')->with('flash_message_error', 'Please Login');
            return redirect('/admin')->with('flash_message_error', 'Please Login');
        }
        $artistCount = FrontUser::get()->where('user_type','=','1')->count();
        $panelCount = FrontUser::get()->where('user_type','=','2')->count();
        $fanCount = FrontUser::get()->where('user_type','=','3')->count();
        return view('admin.dashboard')->with(compact('artistCount','panelCount','fanCount'));
    }

    public function logout()
    {
        Session::flush();
        return redirect('/admin')->with('flash_message_success', 'Logged out successfully.');
    }

    public function forgotPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();
            //You can add validation login here
            $user = DB::table('users')->where('email', '=', $data['email'])->first();
            //Check if the user exists
            //print_r($user); exit;
            /*if (count($user) < 1) {
                return redirect()->back()->withErrors(['email' => trans('User does not exist')]);
            }*/

            //Create Password Reset Token
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => str_random(60),
                'created_at' => Carbon::now()
            ]); //Get the token just created above
            $tokenData = DB::table('password_resets')
                ->where('email', $request->email)->first();

            if ($this->sendResetEmail($request->email, $tokenData->token)) {
                return redirect()->back()->with('status', trans('A reset link has been sent to your email address.'));
            } else {
                return redirect()->back()->withErrors(['error' => trans('A Network Error occurred. Please try again.')]);
            }
        }
        return view('admin.forgot-password');
    }

    private function sendResetEmail($email, $token)
    {
        //Retrieve the user from the database
        $user = DB::table('users')->where('email', $email)->select('name', 'email')->first();
        //Generate, the password reset link. The token generated is embedded in the link
        $link = config('base_url') . 'password-reset/' . $token . '?email=' . urlencode($user->email);

        try {
            //Here send the link with CURL with an external email API         
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function resetPassword(Request $request)
    {
        //Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
            'password' => 'required|confirmed'
        ]);

        //check if input is valid before moving on
        if ($validator->fails()) {
            return redirect()->back()->withErrors(['email' => 'Please complete the form']);
        }

        $password = $request->password;

        // Validate the token
        $tokenData = DB::table('password_resets')->where('token', $request->token)->first();

        // Redirect the user back to the password reset request form if the token is invalid
        if (!$tokenData) return view('auth.passwords.email');

        $user = User::where('email', $tokenData->email)->first();

        // Redirect the user back if the email is invalid
        if (!$user) return redirect()->back()->withErrors(['email' => 'Email not found']);
        //Hash and update the new password
        $user->password = \Hash::make($password);
        $user->update(); //or $user->save();

        //login the user immediately they change password successfully
        Auth::login($user);

        //Delete the token
        DB::table('password_resets')->where('email', $user->email)
            ->delete();

        //Send Email Reset Success Email
        if ($this->sendSuccessEmail($tokenData->email)) {
            return view('index');
        } else {
            return redirect()->back()->withErrors(['email' => trans('A Network Error occurred. Please try again.')]);
        }
    }

    public function downloadCSV($type)
    {
        
        $result = FrontUser::where(['user_type' => $type])->get();
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=file.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );
        // $reviews = Reviews::getReviewExport($this->hw->healthwatchID)->get();
        $columns = array('First Name', 'Last Name', 'Email', 'City', 'Country', 'User type');
        $callback = function () use ($result, $columns) {
            $file = fopen('php://output', 'w'); //<-here. name of file is written in headers
            fputcsv($file, $columns);
            foreach ($result as $res) {
                switch ($res->user_type) {
                    case '1':
                        $res->user_type = 'Artist';
                        break;
                    case '2':
                        $res->user_type = 'Panel';
                        break;
                    case '3':
                        $res->user_type = 'Fan';
                        break;
                    default:
                        $res->user_type = '';
                        break;
                }
                fputcsv($file, array($res->first_name, $res->last_name, $res->email, $res->city, $res->country, $res->user_type));
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    function PhotoUpload(Request $request)
    {
        if ($request->ajax()) {
            $image_data = $request->image;
            $image_array_1 = explode(";", $image_data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $image_name = time() . '.png';
            $upload_path = public_path('uploads/' . $image_name);
            file_put_contents($upload_path, $data);

            // FrontUser::where(['id' => $request->id])->update([
            //     'profile_image' => $image_name
            // ]);
            // Session::put('profileImg', $image_name);
            $photo = new AdminPhotos;
            $photo->admin_id = 1;
            $photo->photo_file = $image_name;
            $photo->status = '1';
            $photo->save();
            return response()->json(['path' => '/uploads/' . $image_name, 'image_name' => $image_name ]);
        }
    }
}
