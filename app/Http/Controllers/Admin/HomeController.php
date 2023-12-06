<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;
use Hash;
use File;
use App\Helpers\Common;
use App\User;
class HomeController extends Controller {
  
    public function __construct() {
             $this->middleware('admin')->except('logout');
	}
	//show admin page
	public function index(){
		$data['brand'] = DB::table('app_brands')->paginate(20);
        return view('admin.brand.list',$data);
	}

	public function brand_create(){
		return view('admin.brand.add');
	}

	public function brand_store(Request $request){
		$insert = DB::table('app_brands')->insert(['name'=>$request->name]);
		if ($insert) {
			return redirect()->back()->with('message','New Brand Created.');
		}else{
			return redirect()->back()->with('error','Something went wrong. Please try after some time.');
		}
	}

	public function remove_row(Request $request){
		DB::table($request->table)->where('id',$request->id)->delete();
		echo 1;
	}

	// model

	public function model_list(){
		$data['model'] = DB::table('app_model')->select('id','brand_name','model_name','created_at')->paginate(20);
        return view('admin.model.list',$data);
	}

	public function model_create(){
		$data['brands'] = DB::table('app_brands')->get();
		return view('admin.model.add',$data);
	}

	public function model_store(Request $request){
		$brand_arr = explode('~', $request->brand);
		$insert= DB::table('app_model')->insert(['brand_id'=>$brand_arr[0],'brand_name'=>$brand_arr[1],'model_name'=>$request->name]);
		if ($insert) {
			return redirect()->back()->with('message','New model Created in '.$brand_arr[1]);
		}else{
			return redirect()->back()->with('error','Something went wrong. Please try after some time.');
		}
	}

	//parts

	public function parts(){
		$data['parts'] = DB::table('app_parts')->select('id','brand_name','model_name','name','manufacture_date','created_at')->paginate(20);
        return view('admin.parts.list',$data);
	}

	public function part_create(){
		$data['brands'] = DB::table('app_brands')->get();
		return view('admin.parts.add',$data);
	}

	public function get_models(Request $request){
		$brand = explode('~',$request->value);
		$model = DB::table('app_model')->where('brand_id',$brand[0])->get();
		$html='';
		$html.='<option value="">Select</option>';
		if (!$model->isEmpty()) {
			foreach ($model as $key) {
				$html.='<option value="'.$key->id.'~'.$key->model_name.'">'.$key->model_name.'</option>';
			}
		}
		echo $html;
	}

	public function parts_store(Request $request){
		$brand = explode('~',$request->brand);
		$model = explode('~',$request->model);
		$insert= DB::table('app_parts')->insert(['brand_id'=>$brand[0],'brand_name'=>$brand[1],'model_id'=>$model[0],'model_name'=>$model[1],'name'=>$request->name,'manufacture_date'=>$request->manufacture_date]);
		if ($insert) {
			return redirect()->back()->with('message','New part added.');
		}else{
			return redirect()->back()->with('error','Something went wrong. Please try after some time.');
		}
	}
}
