<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class PageController extends Controller
{
    public function addPage(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            /*$pagepic = $request->file('featured_image');

            if(empty($pagepic)){
                $featured_image = "blog_cat1.jpg";
                $uploadpath = public_path().'/uploads/';
            }else{
                $featured_image = time()."_".$pagepic->getClientOriginalName();
                $uploadpath = public_path().'/uploads/';
                $pagepic->move($uploadpath, $featured_image);
            }*/

            
            if(empty($data['status'])){
                $status='0';
            }else{
                $status='1';
            }

            $page = new Page;
            $page->title = $data['title'];
            $page->content = $data['content'];
            //$page->featured_image = $featured_image;
            $page->featured_image = ($data['featured_image'] ? $data['featured_image'] : 'default_img.png' );
            $page->status = $status;
            $page->meta_title = $data['meta_title'];
            $page->meta_description = $data['meta_description'];
            $page->meta_url = $data['meta_url'];
            $page->save();
            return redirect()->back()->with('flash_message_success', 'Page has been added successfully');
        }
        return view('admin.pages.create');
    }

    public function editPage(Request $request,$id=null){
        
        $pageDetails = Page::where(['id'=>$id])->first();

        if($request->isMethod('post')){
            $data = $request->all();

            if ($request->file('featured_image')) {
                $pagepic = $request->file('featured_image');
                $featured_image = time() . "_" . $pagepic->getClientOriginalName();
                $uploadpath = public_path().'/uploads/';
                $pagepic->move($uploadpath, $featured_image);
            } else {
                $featured_image = $pageDetails->featured_image;
            }

            if(empty($data['status'])){
                $status='0';
            }else{
                $status='1';
            }

            Page::where(['id'=>$id])->update([
                'status' => $status,
                'title' => $data['title'],
                'content' => $data['content'],
                'featured_image' => ($data['featured_image'] ? $data['featured_image'] : $pageDetails->featured_image ),
                'meta_title' => $data['meta_title'],
                'meta_description' => $data['meta_description'],
                'meta_url' => $data['meta_url']
            ]);
            return redirect()->back()->with('flash_message_success', 'Page has been updated successfully');
        }
        return view('admin.pages.edit')->with(compact('pageDetails'));
    }

    public function deletePage($id = null){
        Page::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'Page has been deleted successfully');
    }

    public function viewPages(){ 
        $pages = Page::get();
        return view('admin.pages.index')->with(compact('pages'));
    }
}
