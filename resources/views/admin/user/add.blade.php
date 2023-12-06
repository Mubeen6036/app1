@extends('admin.includes.masterpage-admin')

@section('content')
 
<div class="d-flex align-items-center mb-4">
	<a href="{!! url('admin/user') !!}" class="d-sm-inline-block btn btn-secondary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white"></i></a>
	<h1 class="h3 mx-2 mb-0 text-gray-800">
      User Profile
    </h1>
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
<form method="POST" action="{{ url('admin/user/store') }}" class="form-horizontal"
    enctype="multipart/form-data">
	{{csrf_field()}}
	 
	 
	<div class="row small-spacing">
		 
		   
		<div class="col-lg-6 col-xs-12">
		
		<div class="card shadow mb-4">
			<div class="card-header py-3"><h6 class="m-0 font-weight-bold">User  Name : </h6></div>
			<div class="card-body">
                <input type="text" name="name"  autocomplete="off" class="form-control" value="" placeholder="Type Name">
                <input type="hidden" name="user_type" value="user"  >
                <input type="hidden" name="login_type" value="user"  >
		</div>
		</div>
		
		
		<div class="card shadow mb-4">
			<div class="card-header py-3"><h6 class="m-0 font-weight-bold">Email Address : </h6></div>
			<div class="card-body">
                <input type="text" name="email"  autocomplete="off" class="form-control" value="" placeholder="Type Email Address">
		</div>
		</div>
		
		
		<div class="card shadow mb-4">
			<div class="card-header py-3"><h6 class="m-0 font-weight-bold">Password : </h6></div>
			<div class="card-body">
                <input type="password" name="password"  autocomplete="off" class="form-control" value="" placeholder="Type Password">
		</div>
		</div> 
 
		</div>
 
	 <div class="col-lg-6 col-xs-12">
		
		  
		
	     <div class="card shadow mb-4">
			<div class="card-header py-3"><h6 class="m-0 font-weight-bold">Phone : </h6></div>
			<div class="card-body">
			   <span class="numbererror" style="display:none;color:red;"> Accept Number only</span>
                <input type="text" name="phone"  autocomplete="off" class="form-control number" value="" placeholder="Type Phone Number">
			</div>
		</div> 
		
		
		<div class="card shadow mb-4">
				<div class="card-header py-3"><h6 class="m-0 font-weight-bold">User Status : </h6></div>
				<div class="card-body">
				  <select class="form-control" name="status" >           
				  <option value="active"> Active</option>
				  <option value="deactive"> Closed</option>
				  </select>           
				</div>
			</div>
		
 
		<div class="card shadow mb-4">
			<div class="card-header py-3"></div>
			<div class="card-body">
                 <button name="addProduct_btn" type="submit" class="btn  form-control btn-success add-product_btn">Save </button>
		</div>
		</div> 
		 
		
		</div>
     
 
	</div>
 
</form>


@stop
@section('footer')
 <script>
        function uploadclick(){
            $("#uploadFile").click();
            $("#uploadFile").change(function(event) {
                $("#uploadTrigger").html($("#uploadFile").val());
            });
        }

        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#adminimg').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
 
@stop
