<?php

namespace App;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [ 'name', 'first_name', 'last_name', 'email', 'password', 'user_type','login_type','status', 'phone', 'photo','street', 'address', 'city', 'state', 'zip', 'country' ,'subscription','account_token','description','facebook','twitter','youtube','google','instagram','pinterest','specialist','institution'];

 
    protected $hidden = [ 'password', 'remember_token' ];
 
    protected $casts = ['email_verified_at' => 'datetime','email_verify'];
	
	  public function isAdmin() {
       return $this->user_type === 'admin';
    }
    public function isUser() {
       return $this->user_type === 'user';
    }
    
	
}
