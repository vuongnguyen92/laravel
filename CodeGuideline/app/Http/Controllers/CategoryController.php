<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\catagory;

class CategoryController extends Controller
{
    //
    public function getList(){
    	$category = catagory::paginate(10);
    	return view('admin/category/list',['category'=>$category]);
    }

    public function getAdd(){
    	return view('admin/category/add');
    }

    public function postAdd(Request $request){
    	$this->validate($request,[
    		'name'=>'required|min:3',
    		'description'=>'required|min:3',
    		'status'=>'required'
    		]);
    	$category = new catagory;
    	$category->name = $request->name;
    	$category->description = $request->description;
    	$category->status = $request->status;
    	$category->save();

    	return redirect('admin/category/add')->with('notify','Add Category Success'); 
    }

    public function getEdit($id){
    	$category = catagory::find($id);
    	return view('admin/category/edit',['category'=>$category]);
    }

    public function postEdit(Request $request, $id){
    	$category = catagory::find($id);	
    	$this->validate($request,[
    		'name'=>'required|min:3',
    		'description'=>'required|min:3',
    		'status'=>'required'
    		]);
    	
    	$category->name = $request->name;
    	$category->description = $request->description;
    	$category->status = $request->status;
    	$category->save();

    	return redirect('admin/category/edit/'.$id)->with('notify','Edit Category Success');
    }

    public function getDelete($id){
    	$category = catagory::find($id);
    	$category->delete();	

    	return view('admin/category/add')->with('notify','Delete Category Success');
    }

    public function searchcategory(Request $request){
        // name, description
        $key = $request->key;
        $category = catagory::where('name','LIKE','%' . $key . '%')
        ->orwhere('description','LIKE','%' . $key . '%')->paginate(10);

        return view('admin/category/search',['category'=>$category,'key'=>$key]); 
    }
}
