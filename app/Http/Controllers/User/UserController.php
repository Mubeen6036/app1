<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
use Hash;
class UserController extends Controller
{
     
    use AuthenticatesUsers;
 
   public function __construct() {
            $this->middleware('user')->except('logout');
    } 
	 
   public function index()  {
        $user = User::find(Auth::user()->id);
        return view('user.profile.profile' , compact('user'));
   }
	 

    public function userpassword() {
        $user = User::find(Auth::user()->id);
        return view('user.profile.password' , compact('user'));
    }

    
    public function update_user(Request $request){
		$id = $request->id;
        $user = User::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('photo')){
            $photo = date('mdYHis') . uniqid() . $request->file('photo')->getClientOriginalName();
            $file->move('public/uploads/user',$photo);
            $input['photo'] = $photo;
			if($user->photo){
				if($user->photo != 'user.png') {
					 @unlink('public/uploads/user/'.$user->photo);
				}  
            }
        }
        $user->update($input);
        return redirect()->back()->with('message', 'Profile Updated Successfully');   
    }

    public function userchangepass(Request $request){
        $user = User::findOrFail($request->id);
        $input['password'] = "";
        if ($request->cpass){
            if (Hash::check($request->cpass, $user->password)){

                if ($request->newpass == $request->renewpass){
                    $input['password'] = Hash::make($request->newpass);
                }else{
                     return redirect()->back()->with('error', 'Confirm Password Does not match');  
                }
            }else{
                return redirect()->back()->with('error', 'Current Password Does not match');  ;
            }
        }
        $user->update($input);
       return redirect()->back()->with('message', 'Password Updated Successfully');  
    }
	
	
	
	
}
