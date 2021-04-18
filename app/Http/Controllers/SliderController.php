<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;

class SliderController extends Controller
{
    public function addSlider(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            
            $sliderpic = $request->file('slider_image');
            $slider_image = time()."_".$sliderpic->getClientOriginalName();
            $uploadpath = public_path().'/uploads/';
            $sliderpic->move($uploadpath, $slider_image);

            if(empty($data['status'])){
                $status='0';
            }else{
                $status='1';
            }

            $slider = new Slider;
            $slider->heading_1 = $data['heading_1'];
            $slider->heading_2 = $data['heading_2'];
            $slider->description = $data['description'];
            $slider->slider_image = $slider_image;
            $slider->button_url = $data['button_url'];
            $slider->status = $status;
            $slider->save();
            return redirect()->back()->with('flash_message_success', 'Slider has been added successfully');
        }
        return view('admin.sliders.create');
    }

    public function editSlider(Request $request,$id=null){

        $sliderDetails = Slider::where(['id'=>$id])->first();

        if($request->isMethod('post')){
            $data = $request->all();

            if ($request->file('slider_image')) {
                $sliderpic = $request->file('slider_image');
                $slider_image = time()."_".$sliderpic->getClientOriginalName();
                $uploadpath = public_path().'/uploads/';
                $sliderpic->move($uploadpath, $slider_image);
            }else{
                $slider_image = $sliderDetails->slider_image;
            }

            if(empty($data['status'])){
                $status='0';
            }else{
                $status='1';
            }

            Slider::where(['id'=>$id])->update([
                'heading_1' => $data['heading_1'],
                'heading_2' => $data['heading_2'],
                'description' => $data['description'],
                'slider_image' => $slider_image,
                'button_url' => $data['button_url'],
                'status' => $status
            ]);
            return redirect()->back()->with('flash_message_success', 'Slider has been updated successfully');
        }
        return view('admin.sliders.edit')->with(compact('sliderDetails'));
    }

    public function deleteSlider($id = null){
        Slider::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'Slider has been deleted successfully');
    }

    public function viewSliders(){ 
        $sliders = Slider::get();
        return view('admin.sliders.index')->with(compact('sliders'));
    }
}
