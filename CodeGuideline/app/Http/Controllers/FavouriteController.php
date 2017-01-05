<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\favourite;
use App\topic;

class FavouriteController extends Controller
{
    //

    public function getList(){
    	$favourite = favourite::where('idUser',Auth::user()->id)->paginate(10);
    	return view('pages/favourite',['favourite'=>$favourite]);
    }

    public function postFavourite($id,Request $request){
        $topic = topic::find($id);
        $idTopic = $id;
        $favourite = new favourite;
        $favourite->idUser = Auth::user()->id;
        $favourite->idTopic = $id;
        $favourite->name = $request->fname;

        $favourite->save();

        return redirect("topic/$id")->with('notify','Add to my favourite Success');
    }

    public function getDelete($id){
   	$favourite = favourite::find($id);
    $favourite->delete();
    $favourite = favourite::paginate(10);	

    	return view('pages/favourite',['favourite'=>$favourite])->with('notify','Delete Tag Success');
    }
}
