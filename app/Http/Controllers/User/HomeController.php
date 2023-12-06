<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
use Hash;
class HomeController extends Controller {
  
    use AuthenticatesUsers;
 
   public function __construct() {
            $this->middleware('user')->except('logout');
    } 
   
	//show admin page
	public function index(){
         $data['data'] =  "";
         echo 1;
         die();
          return view('user.dashboard',$data);
	}	
	 
   
	
 
   
}
