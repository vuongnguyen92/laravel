<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\topic;
use App\catagory;
use App\tag;
use App\log;
use App\User;
use App\comment;

class TopicController extends Controller
{
    //
    public function getList(){
    	$topic = topic::paginate(10);
        $log = log::all();
        
    	return view('admin/topic/list',['topic'=>$topic,'log'=>$log]);
    } 

    public function getListauthor(){
        $topic = topic::where('idUser',Auth::user()->id)->paginate(10);
        $log = log::all();
        
        return view('admin/topic/listauthor',['topic'=>$topic,'log'=>$log]);
    }

    public function getListmoderate(){
        $topic = topic::where('approvedby',Auth::user()->name)->paginate(10);
        $log = log::all();
        
        return view('admin/topic/listauthor',['topic'=>$topic,'log'=>$log]);
    }

    public function getAdd(){
        $topic = topic::find(1);
    	$category = catagory::all();
    	$tag = tag::all();

    	return view('admin/topic/add',['category'=>$category,'tag'=>$tag]);
    }
    public function postAdd(Request $request){
    	$this->validate($request,[
    		'tittle'=>'required|min:3',
    		'shortdescription'=>'required|min:3',
    		'content'=>'required|min:3',
    		'status'=>'required',
            'tag'=>'required'
    		]);

    	$topic = new topic;
    	$topic->tittle = $request->tittle;
    	$topic->shortdescription = $request->shortdescription;
    	$topic->content = $request->content;
    	$topic->idCatagory = $request->category;
        $topic->idUser = Auth::user()->id;

        if(Auth::user()->level == 0 || Auth::user()->level == 1){
            $topic->approvestatus = $request->approvestatus;
            $topic->approvedby = $request->approvedby;          
        }
        else $topic->approvestatus  = 2;  	
        $topic->status = $request->status;

    	if($request->hasFile('image')){   
    		$file = $request->file('image');	
    		$duoi = $file->getClientOriginalExtension();
    		if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
    		{
    			return redirect('admin/topic/add')->with('notify','You need up ... jpg,png,jpeg');
    		}
    		$name = $file->getClientOriginalName();
    		$image = str_random(4)."_".$name;
    		while(file_exists("upload/tintuc".$image))
    		{
    			$image = str_random(4)."_".$name;
    		}
    		$file->move("upload/tintuc",$image);
    		$topic->image = $image;
    	}
    	else{
    		$topic->image="";
    	}

    	$topic->save();
        $topic->find($topic->id)->tag()->attach($request->tag);

    	return redirect('admin/topic/add')->with('notify','Add Topic Success'); 
    }

    public function getEdit($id){
    	$topic = topic::find($id);
    	$category = catagory::all();
    	$tag = tag::all();
        $user = User::find($id);

    	return view('admin/topic/edit',['topic'=>$topic,'category'=>$category,'tag'=>$tag,'user'=>$user ]);
    }

    public function postEdit(Request $request,$id){
    	$topic = topic::find($id);
    	$log = log ::all();
    	$this->validate($request,[
    		'tittle'=>'required|min:3',
    		'shortdescription'=>'required|min:3',
    		'content'=>'required|min:3'
    		]);
        $status = $topic->approvestatus;

    	$topic->tittle = $request->tittle;
    	$topic->shortdescription = $request->shortdescription;
    	$topic->content = $request->content;
    	$topic->idCatagory = $request->category;
    	$topic->approvestatus = $request->approvestatus;
        if(Auth::user()->level == 0 || Auth::user()->level == 1){
                    $topic->approvestatus = $request->approvestatus;
                    $topic->approvedby = $request->approvedby;          
                } 

                
    	if( $request->approvestatus !== $status)
            {
                $log  = new log;
                $log->idTopic = $topic->id;
                $log->logApprovestatus = $request->approvestatus;
                $log->logApprovedby = Auth::user()->name;
                $topic->timeapproved = $log->created_at;
            }
            $log->save();

    	if($request->hasFile('image')){   
    		$file = $request->file('image');	
    		$duoi = $file->getClientOriginalExtension();
    		if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
    		{
    			return redirect('admin/topic/edit')->with('notify','You need up ... jpg,png,jpeg');
    		}
    		$name = $file->getClientOriginalName();
    		$image = str_random(4)."_".$name;
    		while(file_exists("upload/tintuc".$image))
    		{
    			$image = str_random(4)."_".$name;
    		}
    		$file->move("upload/tintuc",$image);
    		$topic->image = $image;
    	}
    	else{
    		$topic->image="";
    	}
    	$topic->save();
        $topic->find($topic->id)->tag()->sync($request->tag);

    	return redirect('admin/topic/edit/'.$id)->with('notify','Edit Topic Success'); 
    }

    public function getDelete($id){
    	$topic = topic::find($id);
        $log = log::all();
        $comment = comment::all();
        foreach ($topic->log as $lg) {
            $log = log::where('id',$lg->id)->delete();
        }

        foreach ($topic->comment as $cmt) {
            $comment = comment::where('id',$cmt->id)->delete();
        }

    	$topic->delete();

    	return redirect('admin/topic/list')->with('notify','Delete Topic Success');
    }

    public function searchtopic(Request $request){
        // title, content, short description
        $key = $request->key;
        $topic = topic::whereRaw("MATCH(tittle,shortdescription,content) AGAINST(?)", array($key))->paginate(10);
        return view('admin/topic/search',['topic'=>$topic,'key'=>$key]); 

    }
}
