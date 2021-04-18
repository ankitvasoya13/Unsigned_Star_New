<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use App\TracksViewIp;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\FrontUser;
use DB;

class TopSongController extends Controller
{
    public function index(Request $request)
    {
        $dateTime = Carbon::now();
        $currentDate = $dateTime->toDateString();
        // Start Song Counnter
        if ($request->id) {            
            $tracksViewIp = new TracksViewIp();
            $tracksViewIp->track_id = $request->id;
            $tracksViewIp->visitor_ip = \Request::getClientIp();
            $tracksViewIp->save();
            $TracksView = TracksViewIp::get()->where('track_id', '=', $request->id)->where('visitor_ip', '=', \Request::getClientIp())->count();
            if ($TracksView === 1) {
                $views = DB::table('tracks')->select('views')->where('id', '=', $request->id)->get();
                $counter = $views[0]->views;
                $affected = DB::table('tracks')
                    ->where('id', $request->id)
                    ->update(['views' => $counter + 1]);
            }
        }
        // End Song Counnter

        // Start Show Top song list
        $query = DB::table('tracks')
        ->select('tracks.id','tracks.artist_id', 'tracks.track_name', 'tracks.track_file', 'tracks.cover_image', 'tracks.views', 'front_users.first_name', 'front_users.last_name')
        ->leftJoin('front_users', 'tracks.artist_id', '=', 'front_users.id')
        ->where('tracks.status', '=', '1')
            ->where('front_users.status', '=', '1')
            ->where('front_users.end_validity', '>=', $currentDate)
            ->orderByDesc('tracks.views');
        $allTopSong = $query->get();
        $total = count($allTopSong);
        $limit = null;
        $file_url = url('uploads/tracks/');
        if ($request->limit && $request->limit != null) {
            $limit = ($request->id) ? $request->limit : $request->limit + 1 ;
            // $limit = $request->limit + 1;
            $query->limit($limit);
        } else {
            $query->limit(10);
        }
        $top_songs = $query->get();

        $topSongCount = count($top_songs);
        // End Show Top song list
        // pr($top_songs);
        return view('/layouts/topsong')->with(compact('top_songs','limit','total','file_url','topSongCount'));
    }

}
