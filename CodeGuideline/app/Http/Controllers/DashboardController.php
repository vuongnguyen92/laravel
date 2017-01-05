<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\topic;
use App\catagory;
use App\user;
use App\comment;

class DashboardController extends Controller
{
    //
    public function getList(){
    	$topic = topic::all();
    	$category = catagory::all();
    	$user = user::all();
    	$comment = comment::all();
    	$topic1 = topic::where('approvestatus',1)->orderBy('created_at','desc')->take(10)->get();
        $topic2 = topic::where('idUser',Auth::user()->id)->orderBy('created_at','desc')->take(10)->get();
        $topic3 = topic::where('approvestatus',2)->orderBy('created_at','desc')->take(10)->get();
    	$topicv = topic::where('approvestatus',1)->orderBy('viewed','desc')->take(1)->get();
    	$topiccmt = topic::where('approvestatus',1)->orderBy('cmt_count','desc')->take(1)->get();
        $topic_rating = topic::where('approvestatus',1)->orderBy('vote_count','desc')->take(1)->get();
        $topic_rating1 = topic::where('idUser',Auth::user()->id)->orderBy('vote_count','desc')->take(1)->get();
        $topicv1 = topic::where('idUser',Auth::user()->id)->orderBy('viewed','desc')->take(1)->get();
        $topiccmt1 = topic::where('idUser',Auth::user()->id)->orderBy('cmt_count','desc')->take(1)->get();

    	return view('admin/dashboard/dashboard',['topic'=>$topic,'category'=>$category,'user'=>$user,'comment'=>$comment,'topic1'=>$topic1,'topicv'=>$topicv,'topiccmt'=>$topiccmt,'topic_rating'=>$topic_rating,'topic2'=>$topic2,'topic_rating1'=>$topic_rating1,'topicv1'=>$topicv1,'topiccmt1'=>$topiccmt1,'topic3'=>$topic3]);
    }
}
