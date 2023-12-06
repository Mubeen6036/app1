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

<div class="d-flex align-items-center mb-4">
	<a href="{!! url('admin/user') !!}" class="d-sm-inline-block btn btn-secondary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white"></i></a>
	<h1 class="h3 mx-2 mb-0 text-gray-800">
     {{@$data->name}}
        <?php if(@$data->status == "active"){ ?>
            <span class="badge badge-success">{{ucfirst(@$data->status)}}</span>
        <?php } else { ?>
            <span class="badge badge-warning">{{ucfirst(@$data->status)}}</span>
        <?php } ?>
    </h1>
    <a href="{{url('/')}}/admin/user/{{@$data->id}}/edit" class="d-sm-inline-block btn btn-primary shadow-sm ml-auto btn-icon-split"><span class="icon text-white-50"><i class="fas fa-edit fa-sm text-white"></i></span><span class="text">Edit</span></a>
</div>
 

<div class="clearfix"></div>
 
	<div class="row small-spacing">
		
		<div class="col-lg-8 col-xs-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3"><h6 class="m-0 font-weight-bold">  Name : </h6></div>
			<div class="card-body">
                {{@$data->name}}
		</div>
		</div>
		
		
		<div class="card shadow mb-4">
			<div class="card-header py-3"><h6 class="m-0 font-weight-bold">Email Address : </h6></div>
			<div class="card-body">
               {{@$data->email}} 
		</div>
		</div>
		
		
		<div class="card shadow mb-4">
			<div class="card-header py-3"><h6 class="m-0 font-weight-bold">Phone Number : </h6></div>
			<div class="card-body">
                {{@$data->phone}} 
		</div>
		</div> 

	    <div class="card shadow mb-4">
			<div class="card-header py-3"><h6 class="m-0 font-weight-bold">Country : </h6></div>
			<div class="card-body">
                {{@$data->country}} 
		</div>
		</div> 

		
		</div>
 
	 <div class="col-lg-4 col-xs-12">
		 <div class="card shadow mb-4">
			<div class="card-header py-3"><h6 class="m-0 font-weight-bold">Image : </h6></div>
				<div class="card-body">
				   <img id="adminimg" src="{{url('/')}}/public/uploads/user/{{@$data->photo}}" alt="">
				</div>
		   </div>
		</div>
 
	</div>
 
</form>


@stop
@section('footer')
 
@stop
