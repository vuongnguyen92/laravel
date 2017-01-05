<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\comment;

class UserController extends Controller
{
    //
	public function getListadmin(){
		$user = User::where('level',0)->get();
		return view('admin/user/admin',['user'=>$user]);
	}

	public function getListmoderate(){
		$user = User::where('level',1)->get();
		return view('admin/user/moderate',['user'=>$user]);
	}

	public function getListauthor(){
		$user = User::where('level',2)->get();
		return view('admin/user/author',['user'=>$user]);
	}

    public function getListuser(){
        $user = User::where('level',3)->get();
        return view('admin/user/user',['user'=>$user]);
    }

    public function getAdd(){
    	return view('admin.user.add');
    }

    public function postAdd(Request $request){
    	$this->validate($request,[
    		'name'=>'required|min:3',
    		'email'=>'required|email|unique:users,email',
    		'password'=>'required|min:3|max:32',
    		'passwordAgain'=>'required|same:password'
    		]);
    	$user = new User;
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);
    	$user->level = $request->level;
    	$user->save();

    	return redirect('admin/user/add')->with('notify','Register Success'); 
    }

    public function getEdit($id){
    	$user = User::find($id);

    	if((Auth::user()->level != 0 && (Auth::user()->id != $id)) ||($user->level == 0 && (Auth::user()->id != $id))){
    		return redirect('admin/user/list/admin')->with('notify','Cant Edit');
    	}
    	return view('admin/user/edit',['user'=>$user]);
    }

    public function postEdit(Request $request, $id){
    	$this->validate($request,[
    		'name'=>'required|min:3',
    		]);
    	$user = User::find($id);
    	$user->name = $request->name;
    	$user->level = $request->level;

    	if($request->changePassword == "on"){
    		$this->validate($request,[
    		'password'=>'required|min:3|max:32',
    		'passwordAgain'=>'required|same:password'
    		]);
  	    	$user->password = bcrypt($request->password);
    	}
    	$user->save();

    	return redirect('admin/user/edit/'.$id)->with('notify','Edit Success');
    }

    public function getDelete($id){
    	$user = User::find($id);

    	if(Auth::user()->level != 0 ||($user->level == 0 && (Auth::user()->id != $id))){
    		return redirect('admin/user/list/admin')->with('notify','Cant Delete');
    	}
        foreach ($user->comment as $cmt) {
            $comment = comment::where('id',$cmt->id)->delete();
        }

    	$user->delete();
        if($user->level == 1){
            $user = User::where('level',1)->get();
           return view('admin/user/moderate',['user'=>$user])->with('notify','Delete Success');
        }
        elseif($user->level == 2){
            $user = User::where('level',2)->get();
           return view('admin/user/author',['user'=>$user])->with('notify','Delete Success');
        }
        elseif($user->level == 3){
            $user = User::where('level',3)->get();
           return view('admin/user/user',['user'=>$user])->with('notify','Delete Success');
        }
            
    }   

    public function getLogin(){
    	return view('admin/login');
    }

    public function postLogin(Request $request){
    	$this->validate($request,[
    		'email'=>'required|min:3',
    		'password'=>'required|min:3|max:32'
    		]);
    	if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]) && Auth::user()->level != 3){
    		return redirect('admin/dashboard/list')->with('notify','Logged In Successfully');
    	}
    	else{
    		return redirect('admin/login')->with('notify','Fail Login ! Please try again');
    	}
    }

    public function getLogout(){
    	Auth::logout();
    	return redirect('admin/login');
    }
}
