<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\FrontUser;
use App\Track;
use Illuminate\Support\Facades\Storage;
use Session;
use App\PaypalSubscribers;

class UserController extends Controller
{

    protected $PaypalAPIController;
    public function __construct(PaypalAPIController $PaypalAPIController)
    {
        $this->PaypalAPIController = $PaypalAPIController;
    }

    public function viewAdmin(){ 
        $users = User::get();
        return view('admin.users.admin-user')->with(compact('users'));
    }

    public function viewArtist(){ 
        $users = FrontUser::get()->where('user_type','=',1);
        return view('admin.users.artist-user')->with(compact('users'));
    }

    public function viewPanel(){
        $users = FrontUser::get()->where('user_type', '=', 2);
        return view('admin.users.panel-user')->with(compact('users'));
    }


    public function editPanel(Request $request,$id=null){

        $userDetails = FrontUser::where(['id' => $id])->first();
        if ($request->isMethod('post')) {
            $data = $request->all();
            /*if ($request->file('profile_image')) {
                $userpic = $request->file('profile_image');
                $profile_image = time() . "_" . $userpic->getClientOriginalName();
                $uploadpath = public_path() . '/uploads/';
                $userpic->move($uploadpath, $profile_image);
                Session::put('profileImg', $profile_image);
            } else {
                $profile_image = Session::get('profileImg');
            }*/



            $birthdate = date('Y-m-d', strtotime($data['birthdate']));
            FrontUser::where(['id' => $id])->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'genre' => $data['genre'],
                'country' => $data['country'],
                'city' => $data['city'],
                'birthdate' => $birthdate,
                'profile_image' => ($data['profile_image'] ? $data['profile_image'] : $userDetails->profile_image ),
                'biography' => $data['biography']
            ]);

            return redirect()->back()->with('flash_message_success', 'Panel has been updated successfully');
        }
        return view('admin.users.panel-edit')->with(compact('userDetails'));
    }

    
    public function viewFan(){ 
        $users = FrontUser::get()->where('user_type', '=', 3);
        return view('admin.users.fan-user')->with(compact('users'));
    }
	
	public function deleteArtist($id = null){
        
        $tracks = Track::get()->where('artist_id', '=', $id);
        foreach ($tracks as $key => $song) {
            $song_path = public_path("uploads/tracks/" . $song->track_file);            
            if (file_exists($song_path) AND !empty($song->track_file)) {                
                unlink($song_path);                
            } 
        }
        FrontUser::where(['id' => $id])->delete();
        Track::where(['artist_id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'Artist has been deleted successfully');
    }
	
	public function deletePanel($id = null){
        FrontUser::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'Panel has been deleted successfully');
    }
	
	public function deleteFan($id = null){
        FrontUser::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'Fan has been deleted successfully');
    }
	

    public function updateStatus(Request $request,$id=null){
        if($request->isMethod('get')) {

            $data = FrontUser::where(['id' => $id])->first();

            $agreementDetails = PaypalSubscribers::where(['user_id' => $data->id])->orderBy('id', 'DESC')->get();

            if ($data['status'] == '1') {
                $status = '0';
                $plan_status = 'suspend';
                $status1 = 'SUSPENDED';
            } else {
                $status = '1';
                $plan_status = 'activate';
                $status1 = 'ACTIVE';
            }

            if (count($agreementDetails) > 0) {

                $subscriptionID = $agreementDetails[0]->subscriptionID;

                try {
                    $request = array(
                        'method' => 'POST',
                        'urlPath' => '/billing/subscriptions/' . $subscriptionID . '/' . $plan_status,
                        'body' => ['reason' => 'Requested by user']
                    );
                    //$res = $this->PAYPAL_API($request);
                    $res = $this->PaypalAPIController->PAYPAL_API($request);

                    if ($res['statusCode'] == 204) {

                        PaypalSubscribers::where(['subscriptionID' => $subscriptionID])->update([
                            'status' => $status1,
                        ]);

                        FrontUser::where(['id' => $id])->update([
                            'status' => $status
                        ]);

                        // return redirect('/dashboard')->with('success', 'Subscription '.$status);
                        return redirect()->back()->with('flash_message_success', 'User status has been updated successfully');
                    }
                } catch (\Throwable $th) {
                    //return redirect('/dashboard')->with('error', 'Something is wrong'.$th);
                    return redirect()->back()->with('flash_message_error', 'Something is wrong' . $th);
                }
            }else{
                FrontUser::where(['id' => $id])->update([
                    'status' => $status
                ]);

                return redirect()->back()->with('flash_message_success', 'User status has been updated successfully');
            }

        }
    }

    public function isFeatured(Request $request,$id=null){
        if($request->isMethod('get')){

            $data = FrontUser::where(['id'=>$id])->first();
            
            if($data['featured'] == '1'){
                $featured='0';
            }else{
                $featured='1';
            }

            FrontUser::where(['id'=>$id])->update([
                'featured'=>$featured
            ]);
            return redirect()->back()->with('flash_message_success', 'Artist has been updated');
        }
    }

    public function isHomeFeatured(Request $request,$id=null){
        if($request->isMethod('get')){

            $data = FrontUser::where(['id'=>$id])->first();
            
            if($data['homefeatured'] == '1'){
                $homefeatured='0';
            }else{
                $homefeatured='1';
            }

            FrontUser::where(['id'=>$id])->update([
                'homefeatured'=>$homefeatured
            ]);
            return redirect()->back()->with('flash_message_success', 'Artist has been updated');
        }
    }

}
