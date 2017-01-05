<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\catagory;
use App\topic;
use App\tag;
use App\keyfilter;
use App\User;	
use Session;
use DB;


class PagesController extends Controller
{
	public function homepages(){
		$category = catagory::all();
    	$topic = topic::all();

    	return view('pages/homepage',['category'=>$category,'topic'=>$topic]);	

}
    public function lienhe(){
    	return view('pages/lienhe');
    }

    public function category($id){
    	$category = catagory::all();
    	$category1 = catagory::find($id);
    	$topic = topic::where('idCatagory',$id)->paginate(5);

    	return view('pages/category',['category1'=>$category1,'topic'=>$topic,'category'=>$category]);
    }

    public function tag($id){
        $topic = topic::all();
        $tag = tag::find($id);
        
        return view('pages/tag',['tag'=>$tag,'topic'=>$topic]);
    }

    public function topic($id){
    	$topic = topic::find($id);
    	$comment = topic::all();
        $tag = tag::all();
    	$keyfilter = keyfilter::all();
        $blogKey = 'topic_' . $id;
        if (!Session::has($blogKey)) {
            topic::where('id', $id)->increment('viewed');
            Session::put($blogKey, 1);
        }
        $ar = array();
        $ar1 = array();

    	foreach ($keyfilter as $key) {  
            $array[] = $key->name; 
        }

    	$topic1 = topic::where('approvestatus',1)->orderBy('viewed','desc')->take(4)->get();
        $topic2 = topic::where('approvestatus',1)->orderBy('vote_count','desc')->take(4)->get();
    	$topic3 = topic::where('idCatagory',$topic->idCatagory)->take(10)->get(); //Tin liên quan cùng category

        /*--
            -topic cùng tag tuyệt đối
            1.lấy các id tag của topic ra thành 1 list tag
            2. lấy tất cả list tag của các topic ra
            3. so sánh với list tag của list tag (1)
        --*/
        foreach ($topic->tag as $tg) {
            $ar[] = $tg->id;            
        }
        $tmp = array();
        $topic4 = topic::all();
        foreach ($topic4 as $tp) {
            foreach ($tp->tag as $tg) {
                $tmp[]  = $tg->pivot->tag_id;
                }
                $ar1[$tp->id] = $tmp;
                $tmp = array();
            }
        foreach ($ar1 as $key => $value) {
            if($ar == $value)
                $ar2[] = $key;
        }
        $topic4 = topic::whereIn('id',$ar2)->take(10)->get();

    	return view('pages/topic',['topic'=>$topic,'array'=>$array,'topic1'=>$topic1,'topic2'=>$topic2,'topic3'=>$topic3,'topic4'=>$topic4,'tag'=>$tag]);
        
    }

    public function getLogin(){
    	return view('pages/login');
    }

    public function postLogin(Request $request){
    	$this->validate($request,[
    		'email'=>'required|min:3',
    		'password'=>'required|min:3|max:32'
    		]);

    	if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
    		return redirect('homepages')->with('notify','Logged In Successfully');
    	}
    	else{
    		return redirect('login')->with('notify','Fail Login ! Please try again');
    	}
    }

    public function getLogout(){
    	Auth::logout();
        Session()->flush();
		return redirect('homepages');
    }

    public function getAccount(){
    	$user = Auth::user();
    	return view('pages/account',['user'=>$user]);
    }

    public function postAccount(Request $request){
    	$this->validate($request, [
				'name' => 'required|min:3',
			]);
		$user        = Auth::user();
		$user->name  = $request->name;
		$user->level = 3;

		if ($request->changePassword == "on") {
			$this->validate($request, [
					'password'      => 'required|min:3|max:32',
					'passwordAgain' => 'required|same:password'
				]);
			$user->password = bcrypt($request->password);
		}
		$user->save();

		return redirect('account')->with('notify', 'Edit Success');
    }

    public function getRegister(){
    	return view('pages/register');
    }

    public function postRegister(Request $request){
    	$this->validate($request, [
				'name'          => 'required|min:3',
				'email'         => 'required|email|unique:users,email',
				'password'      => 'required|min:3|max:32',
				'passwordAgain' => 'required|same:password'
			]);
		$user           = new User;
		$user->name     = $request->name;
		$user->email    = $request->email;
		$user->password = bcrypt($request->password);
		$user->level    = 3;
		$user->save();

		return redirect('login')->with('notify', 'Have Successfully Registered. Please login');
    }
}
