<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\comment;
use App\keyfilter;
use App\topic;

use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    public function getDelete($id,$idTopic){
    	$comment = comment::find($id);
        $topic = topic::find($idTopic);
    	$comment->delete();
        $topic->cmt_count= $topic->cmt_count - 1;

         $topic->save();
    	return redirect('admin/topic/edit/'.$idTopic)->with('notify','Delete Comment Success');
    }

    public function getComment(){
    	$comment = comment::all();
    	$keyfilter = keyfilter::get(['name']);

        foreach ($keyfilter as $key) {  
            $array[] = $key->name; 
        }

    	return view('admin/comment/comment',['comment'=>$comment,'array'=>$array]);
	}

    public function postComment($id,Request $request){
        $topic = topic::find($id);
        $idTopic = $id;
        $comment = new comment;
        $comment->idTopic = $idTopic;
        $comment->idUser = Auth::user()->id;
        $comment->content = $request->content;
        if($request->vote != 0){
            $comment->vote = $request->vote;
            $topic->vote_count = $topic->vote_count + $request->vote;
        }
        $topic->cmt_count = $topic->cmt_count + 1;

        $comment->save();
        $topic->save();

        return redirect("topic/$id")->with('notify','Add Comment Success');
    }
}
