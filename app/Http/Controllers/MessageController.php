<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Response;
use DB;
use App\FrontUser;
use Session;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        //$artistDetails = FrontUser::where(['id' => $request->segment(2)])->first();
        if ($request->segment(2) && Session()->get('userId') && Session()->get('userType') == '2') {

            $output = "";
            $query = DB::table('messages')
                ->Where('panel_member_id', '=', Session()->get('userId'))
                ->where('artist_id', '=', $request->segment(2))
                ->orderBy('id', 'ASC');
            $messages = $query->get();

            if (count($messages) <= 0) {
                $message = new Message();
                $message->artist_id = $request->segment(2);
                $message->panel_member_id = Session()->get('userId');
                $message->message = 'Hi';
                $message->sender = 'panel';
                $message->is_read_panel = 1;
                $message->save();
            }

            // return view('message')->with(compact('messages', 'artistDetails'));
        }
        return view('messages/index');
    }


    public function sendMessage(Request $request)
    {
        $message = new Message();
        $message->artist_id = $request->artist_id;
        $message->panel_member_id = $request->panel_member_id;
        $message->message = $request->message;
        $message->sender = $request->sender;
        $message->save();

        return $this->getMessage($request);
    }
    public function getMessage(Request $request)
    {
        $sender = $request->sender;
        if ($sender == 'artist') {
            $receiverUser = FrontUser::select('id', 'first_name', 'last_name', 'profile_image')->where(['id' => $request->panel_member_id])->first();
        }else{
            $receiverUser = FrontUser::select('id', 'first_name', 'last_name', 'profile_image')->where(['id' => $request->artist_id])->first();
        }
        if ($request->panel_member_id && $request->artist_id) {
            $query = DB::table('messages')
            ->Where('panel_member_id', '=', $request->panel_member_id)
                ->where('artist_id', '=', $request->artist_id)
                ->orderBy('id', 'ASC');
            $messages = $query->get();
            $lastMessage = DB::table('messages')
                ->Where('panel_member_id', '=', $request->panel_member_id)
                ->where('artist_id', '=', $request->artist_id)                
                ->orderBy('id', 'DESC')->first();
            if (Session()->get('userType') == '1') {
                Message::where(['panel_member_id' => $request->panel_member_id,'artist_id' => $request->artist_id])->update(['is_read_artist' => 1]);                
            }
            if (Session()->get('userType') == '2') {
                Message::where(['panel_member_id' => $request->panel_member_id, 'artist_id' => $request->artist_id])->update(['is_read_panel' => 1]);
            }
            return view('messages/messages')->with(compact('messages', 'sender', 'receiverUser'));
        } else {
            return "<span style='color:gray;'>Please select user from list.</span>";
        }

    }

    public function getChatList(Request $request)
    {
        if ($request->sender == 'artist') {
            $chatUsers = DB::table('messages')
            ->select('*', DB::raw('min(messages.is_read_artist) as is_read'), DB::raw('count(messages.is_read_artist) as unread'), DB::raw('max(messages.created_at) as createdAt'))
            ->rightJoin('front_users', 'front_users.id', '=', 'messages.panel_member_id')
            ->where('messages.artist_id', '=', $request->artist_id)
            ->where('front_users.user_type', '=', '2')
            ->groupBy('messages.panel_member_id')
            ->orderBy('createdAt', 'desc')
            ->get();
            $receiverId = $request->panel_member_id;            
            // echo "<pre>"; print_r($chatUsers);exit;
        } else {
            $chatUsers = DB::table('messages')
            ->select('*', DB::raw('min(messages.is_read_panel) as is_read'), DB::raw('count(messages.is_read_panel) as unread'), DB::raw('max(messages.created_at) as createdAt'))
            ->rightJoin('front_users', 'front_users.id', '=', 'messages.artist_id')
            ->where('messages.panel_member_id', '=', $request->panel_member_id)
            ->where('front_users.user_type', '=', '1')
            ->groupBy('messages.artist_id')
            ->orderBy('createdAt', 'desc')
            ->get();
            // echo "<pre>"; print_r($chatUsers);exit;
            $receiverId = $request->artist_id;
        }
        return view('messages/list')->with(compact('chatUsers', 'receiverId'));




        // $users = DB::table('messages')->select("front_users.id", "front_users.first_name", "front_users.profile_image", "front_users.email", DB::raw('min(messages.is_read) as is_read'), DB::raw('count(messages.is_read) as unread'), DB::raw('max(messages.created_at) as createdAt'))
        // ->leftJoin('front_users', 'front_users.id', '=', 'messages.from', 'messages.is_read', '=', 1, 'messages.from', '=', 37)
        // ->where('messages.from', '=', 37)
        // ->groupBy('front_users.id', 'front_users.first_name', 'front_users.profile_image')
        // ->orderBy('createdAt', 'desc')
        // ->get();
        //return view('messages/list', ['chatUsers' => $users]);
        
    }
    public function getMessageNotification(Request $request)
    {
        if ($request->type == 1) {
            $notification = DB::table('messages')
                ->where('is_read_artist', '=', 0)
                ->where('artist_id', '=', $request->id)
                ->get();
        } else {
            $notification = DB::table('messages')
                ->where('is_read_panel', '=', 0)
                ->where('panel_member_id', '=', $request->id)
                ->get();
        }
        return Response($notification->count());
    }
}
