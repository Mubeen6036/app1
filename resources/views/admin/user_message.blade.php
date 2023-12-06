@extends('admin.includes.masterpage-admin')
@section('content')
 <!-- Page Heading -->
 <style>
 .card-body.user-list {
    height: 500px;
    overflow: overlay;
}
 </style>
<div class="d-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Send Mail to all Users</h1>
	    <a href="{!! url('admin/dashboard') !!}" class="d-sm-inline-block btn btn-warning shadow-sm ml-auto btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left fa-sm text-white"></i></span><span class="text">Back</span></a>
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
<div class="box-content">


<form method="POST" action="{!! url('admin/send-user-message') !!}" action="" class="" enctype="multipart/form-data">
	{{csrf_field()}}
	<div class="row small-spacing">
		<div class="col-lg-6 col-xs-12"> 
		
		<div class="card shadow mb-4">
			<div class="card-header py-3"><h6 class="m-0 font-weight-bold"> Select User List : </h6></div>
			<div class="card-body user-list">
               <ul class="list-group list-group-flush">
			      <li class="list-group-item">
					  <div >
						<input type="checkbox" id="check_all" >
						<label for="check_all">Select All</label>
					  </div>
					</li>
					
			   @foreach($users as $key=>$val)
					 <li class="list-group-item">
					  <div>
						<input type="checkbox" name="id[]" value="{{$val->id}}" id="{{$val->id}}">
						<label for="{{$val->id}}">{{$val->email}}</label>
					  </div>
					</li>
					@endforeach
    
                   </ul>
		    </div>
		</div> 
		
	
 
 
		 
		</div>
 
		<div class="col-lg-6 col-xs-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3"><h6 class="m-0 font-weight-bold">Subject : </h6></div>
				<div class="card-body">
						<input type="text" class="form-control" autocomplete="off" name="subject" id="sender_subject" placeholder="Type your Subject" required="">
				</div>
			</div>
			<div class="card shadow mb-4">
				<div class="card-header py-3"><h6 class="m-0 font-weight-bold"> Message </h6></div>
				<div class="card-body">
						<textarea  class="tinymce" name="message" rows="8" class="form-control" id="sender_message" placeholder="Type your Message"> </textarea>
				</div>
			</div>
			<div class="card shadow mb-4">
				<div class="card-header py-3"><h6 class="m-0 font-weight-bold">   </h6></div>
				<div class="card-body">
						   <button type="submit" class="btn btn-success  form-control "><i class="as fa-fw fa fa-envelope"></i>Send Mail</button>
				</div>
			</div> 

		</div>
 
</form>

 
 
@stop
@section('footer')
 	 <script>
		$(document).ready(function() {
			$('#check_all').click(function() {
				var checked = this.checked;
				 $('input[type="checkbox"]').each(function() {
						this.checked = checked;
					});
			}); 
	    }); 
		 </script>
@stop
