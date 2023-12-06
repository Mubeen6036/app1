<?php 


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DB; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Helpers\Common;
use Session;
 
class LoginController extends Controller
{  
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }
     
     public function signup() { 
		  return view('signup'); 
     }
      public function email_verify() { 
		  return view('email_verify'); 
     }


	
	 public function userlogin(Request $request){
		  // Attempt to log the user in
		    if (Auth::attempt(['email' => $request->email,'password' => $request->password, 'user_type' => 'doctor'])) {
		           if(Auth::guard('web')->user()->status == 'closed'){
		              Auth::guard('web')->logout();
		                $response[] = array("status" => 'false',"message" => "Your Account Has Been Banned."); 
		           }
		           if(Auth::guard('web')->user()->email_verify == 'no'){
		              Auth::guard('web')->logout();
		                $response[] = array("status" => 'false',"message" => "email is not verified, please verify your account"); 
		           }
				   $userAuth =  Auth::guard('web')->user();
				   $user = array();
				   $user['user'] = Auth::guard('web')->user();
				   $response[] = array("status" => 'true',"message" => "Login Successfully"); 
		       } else{
		           $response[] = array("status" => 'false',"message" => "Credentials Doesn\'t Match !");
			   }
			  echo json_encode($response);
	 }
    
	 
	  
	  public function usersignup(Request $request){ 
	        $users = User::where('email', $request->email)->get();
			# check if email is more than 1
			if(sizeof($users) > 0){
				$response[] = array("status" => 'false',"message" => "Email already exist.try again!!");
			} else {
                //--- Validation Section Ends
                $account_token = base64_encode($request['email']);
				$user = new User;
				$input['name'] = $request->name;
				$input['email'] = $request->email;
				$input['user_type'] = $request->user_type;
				$input['login_type'] = $request->login_type;
				$input['email_verify'] = 'no';
				$input['status'] = 'active'; 
				$input['password'] = bcrypt($request['password']); 
				$input['account_token'] =  $account_token; 
				$save = $user->fill($input)->save();
				if($save){
						$name = $request->name;
						$email = $request->email;
						$token =  $account_token;  
						$link = url('verify_account/').'/'.$token;
					    $common = new Common;
					    $common->verify_account($name,$email,$link);
                      $response[] = array("status" => 'true',"message" => "Please check your email, we have sent confirmation request");
				} else{
                      $response[] = array("status" => 'false',"message" => "error while signup new account!!");
				}
			    
			   }
		echo json_encode($response);
    } 
 
     
    public function verify_account($id){
	         if (DB::table('users')->where('account_token','=',$id)->exists()) {
	         	    DB::table('users')->where('account_token','=',$id)->update(['email_verified_at'=>date('Y-m-d H:i:s'),'email_verify'=>'yes']);
		            $data['success'] = 'true';
		            $data['title'] = 'Email verification completed.';
		            $data['message'] = 'congratulations ,your account has been activated.';
		            $data['image'] = url('public/uploads/email-success.png');
	        }else{
		            $data['success'] = 'false';
		            $data['title'] = 'Sorry!!! Account verification fail.';
		            $data['message'] = 'Please check your email for verify account!!!, ';
		            $data['image'] = url('public/uploads/email-error.png');
	        }
	      return view('email_verify',$data);
	 } 



 

		 public function logout() {
				\Auth::logout();
				return redirect()->route('index');
	    }
	    
          // send mail for foreget password
	     public function forgotpassword(Request $request){
	            $user = User::where('email',$request->email)->first();
                 if(empty($user)){
					   $response[] = array("status" => 'false',"message" => "Email not exist !!!"); 
			     } else if ($user->status == 'closed'){
		                $response[] = array("status" => 'false',"message" => "Your account has been banned"); 
		         } else if($user->email_verify == 'no'){
		                $response[] = array("status" => 'false',"message" => "Email is not verified, please verify your account"); 
		         } else {
		         $email = $request->email;  
		         $link = url('reset-password/').'/'.$user->account_token;
				 $common = new Common;
				 $common->forgot_pass($email,$link);
				 $response[] = array("status" => 'true',"message" =>  'Check your mail '.$email.'  for reset password!!'); 
	          } 

			  echo json_encode($response);
		 } 




	  public function reset_password($id){
	         if (DB::table('users')->where('account_token','=',$id)->exists()) {
	         	    $user = DB::table('users')->where('account_token','=',$id)->first();  
		            $data['success'] = 'true';
		            $data['email'] = $user->email;
		            $data['id'] =  $user->id;
	        }else{
		            $data['success'] = 'false';
		            $data['title'] = 'Sorry!!! Account not exist.';
		            $data['message'] = 'Please check your account !!!';
		            $data['image'] = url('public/uploads/email-error.png');
	        }
	      return view('reset_password',$data);
	  } 


	  	//Reset password  
	 public function resetpassword(Request $request){
	        $user = User::findOrFail($request->id);
			if(empty($user)){
					 return redirect()->back()->with('warning', 'Record is not matched');  
		    } 
	        $input['password'] = "";
	        if ($request->newpass){
	                if ($request->newpass == $request->renewpass){
	                    $input['password'] = Hash::make($request->newpass);
	                }else{
	                     return redirect()->back()->with('warning', 'Confirm Password Does not match');  
	                }
	         } 
	       $update = $user->update($input);
		   if($update){
			   return redirect()->back()->with('success', 'Password Updated Successfully');
		   } else{
			   return redirect()->back()->with('warning', 'Password Reset Request failed!!');
		   }
	         
	         
	    }


 
}

?>