<?php

namespace App\Helpers;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use File;
use DateTime;
use DateTimeZone;
use Mail;
use DB;

class Common{

  
   public function verify_account($name,$email,$link){
             $settings  = DB::table('settings')->where('id',1)->first();  
             $array['data']['link'] = $link;
              $array['data']['email'] = $email;
              $array['data']['name'] = $name; 
              $array['data']['sender_email'] = $settings->sender_email;; 
              $array['data']['sender_name'] = $settings->sender_name;
            Mail::send('email.verify_account', $array, function($message)use($array) {
                $message->to($array['data']['email'])->subject('Account Registration Confirmation')->from($array['data']['sender_email'],$array['data']['sender_name']);
            });
             if (Mail::failures()){
              return 0;
            }else{
               return 1;
            }
   }
    
   public function forgot_pass($email,$link){
    $settings  = DB::table('settings')->where('id',1)->first();
            $array['data']['email']=$email;
            $array['data']['link']=$link;
            $array['data']['sender_email'] = $settings->sender_email;; 
            $array['data']['sender_name'] = $settings->sender_name;
            Mail::send('email.forgotpassword', $array, function($message)use($array) {
                $message->to($array['data']['email'])
                        ->subject('Password Reset Request')->from($array['data']['sender_email'],$array['data']['sender_name']);
            });
             if (Mail::failures()){
              return 0;
            }else{ 
               return 1;
            }
   }
    


    public function send_mail($name,$email,$subject,$message){
              $settings  = DB::table('settings')->where('id',1)->first();
              $array['data']['name']=$name;
              $array['data']['email']=$email;
              $array['data']['subject']=$subject;
              $array['data']['message']=$message;
              $array['data']['sender_email'] = $settings->sender_email;; 
              $array['data']['sender_name'] = $settings->sender_name;
              Mail::send('email.send_mail', $array, function($message)use($array) {
                  $message->to($array['data']['email'])
                          ->subject($array['data']['subject'])->from($array['data']['sender_email'],$array['data']['sender_name']);
              });
               if (Mail::failures()){
                return 0;
              }else{ 
                 return 1;
              }
     }
	 
       // on Complete order send message to user
    public function send_mail_multiple($name,$email,$subject,$messages){
      $settings  = DB::table('settings')->where('id',1)->first();  
      $array['data']['name'] = $name;
      $array['data']['email'] = $email;
      $array['data']['subject'] = $subject;
      $array['data']['messages'] = $messages;
      $array['data']['sender_email'] = $settings->sender_email; 
      $array['data']['sender_name'] = $settings->sender_name;
            Mail::send('email.send_mail_multiple', $array, function($message)use($array) {
                $message->to($array['data']['email'],$array['data']['name'])
                        ->subject($array['data']['subject'])->from($array['data']['sender_email'],$array['data']['sender_name']);
            });
             if (Mail::failures()){
              return 0;
            }else{
               return 1;
            }
     }
 
 
}
