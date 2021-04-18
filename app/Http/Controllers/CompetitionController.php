<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Competition;
use DB;
class CompetitionController extends Controller
{
    public function addCompetition(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            
            /*$competitionpic = $request->file('featured_image');

            if(empty($competitionpic)){
                $featured_image = "blog_cat1.jpg";
                $uploadpath = public_path().'/uploads/';
            }else{
                $featured_image = time()."_".$competitionpic->getClientOriginalName();
                $uploadpath = public_path().'/uploads/';
                $competitionpic->move($uploadpath, $featured_image);
            }*/


            if(empty($data['status'])){
                $status='0';
            }else{
                $status='1';
            }

            $competition = new Competition;
            $competition->competition_name = $data['competition_name'];
            $competition->short_description = $data['short_description'];
            $competition->description = $data['description'];
            $competition->venue = $data['venue'];
            //$competition->featured_image = $featured_image;
            $competition->featured_image = ($data['featured_image'] ? $data['featured_image'] : 'default_img.png' );
            $competition->status = $status;
            $competition->start_datetime = date('Y-m-d h:i:s', strtotime($data['start_datetime']));
            $competition->end_datetime = date('Y-m-d h:i:s', strtotime($data['end_datetime']));
            $competition->save();
            return redirect()->back()->with('flash_message_success', 'Competition has been added successfully');
        }
        return view('admin.competitions.create');
    }

    public function editCompetition(Request $request,$id=null){

        $competitionDetails = Competition::where(['id'=>$id])->first();
        
        if($request->isMethod('post')){
            $data = $request->all();

            /*if ($request->file('featured_image')) {
                $competitionpic = $request->file('featured_image');
                $featured_image = time() . "_" . $competitionpic->getClientOriginalName();
                $uploadpath = public_path().'/uploads/';
                $competitionpic->move($uploadpath, $featured_image);
            } else {
                $featured_image = $competitionDetails->featured_image;
            }*/
            
            if(empty($data['status'])){
                $status='0';
            }else{
                $status='1';
            }

            Competition::where(['id'=>$id])->update([
                'status' => $status,
                'competition_name' => $data['competition_name'],
                'short_description' => $data['short_description'],
                'description' => $data['description'],
                'venue' => $data['venue'],
                //'featured_image' => $featured_image,
                'featured_image' => ($data['featured_image'] ? $data['featured_image'] : $competitionDetails->featured_image ),
                'start_datetime' => date('Y-m-d h:i:s', strtotime($data['start_datetime'])),
                'end_datetime' => date('Y-m-d h:i:s', strtotime($data['end_datetime']))
            ]);
            return redirect()->back()->with('flash_message_success', 'Competition has been updated successfully');
        }
        return view('admin.competitions.edit')->with(compact('competitionDetails'));
    }

    public function deleteCompetition($id = null){
        Competition::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'Competition has been deleted successfully');
    }

    public function viewCompetitions(){ 
        $competitions = Competition::get();
        return view('admin.competitions.index')->with(compact('competitions'));
    }

    public function userCompetitions()
    {
        $competitions = Competition::orderBy('start_datetime', 'desc')->paginate(12);
        return view('competitions/index')->with(compact('competitions'));
    }

    public function userCompetitionsAjax(Request $request)
    {
        if ($request->ajax()) {

            $output = "";
            $query = DB::table('competitions')
                    ->orderBy('start_datetime', 'desc');

            $limit = 12;
            if ($request->limit) {
                $limit = $request->limit + 4;
                $query->limit($limit);
            } else {
                $query->limit(12);
            }
            $competitions = $query->get();
            if (sizeof($competitions) <= 0) {
                $output .= '<p style="margin:0 auto;">No Records Found. Please try again.</p>';
                return Response($output);
            }
            $total = count($competitions);
            return view('competitions/list')->with(compact('competitions', 'limit', 'total'));            
        }
    }
}
