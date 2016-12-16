<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\keyfilter;

class KeyfilterController extends Controller
{
    //
    public function getList(){
    	$keyfilter = keyfilter::paginate(10);
    	return view('admin/keyfilter/list',['keyfilter'=>$keyfilter]);
    }

    public function getAdd(){
    	$keyfilter = keyfilter::all();
    	return view('admin/keyfilter/add',['keyfilter'=>$keyfilter]);
    }

    public function postAdd(Request $request){
    	$this->validate($request,[
    		'name'=>'required|min:3',
    		'description'=>'required|min:3',
    		'status'=>'required'
    		]);
    	$keyfilter = new keyfilter;
    	$keyfilter->name = $request->name;
    	$keyfilter->description = $request->description;
    	$keyfilter->status = $request->status;
    	$keyfilter->save();

    	return redirect('admin/keyfilter/add')->with('notify','Add Keyfilter Success'); 
    }

    public function getEdit($id){
    	$keyfilter = keyfilter::find($id);
    	return view('admin/keyfilter/edit',['keyfilter'=>$keyfilter]);
    }

    public function postEdit(Request $request, $id){
    	$keyfilter = keyfilter::find($id);	
    	$this->validate($request,[
    		'name'=>'required|min:3',
    		'description'=>'required|min:3',
    		'status'=>'required'
    		]);
    	
    	$keyfilter->name = $request->name;
    	$keyfilter->description = $request->description;
    	$keyfilter->status = $request->status;
    	$keyfilter->save();

    	return redirect('admin/keyfilter/edit/'.$id)->with('notify','Edit Keyfilter Success');
    }

    public function getDelete($id){
    	$keyfilter = keyfilter::find($id);
    	$keyfilter->delete();

    	return redirect('admin/keyfilter/add')->with('notify','Delete Keyfilter Success');
    }

    public function searchkeyfilter(Request $request) {
        // name, description
        $key      = $request->key;
        $keyfilter = keyfilter::where('name', 'LIKE', '%'.$key.'%')
        ->orwhere('description', 'LIKE', '%'.$key.'%')->paginate(10);

        return view('admin/keyfilter/search', ['keyfilter' => $keyfilter, 'key' => $key]);
    }
}
