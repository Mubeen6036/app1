<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
use Hash;
class AdminController extends Controller
{
     
    use AuthenticatesUsers;
 
    public function __construct() { 
            $this->middleware('admin')->except('logout');
    }
	 
      public function index()  {
        $admin = User::find(Auth::user()->id);
        return view('admin.profile.profile' , compact('admin'));
    }

    public function adminpassword() {
        $admin = User::find(Auth::user()->id);
        return view('admin.profile.password' , compact('admin'));
    }

    
    public function update_admin(Request $request){
		$id = $request->id;
        $user = User::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('photo')){
			if (file_exists(public_path('uploads/admin/'.$user->photo)))  {
				@unlink('public/uploads/admin/'.$user->photo);
			 }
            $photo = date('mdYHis') . uniqid() . $request->file('photo')->getClientOriginalName();
            $file->move('public/uploads/admin',$photo);
            $input['photo'] = $photo;
        }
        $user->update($input);
        return redirect()->back()->with('message', 'Profile Updated Successfully');   
    }

    public function changepass(Request $request){
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
