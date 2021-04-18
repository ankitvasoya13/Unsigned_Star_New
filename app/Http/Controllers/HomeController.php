<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Page;
use App\Story;
use App\Transaction;
use App\Event;
use App\Competition;
use App\Package;
use App\ContactUs;
use App\FrontUser;
use App\Track;
use App\TracksViewIp;
use App\Video;
use App\Photo;
use App\Packages;
use App\Follower;
use App\Slider;
use App\ArtistLikes;
use App\VerifyUser;
use App\Mail\VerifyMail;
use Mail;
use Session;
use DB;
use App\Rules\Captcha;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\PaypalPlans;
use App\PaypalSubscribers;
use Redirect;
use App\Settings;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dateTime = Carbon::now();
        $currentDate = $dateTime->toDateString();
        $packages = Package::get();
        //$top_songs = Track::get()->where('status', '=', '1');
        $top_songs = DB::table('tracks')
            ->select('tracks.id', 'tracks.artist_id', 'tracks.track_name','tracks.track_file', 'tracks.cover_image', 'tracks.views','front_users.first_name', 'front_users.last_name')
            ->leftJoin('front_users', 'tracks.artist_id', '=', 'front_users.id')
            ->where('tracks.status', '=', '1')->where('front_users.status', '=', '1')->where('front_users.end_validity', '>=', $currentDate)->orderByDesc('tracks.views')
            ->limit(10)
            ->get();
        $artistUsers = FrontUser::get()->where('user_type','=','1')->where('status','=','1');
        $panelUsers = FrontUser::get()->where('user_type','=','2')->where('status','=','1')->where('featured','=','1');
        $userDetails = FrontUser::get()->where('email', '=', Session()->get('userSession'));
        //$storyDetails = Story::get()->take(1);
        $storyDetails = Story::orderBy('id','desc')->get()->take(1);
        $competitionDetails = Competition::orderBy('id','desc')->get()->take(1);
        $sliders = Slider::get();
        $featuredArtists = FrontUser::orderBy('id','desc')->get()->where('user_type','=','1')->where('status','=','1')->where('homefeatured','=','1')->where('end_validity', '>=', $currentDate)->take(1);
        $sliderArtists = FrontUser::get()->where('user_type','=','1')->where('status','=','1')->where('featured','=','1')->where('end_validity', '>=', $currentDate);
        return view('home')->with(compact('packages','panelUsers', 'userDetails','storyDetails','competitionDetails','artistUsers','sliders','featuredArtists','sliderArtists', 'top_songs'));
    }

    public function about()
    {
        $pages = Page::get();
        return view('about')->with(compact('pages'));
    }

    public function topsongs()
    {
        $pages = Page::get();
        return view('top-songs')->with(compact('pages'));
    }

    public function termsofuse()
    {
        $pages = Page::get();
        return view('terms-of-use')->with(compact('pages'));
    }

    public function privacypolicy()
    {
        $pages = Page::get();
        return view('privacy-policy')->with(compact('pages'));
    }

    public function faqs()
    {
        $pages = Page::get();
        return view('faqs')->with(compact('pages'));
    }

    public function stories()
    {
        $stories = Story::orderBy('created_at','desc')->paginate(9);
        return view('success-stories')->with(compact('stories'));
    }

    public function viewStory(Request $request)
    {
        $id = $request->id;
        $storyDetails = Story::where(['id' => $id])->first();
        return view('storyDetails')->with(compact('storyDetails'));
    }

    public function events()
    {
        $events = Event::orderBy('start_datetime','desc')->paginate(9);
        return view('events')->with(compact('events'));
    }

    public function viewEvent(Request $request)
    {
        $id = $request->id;
        $eventDetails = Event::where(['id' => $id])->first();
        $upcomingEvent = Event::get()->where('start_datetime','>',date('m-d-Y h:i:s'))->take(1);
        return view('eventDetails')->with(compact('eventDetails','upcomingEvent'));
    }

    public function competitions()
    {
        $competitions = Competition::orderBy('start_datetime','desc')->paginate(9);
        return view('competitions')->with(compact('competitions'));
    }

    public function viewCompetition(Request $request)
    {
        $id = $request->id;
        $competitionDetails = Competition::where(['id' => $id])->first();
        $upcomingCompetition = Competition::get()->where('start_datetime','>',date('m-d-Y h:i:s'))->take(1);
        return view('competitionDetails')->with(compact('competitionDetails','upcomingCompetition'));
    }

    public function contactSubmit(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = array(
                'first_name'             => 'required',                       // just a normal required validation
                'email'            => 'required',    // required and must be unique in the ducks table
                'subject'         => 'required',
                'user_message' => 'required',          // required and has to match the password field
                'g-recaptcha-response' => new Captcha(),
            );
            $data = array(
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email'),
                'subject' => $request->get('subject'),
                'support_type' => $request->get('support_type'),
                'user_message' => $request->get('message')
            );
            $validator =  Validator::make($data, $rules);
            if ($validator->fails()) {
                return back()->with('error', 'Please fill up form & verify capcha code.');
            }
            Mail::send('mail', $data, function ($message) {
                $message->to('harpanpanchal@gmail.com', 'Unsigned Star')->subject('Contact Inquiry');
                $message->from('contact@unsignedstar.com', 'Unsigned Star');
            });
            return back()->with('success', 'Thanks for contacting us!  Our team will get back to you ASAP!');
        }
        return view('contact');
    }

    public function join()
    {
        return view('join');
    }

    public function check_email(Request $request){
        $email = FrontUser::where(['email' => $request->email])->first();
        $data = '';
        if ($email) {
            $data = 'exist';           
        } else {
            $data = '';
        }
        return response()->json([
            'message' => $data
        ]);
        
    }
    // Artist Signup Process Function
    public function artistSignup(Request $request)
    {
        $settingAppUrl = Settings::getSettingValue('APP_URL');
        $settingFromEmail = Settings::getSettingValue('FROM_EMAIL');

        if ($request->isMethod('post')) {
            $users = FrontUser::where(['email' => $request->email])->count();
            if ($users > 0) {
                return back()->with('error', 'Email already used.');
            }
            
            $data = $request->all();


            if (empty($data['status'])) {
                $status = '0';
            } else {
                $status = '1';
            }
            $email = $data['email'];
            $frontUser = new FrontUser;
            $frontUser->first_name = $data['first_name'];
            $frontUser->last_name = $data['last_name'];
            $frontUser->email = $data['email'];
            //$frontUser->email_token = str_random(60);
            $frontUser->password = bcrypt($data['password']);
            $frontUser->birthdate = $data['birthdate'];
            $frontUser->featured = 0;
            $frontUser->user_type = 1;
            $frontUser->status = $status;
            // $frontUser->status = $status;
            if ($frontUser->save()) {            
                //$link = config('base_url') . 'password-reset/' . $frontUser->email_token . '?email=' . urlencode($data['email']);
                $siteURL = $settingAppUrl;
                $FROM_EMAIL = $settingFromEmail;

                $data = array(
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                    'siteURL' => $siteURL,
                    'FROM_EMAIL' => $FROM_EMAIL,
                );                
                /*Mail::send('mails/artist_registration', $data, function ($message) use ($data) {
                    $message->to('harpanpanchal@gmail.com', 'Artist Registration')->subject('A new Artist has registered');
                    $message->to($data['email'], 'Artist Registration')->subject('You have been registered successfully');
                    $message->from('xyz@gmail.com', 'Unsigned Star');
                });*/

                Mail::send('mails/artist_registration', $data, function ($message) use ($data) {
                    $message->to('harpanpanchal@gmail.com', 'Artist Registration')->subject('A new Artist has registered');
                    $message->to($data['email'], 'Artist  Registration')->subject('Welcome to unsignedstar.com!');
                    $message->from($data['FROM_EMAIL'], 'Unsigned Star');
                });

                $verifyUser = VerifyUser::create([
                    'user_id' => $frontUser->id,
                    'token' => sha1(time())
                ]);
                Mail::to($frontUser->email)->send(new VerifyMail($verifyUser));

                return back()->with('success', 'You have been registered successfully');
            } else {
                return back()->with('error', 'Your registration was unsuccessful');
            }
        }
        return view('artist-signup');
    }

    // Panel Signup Process Function
    public function panelSignup(Request $request)
    {
        if ($request->isMethod('post')) {
            $users = FrontUser::where(['email' => $request->email])->count();
            if ($users > 0) {
                return back()->with('error', 'Email already used.');
            }
            $data = $request->all();

            if (empty($data['status'])) {
                $status = '0';
            } else {
                $status = '1';
            }

            $frontUser = new FrontUser;
            $frontUser->first_name = $data['first_name'];
            $frontUser->last_name = $data['last_name'];
            $frontUser->email = $data['email'];
            $frontUser->password = bcrypt($data['password']);
            $frontUser->featured = 0;
            $frontUser->user_type = 2;
            $frontUser->status = $status;
            if ($frontUser->save()) {

                $data = array(
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                );
                Mail::send('mails/register', $data, function ($message) use ($data) {
                    $message->to('harpanpanchal@gmail.com', 'Panel Registration')->subject('A new Panel member has registered');
                    $message->to($data['email'], 'Panel Registration')->subject('You have been registered successfully');
                    $message->from('xyz@gmail.com', 'Unsigned Star');
                });

                return back()->with('success', 'You have been registered successfully');
            } else {
                return back()->with('error', 'Your registration was unsuccessful');
            }
        }
        return view('panel-signup');
    }

    // Fan Signup Process Function
    public function fanSignup(Request $request)
    {
        $settingAppUrl = Settings::getSettingValue('APP_URL');
        $settingFromEmail = Settings::getSettingValue('FROM_EMAIL');

        if ($request->isMethod('post')) {
            $users = FrontUser::where(['email' => $request->email])->count();
            if ($users > 0) {
                return back()->with('error', 'Email already used.');
            }
            $data = $request->all();

            if (empty($data['status'])) {
                $status = '0';
            } else {
                $status = '1';
            }

            $frontUser = new FrontUser;
            $frontUser->first_name = $data['first_name'];
            $frontUser->last_name = $data['last_name'];
            $frontUser->email = $data['email'];
            $frontUser->password = bcrypt($data['password']);
            $frontUser->birthdate = $data['birthdate'];
            $frontUser->featured = 0;
            $frontUser->user_type = 3;
            $frontUser->status = $status;
            if ($frontUser->save()) {

                $siteURL = $settingAppUrl;
                $FROM_EMAIL = $settingFromEmail;

                $data = array(
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                    'siteURL' => $siteURL,
                    'FROM_EMAIL' => $FROM_EMAIL,
                );
                Mail::send('mails/fan_registration', $data, function ($message) use ($data) {
                    $message->to('harpanpanchal@gmail.com', 'Fan Registration')->subject('A new fan has registered');
                    $message->to($data['email'], 'Fan Registration')->subject('Welcome to unsignedstar.com!');
                    $message->from($data['FROM_EMAIL'], 'Unsigned Star');
                });
                $verifyUser = VerifyUser::create([
                    'user_id' => $frontUser->id,
                    'token' => sha1(time())
                ]);
                Mail::to($frontUser->email)->send(new VerifyMail($verifyUser));
                return back()->with('success', 'You have been registered successfully');
            } else {
                return back()->with('error', 'Your registration was unsuccessful');
            }
        }
        return view('fan-signup');
    }

    public function verifyUser($token)
    {
    $verifyUser = VerifyUser::where('token', $token)->first();
    if(isset($verifyUser) ){
            $userData = FrontUser::where('id',$verifyUser->user_id)->first();
        if($userData) {
            FrontUser::find($verifyUser->user_id)->update(['status' => 1]);
            $status = "Your e-mail is verified. You can now login.";
        }else{
            return redirect('/')->with('error', "Sorry your email cannot be identified.");
        }
    } else {
        return redirect('/')->with('error', "Sorry your email cannot be identified.");
    }
    return redirect('/')->with('success', $status);
    }

    public function userLogin(Request $request)
    {
        if ($request->isMethod('post')) {
            $output = '<div class="alert alert-danger" role="alert">Invalid Email or Password!</div>';
            $outputVerifyError = '<div class="alert alert-danger" role="alert">Account is not verified.</div>';
            $isUserExist = FrontUser::get()->where('email', '=', $request->email)->count();
            if ($isUserExist > 0) {
                $user = FrontUser::get()->where('email', '=', $request->email)->first();
                if (Hash::check($request->password, $user->password)) {
                    if ($user->status == 0) {
                        return response()->json([
                            'message' => $outputVerifyError
                        ]);
                        exit;
                    }
                    Session::put('userSession', $user->email);
                    Session::put('userId', $user->id);
                    Session::put('userType', $user->user_type);
                    Session::put('profileImg', $user->profile_image);
                    // return redirect('/dashboard');
                    
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
        Session()->forget('profileImg');
        //Session()->flush();
        return redirect('/')->with('success', 'Logged out successfully.');
    }

    // Fetch user details on dashboard function
    public function userDashboard(Request $request)
    {
        $userDetails = DB::table('front_users')->where('status', 1)->where('email', '=', $request->session()->get('userSession'))->first();
        if ($userDetails) {
            $trackDetails = Track::where(['artist_id' => $userDetails->id])->get();
            $videoDetails = Video::where(['artist_id' => $userDetails->id])->first();
            $transactions = DB::table('transaction')->where('front_user_id', '=', $userDetails->id)->get();
            // $packagesDetails = Packages::orderBy('id', 'DESC')->get();
            $planDetails = PaypalPlans::where('status','=', 'ACTIVE')->where('first_cycle_price','<=', '0')->orderBy('id', 'DESC')->get();

            $photoDetails = Photo::where(['artist_id' => $userDetails->id])->get();
            $agreementDetails = PaypalSubscribers::where(['user_id' => $userDetails->id])->orderBy('id', 'DESC')->get();
             //dd($agreementDetails[0]->track_limit);
            $dateTime = Carbon::now();
            $currentDate = $dateTime->toDateString();
            $datediff = strtotime($userDetails->end_validity) - strtotime($currentDate);

            $endDate = strtotime($userDetails->end_validity);
            $currentDate = strtotime($currentDate);

            /*echo "<pre>end date =";
            print_r(strtotime($userDetails->end_validity));
            echo "<br>current date=";
            print_r(strtotime($currentDate));
            exit();*/
            $userDetails->remainingDays = round(($datediff / (60 * 60 * 24)));
            if(count($agreementDetails) > 0) {
                $activePlanDetails = DB::table('paypal_plans')->where('plan_id', '=', $agreementDetails[0]->plan_id)->first();
            }else{
                $activePlanDetails = array();
            }
            return view('artist-dashboard')->with(compact('userDetails', 'agreementDetails','trackDetails','videoDetails','transactions', 'planDetails','photoDetails', 'activePlanDetails', 'endDate','currentDate' ));
        } else {
            //return redirect('/');
            Session()->forget('userSession');
            Session()->forget('userId');
            Session()->forget('userType');
            Session()->forget('profileImg');
            //Session()->flush();
            return redirect('/')->with('success', 'Logged out successfully.');
        }        
    } 

    // Update user profile function
    public function updateProfile(Request $request, $id = null)
    {
        $userDetails = FrontUser::where(['id' => $id])->first();
        if ($request->isMethod('post')) {
            $data = $request->all();
            // if ($request->file('profile_image')) {
            //     $userpic = $request->file('profile_image');
            //     $profile_image = time() . "_" . $userpic->getClientOriginalName();
            //     $uploadpath = public_path() . '/uploads/';
            //     $userpic->move($uploadpath, $profile_image);
            //     Session::put('profileImg', $profile_image);
            // } else {
            //     $profile_image = Session::get('profileImg');
            // }
            if ($userDetails->user_type == '1' || $userDetails->user_type == '2') {
                $biography = $data['biography'];
            }else{
                $biography = null;
            }
            $birthdate = date('Y-m-d', strtotime($data['birthdate']));
            FrontUser::where(['id' => $id])->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'genre' => $data['genre'],
                'country' => $data['country'],
                'city' => $data['city'],
                'birthdate' => $birthdate,
                // 'profile_image' => $profile_image,
                'biography' => $biography
            ]);

            return redirect()->back()->with('success', 'Profile has been updated successfully');
        }
        return view('artist-dashboard')->with(compact('userDetails'));
    }

    // Change Password Function
    public function changePassword(Request $request, $id = null)
    {
        Session()->forget('success');
        Session()->forget('error');
        $userDetails = DB::table('front_users')->where('email', '=', $request->session()->get('userSession'))->first();        
        if (Hash::check($request->current_password, $userDetails->password)) {
            FrontUser::where(['id' => $id])->update(['password' => Hash::make($request->new_password)]);
            Session::put('success', 'Password has been updated successfully');
            return redirect('/dashboard');
        }
        else{
            Session::put('error', 'Current Password is invalid');
            return redirect('/dashboard');
        }        
    }

    // Fetch user data on profile page function
    public function myProfile(Request $request, $id = null)
    {
        $dateTime = Carbon::now();
        $currentDate = $dateTime->toDateString();
        $userData = FrontUser::find($id);
        if ($userData->user_type == 1) {
            $userDetails = FrontUser::where(['id' => $id])->where('user_type', 1)->where('status', 1)->where('end_validity', '>=', $currentDate)->first();
        } elseif ($userData->user_type == 2) {
            $userDetails = FrontUser::where(['id' => $id])->where('user_type', 2)->where('status', 1)->first();
        } elseif ($userData->user_type == 3) {
            $userDetails = FrontUser::where(['id' => $id])->where('user_type', 3)->where('status', 1)->first();
        }
        //$userDetails = FrontUser::where(['id' => $id])->first();
        $top_songs = DB::table('tracks')
            ->select('tracks.id', 'tracks.track_name', 'tracks.track_file', 'tracks.cover_image', 'tracks.views', 'front_users.first_name', 'front_users.last_name')
            ->leftJoin('front_users', 'tracks.artist_id', '=', 'front_users.id')
            ->where('tracks.status', '=', '1')->orderByDesc('tracks.views')
            ->where('tracks.artist_id', '=', $id)
            ->get();
        $photoDetails = Photo::get()->where('artist_id', '=', $id);
        $videoDetails = Video::get()->where('artist_id', '=', $id);
        $followerDetails = DB::table('followers')
            ->select('front_users.id', 'front_users.first_name', 'front_users.last_name', 'front_users.profile_image')
            ->leftJoin('front_users', 'followers.follower_id', '=', 'front_users.id')
            ->where('followers.artist_id', '=', $id)
            ->get();
        $totalFollower = Follower::get()->where('artist_id', '=', $id)->count();
        $isFollower = Follower::get()->where('artist_id', '=', $id)->where('follower_id', '=', Session()->get('userId'))->count();
        $isLike = ArtistLikes::get()->where('artist_id', '=', $id)->where('user_id', '=', Session()->get('userId'))->count();
        $totalLikes = ArtistLikes::get()->where('artist_id', '=', $id)->count();
        $followingDetails = DB::table('followers')
            ->select('front_users.id', 'front_users.first_name', 'front_users.last_name', 'front_users.profile_image')
            ->leftJoin('front_users', 'followers.artist_id', '=', 'front_users.id')
            ->where('followers.follower_id', '=', $id)->where('front_users.end_validity', '>=', $currentDate)
            ->get();

            if (!$userDetails) {
                return view('404');
            }

        return view('artist-profile')->with(compact('totalLikes', 'isLike', 'userDetails', 'top_songs', 'photoDetails', 'videoDetails', 'isFollower', 'totalFollower','followerDetails','followingDetails'));
    }
    
    // Upload tracks process function
    public function uploadTrack(Request $request)
    {
        $paypalSubscribers = PaypalSubscribers::where(['user_id' => Session()->get('userId')])->orderBy('id','desc')->first();
        // $track = DB::table('transaction')
        //     ->select(DB::raw("SUM(item) as TotalTrack"))
        //     ->where('front_user_id','=', Session()->get('userId'))->get()->first();        
        
        $uploadedtrack = DB::table('tracks')            
            ->where('artist_id','=', Session()->get('userId'))->get()->count();
        
        if ($paypalSubscribers->track_limit <= 0) {
            return back()->with('error', 'Track upload limit has been reached. Please buy plan to upload more tracks.');
        }
        if ($paypalSubscribers->track_limit == $paypalSubscribers->remain_track_limit) {
            return back()->with('error', 'Track upload limit has been reached. Please upgrade plan to upload more tracks.');
        }
        // pr($paypalSubscribers->track_limit);
        
        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($request->file('track_file'));

            $rules = [
                'track_file'  => 'required|mimes:mpga|max:51200',
                //'cover_image'  => 'required|mimes:jpeg,png,jpg,gif,svg',
            ];

            $validator = Validator::make($data, $rules, [
                'track_file.mimes' => 'The track file must be a file of type: mp3.',
                'track_file.max' => 'The track file size may not be greater than 50 MB.',
            ]);

            if ($validator->fails()){
                //return back()->with('error', $validator->messages());
                return Redirect::back()->withErrors($validator);
            }


            $musictrack = $request->file('track_file');
            $track_file = time() . "_" . $data['id'] . '_' . $musictrack->getClientOriginalName();
            $uploadpath = public_path() . '/uploads/tracks/';
            $musictrack->move($uploadpath, $track_file);


            /*if ($request->file('cover_image')) {
                $userpic = $request->file('cover_image');
                $profile_image = time() . "_" . $userpic->getClientOriginalName();
                $uploadpath = public_path() . '/uploads/tracks/imgs/';
                $userpic->move($uploadpath, $profile_image);
            } else {
                $profile_image = "default.png";
            }*/

            $track = new Track;
            $track->artist_id = $data['id'];
            $track->plan_id = $paypalSubscribers->plan_id;
            $track->track_name = $data['track_name'];
            $track->track_file = $track_file;
            //$track->cover_image = $profile_image;
            $track->cover_image = ($data['cover_image'] ? $data['cover_image'] : 'default.png');
            $track->save();

            PaypalSubscribers::where(['plan_id' => $paypalSubscribers->plan_id, 'id' => $paypalSubscribers->id ])->update([
                'remain_track_limit' => $paypalSubscribers->remain_track_limit + 1
            ]);

            return back()->with('success', 'Track has been uploaded successfully');
        }
        return view('artist-dashboard');
    }

    function uploadTrackCover(Request $request)
    {
        if ($request->ajax()) {

            $image_data = $request->image;
            $image_array_1 = explode(";", $image_data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $image_name = time() . '.png';
            $upload_path = public_path('/uploads/tracks/imgs/' . $image_name);
            file_put_contents($upload_path, $data);

            return response()->json(['image_name' => $image_name]);
        }
    }

    // Delete uploaded track from user profile function
    public function deleteTrack(Request $request, $id = null)
    {
        if ($request->isMethod('get')) {

            $data = Track::where(['id'=>$id])->first();
            
            $uploadpath = public_path() . '/uploads/tracks/';
            if (file_exists($uploadpath . $data->track_file)) {
                unlink($uploadpath . $data->track_file);
            }            
            /*$uploadpath = public_path() . '/uploads/tracks/imgs/';
            if (file_exists($uploadpath . $data->cover_image)) {
                unlink($uploadpath . $data->cover_image);    
            }*/            

            Track::where(['id'=>$id])->delete();

            //Track limit increase
            $paypalSubscribers = PaypalSubscribers::where(['user_id' => Session()->get('userId')])->orderBy('id','desc')->first();
            if($paypalSubscribers->remain_track_limit > 0) {
                PaypalSubscribers::where(['plan_id' => $paypalSubscribers->plan_id, 'id' => $paypalSubscribers->id])->update([
                    'remain_track_limit' => $paypalSubscribers->remain_track_limit - 1
                ]);
            }
            return redirect()->back()->with('success', 'Track has been deleted successfully');
        }
    }

    public function uploadVideo(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {

            $count = Video::where(['artist_id' => $request->id])->count();
            if($count <= 0){
                if (empty($data['status'])) {
                    $status = '0';
                } else {
                    $status = '1';
                }
                $video = new Video;
                $video->artist_id = $request->id;
                $video->video_file_1 = $request->video_file_1;
                $video->video_file_2 = $request->video_file_2;
                $video->video_file_3 = $request->video_file_3;
                $video->video_file_4 = $request->video_file_4;
                $video->video_file_5 = $request->video_file_5;
                $video->video_file_6 = $request->video_file_6;
                $video->video_file_7 = $request->video_file_7;
                $video->video_file_8 = $request->video_file_8;
                $video->video_file_9 = $request->video_file_9;
                $video->video_file_10 = $request->video_file_10;
                $video->status = $status;
                $video->save();
                return redirect()->back()->with('success', 'Video(s) have been inserted successfully');
            }else{
                $data = $request->all();
                Video::where(['artist_id' => $request->id])->update([
                    'video_file_1' => $data['video_file_1'],
                    'video_file_2' => $data['video_file_2'],
                    'video_file_3' => $data['video_file_3'],
                    'video_file_4' => $data['video_file_4'],
                    'video_file_5' => $data['video_file_5'],
                    'video_file_6' => $data['video_file_6'],
                    'video_file_7' => $data['video_file_7'],
                    'video_file_8' => $data['video_file_8'],
                    'video_file_9' => $data['video_file_9'],
                    'video_file_10' => $data['video_file_10']
                ]);
                return redirect()->back()->with('success', 'Video(s) have been updated successfully');
            }
        }
        return view('artist-dashboard')->with(compact('videoDetails'));
    }

    // Upload photos process function
    public function uploadPhotos(Request $request)
    {
        if ($request->isMethod('post')) {

            $data = $request->all();

            $artistphotos = $request->file('photo_file');
            foreach ($artistphotos as $artistphoto) {
                $photo_file = time() . "_" . $data['id'] . '_' . $artistphoto->getClientOriginalName();
                $uploadpath = public_path() . '/uploads/photos/';
                $artistphoto->move($uploadpath, $photo_file);

                if (empty($data['status'])) {
                    $status = '0';
                } else {
                    $status = '1';
                }

                $photo = new Photo;
                $photo->artist_id = $data['id'];
                $photo->photo_file = $photo_file;
                $photo->status = $status;
                $photo->save();
            }
            return back()->with('success', 'Photo has been uploaded successfully');
        }
        return view('/artist-dashboard');
    }

    public function deletePhotos(Request $request, $id = null)
    {
        if ($request->isMethod('get')) {

            Photo::where(['id'=>$id])->delete();
            return redirect()->back()->with('success', 'Photo has been deleted successfully');
        }
    }


   

    public function ourPanel(){
        $userDetails = FrontUser::get()->where('user_type','=','2')->where('status', '=', '1');
        return view('/our-panel')->with(compact('userDetails'));
    }
    public function searchPanel(Request $request)
    {
        $query = DB::table('front_users')->where('user_type', '=', '2')->where('status', '=', '1');
        $limit = 4;
        if ($request->limit) {
            $limit = $request->limit + 4;
            $query->limit($limit);
        } else {
            $query->limit(12);
        }
        $userDetails = $query->get();
        $total = count($userDetails);
        return view('/our-panel-list')->with(compact('userDetails', 'limit', 'total'));
    }

    public function stations(){
        return view('/stations');
    }

    public function likeArtist(Request $request)
    {
        if ($request->isMethod('get') && $request->segment(2)) {
            $id = $request->segment(2);
            $check = ArtistLikes::get()->where('artist_id', '=', $id)->where('user_id', '=', Session()->get('userId'))->count();
            if ($check <= 0) {
                $artistLikes = new ArtistLikes;
                $artistLikes->artist_id = $id;
                $artistLikes->user_id = Session()->get('userId');                
                $artistLikes->save();
                return redirect()->back();
                //return redirect()->back()->with('success', 'Like successful');
            } else {
                return redirect()->back();
                //return redirect()->back()->with('error', 'Already Liked');
            }
        }
        return view('/artist-profile');
    }
    public function DislikeArtist(Request $request)
    {
        if ($request->isMethod('get') && $request->segment(2)) {
            $id = $request->segment(2);
            $check = ArtistLikes::get()->where('artist_id', '=', $id)->where('user_id', '=', Session()->get('userId'))->count();
            if ($check >= 0) {
                DB::table('artist_likes')->where('artist_id', $id)->where('user_id', Session()->get('userId'))->delete();
                return redirect()->back()->with('success', 'Dislike successful');
            } else {
                return redirect()->back()->with('error', 'Already Disliked');
            }
        }
        return view('/artist-profile');
    }

    public function followUser(Request $request){
        if ($request->isMethod('get') && $request->segment(2)) {
            $id = $request->segment(2);             
            $check = Follower::get()->where('artist_id','=',$id)->where('follower_id','=',Session()->get('userId'))->count();
            if($check <= 0){
                $follower = new Follower;
                $follower->artist_id = $id;
                $follower->follower_id = Session()->get('userId');
                $follower->status = '1';
                $follower->save();
                return redirect()->back()->with('success', 'Follow successful');
            }else{
                return redirect()->back()->with('error', 'Already following');
            }
        }
        return view('/artist-profile');
    }
    public function unfollowUser(Request $request){
        if ($request->isMethod('get') && $request->segment(2)) {
            $id = $request->segment(2);            
            $check = Follower::get()->where('artist_id','=',$id)->where('follower_id','=',Session()->get('userId'))->count();
            if($check >= 0){                
                DB::table('followers')->where('artist_id', $id)->where('follower_id', Session()->get('userId'))->delete();
                return redirect()->back()->with('success', 'Unfollow successful');
            }else{
                return redirect()->back()->with('error', 'Already following');
            }
        }
        return view('/artist-profile');
    }

    public function songViewCounter(Request $request)
    {
        $tracksViewIp = new TracksViewIp();
        $tracksViewIp->track_id = $request->id;
        $tracksViewIp->visitor_ip = \Request::getClientIp();        
        $tracksViewIp->save();

        $TracksView = TracksViewIp::get()->where('track_id', '=', $request->id)->where('visitor_ip', '=', \Request::getClientIp())->count();

        $output = "";
        // if ($request->ajax()) {
        if ($TracksView === 1) {
            $views = DB::table('tracks')->select('views')->where('id', '=', $request->id)->get();
            $counter = $views[0]->views;
            $affected = DB::table('tracks')
            ->where('id', $request->id)
            ->update(['views' => $counter + 1]);    
        }
        


        //$top_songs = Track::get()->where('status', '=', '1');
        $dateTime = Carbon::now();
        $currentDate = $dateTime->toDateString();

        $query = DB::table('tracks')
        ->select('tracks.id', 'tracks.artist_id', 'tracks.track_name', 'tracks.track_file', 'tracks.cover_image', 'tracks.views', 'front_users.first_name', 'front_users.last_name')
        ->leftJoin('front_users', 'tracks.artist_id', '=', 'front_users.id')
        ->where('tracks.status', '=', '1')->where('front_users.status', '=', '1')->where('front_users.end_validity', '>=', $currentDate)
            ->orderByDesc('tracks.views')
            ->limit(10);
        $file_url = 'uploads/tracks/';
        if ($request->artist_id <> '') {
            $query->where('tracks.artist_id', '=', $request->artist_id);
            $file_url = url('uploads/tracks/');
        }
        $top_songs = $query->get();
        foreach ($top_songs as $song) {
            $output .= '<div class="top_songs_list ms_cover">
						<div class="top_songs_list_left">
							<div class="treanding_slider_main_box top_lis_left_content">
								<div class="top_songs_list0img">
									<img src="' . url('uploads/tracks/imgs/' . $song->cover_image) . '" alt="img"  width="50px" height="50px">
									<div class="ms_treanding_box_overlay">
										<div class="ms_tranding_box_overlay"></div>

										<div class="tranding_play_icon">											
											<i class="flaticon-play-button" onclick="playSong(&#39;' . $song->track_name . '&#39;,&#39;' . $song->first_name . ' ' . $song->last_name . '&#39; ,&#39;' . url('uploads/tracks/' . $song->track_file) . '&#39;,&#39;' . url('uploads/tracks/imgs/' . $song->cover_image) . '&#39;,&#39;' . $song->id . '&#39;)"></i>											
										</div>
									</div>
								</div>
								<div class="release_content_artist top_list_content_artist">
									<p onclick="playSong(&#39;' . $song->track_name . '&#39;,&#39;' . $song->first_name . ' ' . $song->last_name . '&#39; ,&#39;' . url('uploads/tracks/' . $song->track_file) . '&#39;,&#39;' . url('uploads/tracks/imgs/' . $song->cover_image) . '&#39;,&#39;' . $song->id . '&#39;)"><a title="' . $song->track_name . '"  style="cursor:pointer;">' . substr($song->track_name, 0, 15) . ' ...</a></p>
									<p class="various_artist_text"><a href="profile/'.$song->artist_id.'">' . $song->first_name . ' ' . $song->last_name . '</a></p>
								</div>

                            </div>
                            <script>
							getDuration("' . $file_url . '/'. $song->track_file . '", function(length) {							
								document.getElementById("duration' . $song->id . '").textContent = Math.trunc(length / 60) + ":" + Math.trunc(length % 60);
							});
							</script>
							<div class="top_list_tract_time" id="duration' . $song->id . '">								
							</div>
						</div>
						<div class="top_songs_list_right">
							<div class="top_list_tract_view">
								<p>' . $song->views . ' Plays</p>
							</div>
							<div class="top_song_list_picks">
								<div class="ms_tranding_more_icon">
									<i class="flaticon-menu"></i>
								</div>
								<ul class="tranding_more_option">
									<li  onclick="addPlayList(&#39;' . $song->track_name . '&#39;,&#39;' . $song->first_name . ' ' . $song->last_name . '&#39; ,&#39;' . url('uploads/tracks/' . $song->track_file) . '&#39;,&#39;' . url('uploads/tracks/imgs/' . $song->cover_image) . '&#39;,&#39;' . $song->id . '&#39;)"><a><span class="opt_icon"><i class="flaticon-playlist"></i></span>Add To playlist</a></li>									
								</ul>
							</div>
						</div>
                    </div>';
        }

        return Response($output);
        // }
    }    
}
