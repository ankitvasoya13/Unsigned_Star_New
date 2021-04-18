<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use DB;
class EventController extends Controller
{
    public function addEvent(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            
            //$eventpic = $request->file('featured_image');

            /*if(empty($eventpic)){
                $featured_image = "blog_cat1.jpg";
                $uploadpath = public_path().'/uploads/';
            }else{
                $featured_image = time()."_".$eventpic->getClientOriginalName();
                $uploadpath = public_path().'/uploads/';
                $eventpic->move($uploadpath, $featured_image);
            }*/


            if(empty($data['status'])){
                $status='0';
            }else{
                $status='1';
            }

            $event = new Event;
            $event->event_name = $data['event_name'];
            $event->short_description = $data['short_description'];
            $event->description = $data['description'];
            $event->venue = $data['venue'];
            //$event->featured_image = $featured_image;
            $event->featured_image = ($data['featured_image'] ? $data['featured_image'] : 'default_img.png' );
            $event->status = $status;
            $event->start_datetime = date('Y-m-d h:i:s', strtotime($data['start_datetime']));
            $event->end_datetime = date('Y-m-d h:i:s', strtotime($data['end_datetime']));
            $event->save();
            return redirect()->back()->with('flash_message_success', 'Event has been added successfully');
        }
        return view('admin.events.create');
    }

    public function editEvent(Request $request,$id=null){

        $eventDetails = Event::where(['id'=>$id])->first();
        
        if($request->isMethod('post')){
            $data = $request->all();

            /*if ($request->file('featured_image')) {
                $eventpic = $request->file('featured_image');
                $featured_image = time() . "_" . $eventpic->getClientOriginalName();
                $uploadpath = public_path().'/uploads/';
                $eventpic->move($uploadpath, $featured_image);
            } else {
                $featured_image = $eventDetails->featured_image;
            }*/
            
            if(empty($data['status'])){
                $status='0';
            }else{
                $status='1';
            }

            Event::where(['id'=>$id])->update([
                'status' => $status,
                'event_name' => $data['event_name'],
                'short_description' => $data['short_description'],
                'description' => $data['description'],
                'venue' => $data['venue'],
                //'featured_image' => $featured_image,
                'featured_image' => ($data['featured_image'] ? $data['featured_image'] : $eventDetails->featured_image ),
                'start_datetime' => date('Y-m-d h:i:s', strtotime($data['start_datetime'])),
                'end_datetime' => date('Y-m-d h:i:s', strtotime($data['end_datetime']))
            ]);
            return redirect()->back()->with('flash_message_success', 'Event has been updated successfully');
        }
        return view('admin.events.edit')->with(compact('eventDetails'));
    }

    public function deleteEvent($id = null){
        Event::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'Event has been deleted successfully');
    }

    public function viewEvents(){ 
        $events = Event::get();
        return view('admin.events.index')->with(compact('events'));
    }

    public function userEvents()
    {
        $events = Event::orderBy('start_datetime', 'desc')->paginate(12);
        return view('events/index')->with(compact('events'));
    }

    public function userEventsAjax(Request $request)
    {
        if ($request->ajax()) {

            $output = "";
            $query = DB::table('events')
                    ->orderBy('start_datetime', 'desc');

            $limit = 12;
            if ($request->limit) {
                $limit = $request->limit + 4;
                $query->limit($limit);
            } else {
                $query->limit(12);
            }
            $events = $query->get();
            if (sizeof($events) <= 0) {
                $output .= '<p style="margin:0 auto;">No Records Found. Please try again.</p>';
                return Response($output);
            }
            $total = count($events);
            return view('events/list')->with(compact('events', 'limit', 'total'));            
        }
    }
}
