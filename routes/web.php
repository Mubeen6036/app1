<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/  
   /* Cache Clear Start*/
		Route::get('/cache', function(){
			Artisan::call('cache:clear');
			Artisan::call('config:clear');
			Artisan::call('route:clear');
			Artisan::call('view:clear');
			 return redirect('/');
		});
	/* Cache Clear End*/  
	Route::get('/','Admin\LoginController@index'); 
	Route::post('login','Admin\LoginController@admin_login')->name('admin_login');
	Route::post('logout','Admin\LoginController@logout')->name('logout');
  
	/* Admin Route Start*/
	Route::group(['middleware' => 'auth', 'admin'], function(){
		
		Route::group(['namespace'=>'Admin'], function(){

			 Route::get('dashboard','HomeController@index')->name('admin_dashboard');
			 
			  /* Free  Admin  Profile Start*/
			 Route::get('adminprofile','AdminController@index');
			 Route::get('adminpassword','AdminController@adminpassword');
			 Route::post('update','AdminController@update_admin')->name('update_admin');
			 Route::post('changepass','AdminController@changepass')->name('changepass');
			  /* Free  Admin  Profile End */
			 /* Free  Admin  subscription Start*/
			 Route::get('brand','HomeController@index');
			 Route::get('brand/create','HomeController@brand_create');
			 Route::post('brand/store','HomeController@brand_store');
			 Route::get('remove_row','HomeController@remove_row')->name('remove_row');
			 
			 /* Free  Admin  subscription End */

			 Route::get('models','HomeController@model_list');
			 Route::get('models/create','HomeController@model_create');
			 Route::post('model/store','HomeController@model_store');

			 Route::get('parts','HomeController@parts');
			 Route::get('parts/create','HomeController@part_create');
			 Route::get('get_models','HomeController@get_models')->name('get_models');
			 Route::post('parts/store','HomeController@parts_store');
		});
	});
	
