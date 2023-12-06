@extends('admin.includes.masterpage-admin')

@section('content')
<style>
img#adminimg {
    height: 300px;
    with: 300px;
    padding: 10px;
    border: 2px solid gray;
    margin-bottom: 15px;
}
</style>
<div class="d-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Admin Profile</h1>
	<a href="{!! url('admin/dashboard') !!}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white"></i> Back</a>
</div>
<div class="clearfix"></div>
	<div id="response" class="col-md-12">
		@if(Session::has('message'))
			<div class="alert alert-success alert-dismissable">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				{{ Session::get('message') }}
			</div>
		@endif
		@if(Session::has('error'))
			<div class="alert alert-danger alert-dismissable">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				{{ Session::get('error') }}
			</div>
		@endif
	</div>
	
<form method="POST" action="{{ route('changepass') }}" action="cabstore" class="" enctype="multipart/form-data">
	{{csrf_field()}}
	 
	 <input type="hidden" name="id" value="{{$admin->id}}">
	<div class="row small-spacing">
		
		<div class="col-lg-8 col-xs-12">
		
		<div class="card shadow mb-4">
			<div class="card-header py-3"><h6 class="m-0 font-weight-bold">Current Password : </h6></div>
			<div class="card-body">
			 <input type="password" class="form-control" name="cpass" id="admin_current_password" placeholder="Current Password" required>
		</div>
		</div>
		
		
		<div class="card shadow mb-4">
			<div class="card-header py-3"><h6 class="m-0 font-weight-bold">New Password * </h6></div>
			<div class="card-body">
                 <input type="password" class="form-control" name="newpass" id="admin_new_password" placeholder="New Password" required>
		</div>
		</div>
		
		
		<div class="card shadow mb-4">
			<div class="card-header py-3"><h6 class="m-0 font-weight-bold">Re-Type New Password * </h6></div>
			<div class="card-body">
                  <input type="password" class="form-control" name="renewpass" id="admin_retype_password" placeholder="Re-Type New Password" required>
		</div>
		</div> 
		
	    <div class="card shadow mb-4">
			<div class="card-body">
                <button name="addProduct_btn" type="submit" class="btn  form-control btn-success add-product_btn">Update Profile</button>
		</div>
		</div> 
		
		
		
		</div>
 
 
 
	</div>
 
</form>


@stop
@section('footer')
 
@stop
