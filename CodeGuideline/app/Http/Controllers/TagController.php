<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tag;
use App\topic;

class TagController extends Controller
{
    //
    public function getList(){
    	$tag = tag::paginate(10);
    	return view('admin/tag/list',['tag'=>$tag]);
    }

    public function getAdd(){
    	return view('admin/tag/add');
    }

    public function postAdd(Request $request){
    	$this->validate($request,[
    		'name'=>'required|min:3',
    		'description'=>'required|min:3',
    		'status'=>'required'
    		]);
    	$tag = new tag;
    	$tag->name = $request->name;
    	$tag->description = $request->description;
    	$tag->status = $request->status;
    	$tag->save();

    	return redirect('admin/tag/add')->with('notify','Add Tag Success'); 
    }

    public function getEdit($id){
    	$tag = tag::find($id);
    	return view('admin/tag/edit',['tag'=>$tag]);
    }

    public function postEdit(Request $request, $id){
    	$tag = tag::find($id);	
    	$this->validate($request,[
    		'name'=>'required|min:3',
    		'description'=>'required|min:3',
    		'status'=>'required'
    		]);
    	
    	$tag->name = $request->name;
    	$tag->description = $request->description;
    	$tag->status = $request->status;
    	$tag->save();

    	return redirect('admin/tag/edit/'.$id)->with('notify','Edit Tag Success');
    }

    public function getDelete($id){
    	$tag = tag::find($id);
        $tag->delete();
        $tag = tag::paginate(10);

    	return view('admin/tag/list',['tag'=>$tag])->with('notify','Delete Tag Success');
}    
    public function searchtag(Request $request){
        // name, description
        $key = $request->key;
        $tag = tag::whereRaw("MATCH(name,description) AGAINST(?)", array($key))->get();

        return view('admin/tag/search',['tag'=>$tag,'key'=>$key]); 
    }
}
