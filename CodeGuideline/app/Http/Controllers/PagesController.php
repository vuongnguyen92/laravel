<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\catagory;
use App\topic;
use App\tag;
use App\keyfilter;
use App\User;	


class PagesController extends Controller
{
	public function homepages(){
		$category = catagory::all();
    	$topic = topic::all();
   //  	foreach ($category as $ctg) {	   

			// $data = $ctg->topic->where('approvestatus',1)->sortbydesc('created_at')->take(4);
			// // foreach ($data as $dt) {
			// // echo $dt->tittle."<br>";
			// $new1 = $data->shift();
			// echo $new1->tittle."<br>";
   //  		}
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

    public function topic($id){
    	$topic = topic::find($id);
    	$comment = topic::all();
    	$keyfilter = keyfilter::all();
        $topic->viewed = $topic->viewed +1 ;
        $topic->save();

    	foreach ($keyfilter as $key) {  
            $array[] = $key->name; 
        }

    	$topic1 = topic::where('approvestatus',1)->orderBy('viewed','desc')->take(4)->get();
        $topic2 = topic::where('approvestatus',1)->orderBy('vote_count','desc')->take(4)->get();
    	// $topic2 = topic::where('idCatagory',$topic->idCatagory)->take(4)->get(); //Tin liên quan

    	return view('pages/topic',['topic'=>$topic,'array'=>$array,'topic1'=>$topic1,'topic2'=>$topic2]);
        
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
