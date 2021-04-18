<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Story;
use DB;
class StoryController extends Controller
{
    public function addStory(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            
            /*$storypic = $request->file('featured_image');
			if(empty($storypic)) {
				$featured_image = "blog_cat1.jpg";
            	$uploadpath = public_path().'/uploads/';
            	//$storypic->move($uploadpath, $featured_image);
            }else{
            	$featured_image = time()."_".$storypic->getClientOriginalName();
            	$uploadpath = public_path().'/uploads/';
            	$storypic->move($uploadpath, $featured_image);
            }*/

            if(empty($data['status'])){
                $status='0';
            }else{
                $status='1';
            }

            $story = new Story;
            $story->title = $data['title'];
            $story->short_description = $data['short_description'];
            $story->description = $data['description'];
            //$story->featured_image = $featured_image;
            $story->featured_image = ($data['featured_image'] ? $data['featured_image'] : 'default_img.png' );
            $story->created_at = date('Y-m-d h:i:s', strtotime($data['created_at']));
            $story->status = $status;
            $story->save();
            return redirect()->back()->with('flash_message_success', 'Story has been added successfully');
        }
        return view('admin.stories.create');
    }

    public function editStory(Request $request,$id=null){

        $storyDetails = Story::where(['id'=>$id])->first();

        if($request->isMethod('post')){
            $data = $request->all();
            
            /*if ($request->file('featured_image')) {
                $storypic = $request->file('featured_image');
                $featured_image = time()."_".$storypic->getClientOriginalName();
                $uploadpath = public_path().'/uploads/';
                $storypic->move($uploadpath, $featured_image);
            } else {
                $featured_image = $storyDetails->featured_image;
            }*/

            if(empty($data['status'])){
                $status='0';
            }else{
                $status='1';
            }

            Story::where(['id'=>$id])->update([
                'status' => $status,
                'title' => $data['title'],
                'short_description' => $data['short_description'],
                'description' => $data['description'],
                //'featured_image' => $featured_image,
                'featured_image' => ($data['featured_image'] ? $data['featured_image'] : $storyDetails->featured_image ),
                'created_at' => date('Y-m-d h:i:s', strtotime($data['created_at']))
            ]);
            return redirect()->back()->with('flash_message_success', 'Story has been updated successfully');
        }
        return view('admin.stories.edit')->with(compact('storyDetails'));
    }

    public function deleteStory($id = null){
        Story::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'Story has been deleted successfully');
    }

    public function viewStories(){ 
        $stories = Story::get();
        return view('admin.stories.index')->with(compact('stories'));
    }

    public function userStory()
    {
        $stories = Story::orderBy('created_at', 'desc')->paginate(12);
        return view('stories/index')->with(compact('stories'));
    }


    public function userStoryAjax(Request $request)
    {
        if ($request->ajax()) {

            $output = "";
            $query = DB::table('stories')
            ->orderBy('created_at', 'desc');

            $limit = 12;
            if ($request->limit) {
                $limit = $request->limit + 4;
                $query->limit($limit);
            } else {
                $query->limit(12);
            }
            $stories = $query->get();
            if (sizeof($stories) <= 0) {
                $output .= '<p style="margin:0 auto;">No Records Found. Please try again.</p>';
                return Response($output);
            }
            $total = count($stories);
            return view('stories/list')->with(compact('stories', 'limit', 'total'));
        }
    }
}
