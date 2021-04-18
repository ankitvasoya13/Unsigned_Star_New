<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Page;
use App\Story;
use App\Transaction;
use App\Event;
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
use Carbon\Carbon;
use Session;
use DB;
class ArtistController extends Controller
{
    public function index()
    {
        # code...
    }
    public function getArtists()
    {
        $artistUsers = FrontUser::get()->where('user_type', '=', '1')->where('status', '=', '1');
        return view('/artist-list')->with(compact('artistUsers'));
    }
    public function getFeaturedArtists()
    {
        $dateTime = Carbon::now();
        $currentDate = $dateTime->toDateString();
        $userDetails = FrontUser::orderBy('first_name', 'asc')->get()->where('user_type', '=', '1')->where('status', '=', '1')->where('featured', '=', '1')->where('end_validity', '>=', $currentDate);
        return view('/featured-artists')->with(compact('userDetails'));
    }

    public function getTopArtists()
    {
        return view('/top-artists');
    }
    public function searchArtist(Request $request)
    {
        $dateTime = Carbon::now();
        $currentDate = $dateTime->toDateString();
        
        if ($request->ajax()) {

            $output = "";
            $query = DB::table('front_users')
            ->Where(DB::raw('concat(first_name, " ", last_name)'), 'like', '%' . $request->text . '%')
                ->Where('user_type', '=', '1')
                ->where('status', '=', '1')
                ->where('end_validity','>=', $currentDate);
            if ($request->country <> "All Countries") {
                $query->where('country', '=', $request->country);
            }
            if ($request->genres <> "All Genres") {
                $query->where('genre', '=', $request->genres);
            }
            
            if ($request->type === 'home') {
                // if ($request->text <> "" || $request->country <> "All Countries" || $request->genres <> "All Genres") {
                    $artistUsers = $query->get();
                    $total = count($artistUsers);
                    if (sizeof($artistUsers) <= 0) {
                        $output .= '<p style="margin:0 auto;">No Records Found. Please try again.</p>';
                        return Response($output);
                    }

                    $limit = 4;
                    if ($request->limit) {
                        $limit = $request->limit + 4;
                        $query->limit($limit);
                    }
                    $artistUsers = $query->get();

                // } else {
                //     $limit = 0;
                //     $total = 0;
                //     $artistUsers = [];
                // }
            }
            if ($request->type === 'artist') {
                $artistUsers = $query->get();
                $total = count($artistUsers);

                if (sizeof($artistUsers) <= 0) {
                    $output .= '<p style="margin:0 auto;">No Records Found. Please try again.</p>';
                    return Response($output);
                }

                $limit = 4;
                if ($request->limit) {
                    $limit = $request->limit + 4;
                    $query->limit($limit);
                }
                $artistUsers = $query->get();
            }
            if ($request->type === 'featuredArtist') {
                $query->where('featured', '=', '1');
                $artistUsers = $query->get();
                $total = count($artistUsers);

                $limit = 4;
                if ($request->limit) {
                    $limit = $request->limit + 4;
                    $query->limit($limit);
                }
                $artistUsers = $query->get();
                if (sizeof($artistUsers) <= 0) {
                    $output .= '<p style="margin:0 auto;">No Records Found. Please try again.</p>';
                    return Response($output);
                }
            }
            
            return view('search/result')->with(compact('artistUsers', 'limit', 'total'));
        }
    }
    public function searchTopArtist(Request $request)
    {
        $dateTime = Carbon::now();
        $currentDate = $dateTime->toDateString();
        if ($request->ajax()) {

            $output = "";
            $query = DB::table('front_users')
            ->leftJoin('artist_likes', 'artist_likes.artist_id', '=', 'front_users.id')
            ->selectRaw('front_users.*, count(artist_likes.artist_id) as LikesCount')
            ->where('front_users.user_type', '=', '1')->where('front_users.status', '=', '1')->where('front_users.end_validity', '>=', $currentDate)
                ->Where(DB::raw('concat(first_name, " ", last_name)'), 'like', '%' . $request->text . '%')                
                ->groupBy('front_users.id')
                ->orderBy('LikesCount', 'desc');
            
            if ($request->country <> "All Countries") {
                $query->where('front_users.country', '=', $request->country);
            }
            if ($request->genres <> "All Genres") {
                $query->where('front_users.genre', '=', $request->genres);
            }
            $artistUsers = $query->get();
            $total = count($artistUsers);
            
            $limit = 4;
            if ($request->limit) {
                $limit = $request->limit + 4;
                $query->limit($limit);
            }
            
            $artistUsers = $query->get();
            if (sizeof($artistUsers) <= 0) {
                $output .= '<p style="margin:0 auto;">No Records Found. Please try again.</p>';
                return Response($output);
            }
            
            return view('search/topResult')->with(compact('artistUsers', 'limit', 'total'));
        }
    }

    function upload(Request $request)
    {
        if ($request->ajax()) {
            $image_data = $request->image;
            $image_array_1 = explode(";", $image_data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $image_name = time() . '.png';
            $upload_path = public_path('uploads/' . $image_name);
            file_put_contents($upload_path, $data);
            
            FrontUser::where(['id' => $request->id])->update([
                'profile_image' => $image_name
            ]);
            Session::put('profileImg', $image_name);
            return response()->json(['path' => '/uploads/' . $image_name]);
        }
    }

    function PhotoUpload(Request $request)
    {
        if ($request->ajax()) {
            $image_data = $request->image;
            $image_array_1 = explode(";", $image_data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $image_name = time() . '.png';
            $upload_path = public_path('uploads/photos/' . $image_name);
            file_put_contents($upload_path, $data);

            // FrontUser::where(['id' => $request->id])->update([
            //     'profile_image' => $image_name
            // ]);
            // Session::put('profileImg', $image_name);
            $photo = new Photo;
            $photo->artist_id = $request->id;
            $photo->photo_file = $image_name;
            $photo->status = '0';
            $photo->save();
            return response()->json(['path' => '/uploads/' . $image_name]);
        }
    }
}
