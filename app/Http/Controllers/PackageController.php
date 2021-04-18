<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package;

class PackageController extends Controller
{
	public function addPackage(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->all();

            if(empty($data['status'])){
                $status='0';
            }else{
                $status='1';
            }

    		$package = new Package; 
    		$package->title = $data['title'];
            $package->description = htmlentities($data['description']);
    		$package->price = $data['price'];
    		$package->track_limit = $data['track_limit'];
            $package->status = $status;
    		$package->save();
    		return redirect()->back()->with('flash_message_success', 'Package has been added successfully');
    	}
    	//return view('admin.packages.create')->with(compact('packages'));
        return view('admin.packages.create');
    }

    public function editPackage(Request $request,$id=null){
        if($request->isMethod('post')){
            $data = $request->all();

            if(empty($data['status'])){
                $status='0';
            }else{
                $status='1';
            }

            Package::where(['id'=>$id])->update([
            	'status'=>$status,
            	'title'=>$data['title'],
            	'description'=> htmlentities($data['description']),
            	'price'=>$data['price'],
            	'track_limit'=>$data['track_limit']
            ]);
            return redirect()->back()->with('flash_message_success', 'Package has been updated successfully');
        }

        $packageDetails = Package::where(['id'=>$id])->first();
        //return view('admin.packages.edit')->with(compact('packageDetails','packages'));
        return view('admin.packages.edit')->with(compact('packageDetails'));
    }

    public function deletePackage($id = null){
        Package::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'Package has been deleted successfully');
    }

    public function viewPackage(){ 
        $packages = Package::get();
        return view('admin.packages.index')->with(compact('packages'));
    }
}
