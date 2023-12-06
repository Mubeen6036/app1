<?php
 namespace AppModels;
 use IlluminateFoundationAuthUser as Authenticatable;
 class Admins extends Authenticatable
 {
 protected $guard = 'admin';
 /**
 * The attributes that are mass assignable.
 *
 * @var array
 */
 protected $fillable = [
 'firstname', 'midname', 'lastname', 'email', 'address', 'password',
 ];
 /**
 * The attributes that should be hidden for arrays.
 *
 * @var array
 */
 protected $hidden = [
 'password', 'remember_token',
 ];
 }