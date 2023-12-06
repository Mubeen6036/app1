@extends('admin.includes.masterpage-admin')

@section('content')
<div class="page-titles">
    <div class="d-flex align-items-center justify-content-between">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{!! url('admin/dashboard') !!}">Dashboard</a></li>
            <li class="breadcrumb-item active">Website Logo</li>
        </ol>
    </div>
</div>
@if(Session::has('message'))
	<div class="alert alert-success alert-dismissable">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{{ Session::get('message') }}
	</div>
@endif
<form method="POST" action="{!! url('admin/update_logo') !!}" action="" class="" enctype="multipart/form-data">
	{{csrf_field()}}
	<div class="row justify-content-center">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Header Logo 1</h4>
				</div>
				<div class="card-body">
					<div class="text-center mb-3" style="padding: 20px; background: #f6f3f9;">
						@if($data->logo)
							 <img id="adminimg" src="{{url('/')}}/public/uploads/{{$data->logo}}" style="max-height: 150px;">
						 @else
					         <img id="adminimg" src="{{ url('public/uploads/no-image.png')}}" style="max-height: 150px;">
						@endif
					</div>
					<div class="text-center">
						<input class="d-none"  accept="/.jpf" onchange="readURL(this)" id="uploadFile" name="logo" type="file">
						<button name="admin_image_btn" id="uploadTrigger" onclick="uploadclick()" type="button" class="btn btn-primary btn-sm add-product_btn adminImg-btn"><i class="fa fa-upload"></i> Change Header Logo 1</button>
					</div>
				</div>				
		   </div>
		</div> 
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Header Logo 2</h4>
				</div>
				<div class="card-body">
					<div class="text-center mb-3" style="padding: 20px; background: #f6f3f9;">
						@if($data->footer_logo)
							 <img id="adminimg" src="{{url('/')}}/public/uploads/{{$data->footer_logo}}" style="max-height: 150px;">
						 @else
					         <img id="adminimg" src="{{ url('public/uploads/no-image.png')}}" style="max-height: 150px;">
						@endif
					</div>
					<div class="text-center">
                    	<input class="d-none"  accept="/.jpf" onchange="readURL1(this)" id="uploadFile1" name="footer_logo" type="file">
						<button name="admin_image_btn" id="uploadTrigger1" onclick="uploadclick1()" type="button" class="btn btn-primary btn-sm add-product_btn adminImg-btn"><i class="fa fa-upload"></i> Change Header Logo 2</button>
					</div>
				</div>				
		   </div>		   
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Footer Logo</h4>
				</div>
				<div class="card-body">
					<div class="text-center mb-3" style="padding: 20px; background: #f6f3f9;">
						@if($data->footer_logo)
							 <img id="adminimg" src="{{url('/')}}/public/uploads/{{$data->footer_logo}}" style="max-height: 150px;">
						 @else
					         <img id="adminimg" src="{{ url('public/uploads/no-image.png')}}" style="max-height: 150px;">
						@endif
					</div>
					<div class="text-center">
                    	<input class="d-none"  accept="/.jpf" onchange="readURL2(this)" id="uploadFile2" name="footer_logo" type="file">
						<button name="admin_image_btn" id="uploadTrigger2" onclick="uploadclick2()" type="button" class="btn btn-primary btn-sm add-product_btn adminImg-btn"><i class="fa fa-upload"></i> Change Footer Logo</button>
					</div>
				</div>				
		   </div>	   
		</div> 
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Favicon</h4>
				</div>
				<div class="card-body">
					<div class="text-center mb-3" style="padding: 20px; background: #f6f3f9;">
						@if($data->icon)
							 <img id="adminimg" src="{{url('/')}}/public/uploads/{{$data->icon}}" style="max-height: 150px;">
						 @else
					         <img id="adminimg" src="{{ url('public/uploads/no-image.png')}}" style="max-height: 150px;">
						@endif
					</div>
					<div class="text-center">
                    	<input class="d-none"  accept="/.jpf" onchange="readURL3(this)" id="uploadFile3" name="icon" type="file">
                    <button name="admin_image_btn" id="uploadTrigger3" onclick="uploadclick3()" type="button" class="btn btn-primary btn-sm add-product_btn adminImg-btn"><i class="fa fa-upload"></i> Change Favicon</button>
					</div>
				</div>				
		   </div>
		   
		</div>
 
	</div>
	<div class="form-action-col text-right">
		<button name="addProduct_btn" id="submit" type="submit" class="btn btn-success add-product_btn">Update Logo</button>
	</div>
 
</form>
<div style="height: 100px;"></div>

@stop
@section('footer')
 <script>
        function uploadclick1(){
            $("#uploadFile1").click();
            $("#uploadFile1").change(function(event) {
                $("#uploadTrigger1").html($("#uploadFile1").val());
            });
        }

        function readURL1(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#adminimg1').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function uploadclick2(){
            $("#uploadFile2").click();
            $("#uploadFile2").change(function(event) {
                $("#uploadTrigger2").html($("#uploadFile2").val());
            });
        }

        function readURL2(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#adminimg2').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function uploadclick3(){
            $("#uploadFile3").click();
            $("#uploadFile3").change(function(event) {
                $("#uploadTrigger3").html($("#uploadFile3").val());
            });
        }

        function readURL3(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#adminimg3').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
 
@stop
