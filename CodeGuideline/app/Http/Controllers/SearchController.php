<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\catagory;
use App\topic;
use App\tag;

class SearchController extends Controller
{
    //
	public function search(Request $request){
		$key = $request->key;

    $category = catagory::whereRaw("MATCH(name,description) AGAINST(?)", array($key))->where('status', 1)->get();
    $topic = topic::whereRaw("MATCH(tittle,shortdescription,content) AGAINST(?)", array($key))->where('approvestatus', 1)
    ->paginate(10);
    $tag = tag::whereRaw("MATCH(name,description) AGAINST(?)", array($key))->where('status', 1)->get();

    return view('pages/search',['topic'=>$topic ,'category'=>$category,'tag'=>$tag,'key'=>$key]);            
	}
}
  