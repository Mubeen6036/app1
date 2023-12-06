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
class DashboardController extends Controller {
  
    public function __construct() {
             $this->middleware('admin')->except('logout');
	}
   
   
   public function test(Request $request){
      echo  $from = date("Y-m-d 00:00:00.000");
      echo  "<br>".$to = date("Y-m-d 23:59:00.000");
   	  $country  =  DB::select(DB::raw("SELECT country , COUNT(country) as total FROM counter WHERE country IS NOT NULL and `created_at` BETWEEN '".$from."' AND '".$to."' GROUP BY country ORDER by total DESC"));
     


   }
	  public function dashboard_filter(Request $request){ 

	         $from = date("Y-m-d 00:00:00.000",strtotime($request->start_date));
             $to = date("Y-m-d 23:59:00.000",strtotime($request->end_date));
	         $total  = DB::table("counter")->whereBetween('created_at', [$from, $to])->count();

	         $desktop  = DB::table("counter")->where('device','desktop')->whereBetween('created_at', [$from, $to])->count();
	         $tablet  = DB::table("counter")->where('device','tablet')->whereBetween('created_at', [$from, $to])->count();
	         $mobile  = DB::table("counter")->where('device','mobile')->whereBetween('created_at', [$from, $to])->count();
	      
             $country  =  DB::select(DB::raw("SELECT country  , COUNT(country) as total FROM counter WHERE country IS NOT NULL and   `created_at` BETWEEN '".$from."' AND '".$to."' GROUP BY country ORDER by total DESC"));
             $os  =  DB::select(DB::raw("SELECT os  , COUNT(os) as total FROM counter WHERE os IS NOT NULL and `created_at` BETWEEN '".$from."' AND '".$to."' GROUP BY os ORDER by total DESC"));
	           ?>
	           <div class="row">
                
				<div class="col-sm-3">
					<div class="card avtivity-card">
						 <div class="card-body">
							<div class="media align-items-center">
								<div class="media-body">
									<h4 class="fs-20">Total Users</h4>
									<span class="title text-black font-w600"><?php echo $total ?? '0';  ?></span>
								</div>
							</div>
							<div class="progress" style="height:5px;">
								<div class="progress-bar bg-success" style="width: 100%; height:5px;" role="progressbar">
									<span class="sr-only">100% Complete</span>
								</div>
							</div>
						</div>
						<div class="effect bg-success"></div>
					</div>
				</div>

			    <div class="col-sm-3">
					<div class="card avtivity-card">
						 <div class="card-body">
							<div class="media align-items-center">
								<div class="media-body">
									<h4 class="fs-20">Desktop Users</h4>
									<span class="title text-black font-w600"><?php echo $desktop ?? '0';  ?></span>
								</div>
							</div>
							<div class="progress" style="height:5px;">
								<div class="progress-bar bg-success" style="width: 100%; height:5px;" role="progressbar">
									<span class="sr-only">100% Complete</span>
								</div>
							</div>
						</div>
						<div class="effect bg-success"></div>
					</div>
				</div>

			   <div class="col-sm-3">
					<div class="card avtivity-card">
					 <div class="card-body">
							<div class="media align-items-center">
								<div class="media-body">
									<h4 class="fs-20">Tablet Users</h4>
									<span class="title text-black font-w600"><?php echo $tablet ?? '0';  ?></span>
								</div>
							</div>
							<div class="progress" style="height:5px;">
								<div class="progress-bar bg-success" style="width: 100%; height:5px;" role="progressbar">
									<span class="sr-only">100% Complete</span>
								</div>
							</div>
						</div>
						<div class="effect bg-success"></div>
					</div>
				</div>

				<div class="col-sm-3">
					<div class="card avtivity-card">
						<div class="card-body">
							<div class="media align-items-center">
								<div class="media-body">
									<h4 class="fs-20">Mobile Users</h4>
									<span class="title text-black font-w600"><?php echo $mobile ?? '0';  ?></span>
								</div>
							</div>
							<div class="progress" style="height:5px;">
								<div class="progress-bar bg-success" style="width: 100%; height:5px;" role="progressbar">
									<span class="sr-only">100% Complete</span>
								</div>
							</div>
						</div>
						<div class="effect bg-success"></div>
					</div>
				</div> 
			</div>

<div class="row">
			<div class="col-sm-6">
				 <div class="card">
					<div class="card-header">
						<h4 class="fs-20 mb-0">Country Wise User</h4>
					</div>
					<div class="card-body p-0 shrink-card">
							<table class="table shadow-hover table-shrink">
								<tbody> 
									<tr>
										<th>
											<p class="mb-0">Country</p>
										</th>
										<th>
											<p class="mb-0 font-w600 text-green">Total</p>
										</th>
									</tr>
                                     <?php  if($country) {  
                                         foreach ($country as $key => $value) { ?>  
									<tr>
										<td>
											<p class="mb-0"> <?php echo $value->country;  ?> </p>
										</td>
										<td>
											<p class="mb-0 font-w600 text-green"><?php echo $value->total;  ?></p>
										</td>
									</tr> 
								     <?php } }  ?> 
								</tbody>
							</table>
					</div>
				</div>
			</div>


			<div class="col-sm-6">
				 <div class="card">
					<div class="card-header">
						<h4 class="fs-20 mb-0 ">OS Wise User</h4>
					</div>
					<div class="card-body p-0 shrink-card">
							<table class="table shadow-hover table-shrink">
								<tbody> 
									<tr>
										<th>
											<p class="mb-0">Operating System </p>
										</th>
										<th>
											<p class="mb-0 font-w600 text-green">Total</p>
										</th>
									</tr>
                                     <?php  if($os) {  
                                         foreach ($os as $key => $value) { ?>  
									<tr>
										<td>
											<p class="mb-0"> <?php echo $value->os;  ?> </p>
										</td>
										<td>
											<p class="mb-0 font-w600 text-green"><?php echo $value->total;  ?></p>
										</td>
									</tr> 
								     <?php } }  ?> 
								</tbody>
							</table>
					</div>
				</div>
			</div>
</div>


		<?php 

      
    }

 
	  
	   


}
