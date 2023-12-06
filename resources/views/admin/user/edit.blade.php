@extends('admin.includes.masterpage-admin')

@section('content')
 
<div class="d-flex align-items-center mb-4">
	<a href="{!! url('admin/user') !!}" class="d-sm-inline-block btn btn-secondary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white"></i></a>
	<h1 class="h3 mx-2 mb-0 text-gray-800">
     {{$data->name}}
        <?php if($data->status == "active"){ ?>
            <span class="badge badge-success">{{ucfirst($data->status)}}</span>
        <?php } else { ?>
            <span class="badge badge-warning">{{ucfirst($data->status)}}</span>
        <?php } ?>
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
	
<form method="POST" action="{{ route('update_admin_user') }}" action="cabstore" class="" enctype="multipart/form-data">
	{{csrf_field()}}
	 
	 <input type="hidden" name="id" value="{{$data->id}}">
  
		<div class="row small-spacing">
		
		<div class="col-lg-8 col-xs-12">
		
		<div class="card shadow mb-4">
			<div class="card-header py-3"><h6 class="m-0 font-weight-bold"> Name : </h6></div>
			<div class="card-body">
                <input type="text" name="name" autocomplete="off" class="form-control" value="{{$data->name}}" placeholder="Type Name">
		</div>
		</div>


		<div class="card shadow mb-4">
			<div class="card-header py-3"><h6 class="m-0 font-weight-bold">Email Address : </h6></div>
			<div class="card-body">
                <input type="text" disabled  autocomplete="off" class="form-control" value="{{$data->email}}">
		</div>
		</div>

 
		<div class="card shadow mb-4">
			<div class="card-header py-3"><h6 class="m-0 font-weight-bold">Phone Number : </h6></div>
			<div class="card-body">
                <input type="text" name="phone"    autocomplete="off" class="form-control" value="{{$data->phone}}" placeholder="Type Phone Number">
		</div>
		</div> 
		 
		<div class="card shadow mb-4">
			<div class="card-header py-3"><h6 class="m-0 font-weight-bold">Country : </h6></div>
			<div class="card-body">
                <input type="text" name="country"    autocomplete="off" class="form-control" value="{{$data->country}}" placeholder="Type Country Name">
		</div>
		</div> 
		
		
		
		
		</div>
		
		
		 
		 
	 <div class="col-lg-4 col-xs-12">
	 
	  
			<div class="card shadow mb-4">
				<div class="card-header py-3"><h6 class="m-0 font-weight-bold">User Status : </h6></div>
				<div class="card-body">
				  <select class="form-control" name="status" >           
				  <option value="active" <?php if($data->status == "active"){  echo "selected"; } ?> > Active</option>
				  <option value="deactive" <?php if($data->status == "deactive"){  echo "selected"; } ?> > Closed</option>
				  </select>           
				</div>
			</div>
	 
		 <div class="card shadow mb-4">
			<div class="card-header py-3"><h6 class="m-0 font-weight-bold">Image : </h6></div>
				<div class="card-body">
				   <img id="adminimg" src="{{url('/')}}/public/uploads/user/{{$data->photo}}" alt="">
                    <input class="hidden"  accept="/.jpf" onchange="readURL(this)" id="uploadFile" name="photo" type="file">
                    <button name="admin_image_btn" id="uploadTrigger" onclick="uploadclick()" type="button" class="btn btn-block add-product_btn adminImg-btn"><i class="fa fa-upload"></i> Change Photo</button>
				</div>
				
		   </div>
		</div>
		
		<div class="col-lg-8 col-xs-12">
			<div class="card shadow mb-4">
			 
			<div class="form-group text-right">
						<button name="addProduct_btn" type="submit" class="btn  form-control btn-success add-product_btn">Update Profile</button>
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
