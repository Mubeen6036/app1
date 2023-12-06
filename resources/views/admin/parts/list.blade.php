@extends('admin.includes.masterpage-admin')
@section('content')


<style>
	.user_img {
	    border: 1px solid !important;
	    border-radius: 53px !important;
	    height: 50px !important;
	    width: 50px !important;
	}
</style>

 <!-- Page Heading -->
 <div class="d-flex align-items-center justify-content-between mb-4">
	 <h1 class="h3 mb-0 text-gray-800"> Parts List
	     <a href="{!! url('parts/create') !!}" class="d-sm-inline-block btn btn-info shadow-sm ml-auto btn-icon-split"><span class="icon text-white-50"><i class="fas fa-plus fa-sm text-white"></i></span><span class="text">Add Part</span></a>
	 </h1>
</div>
<div class="clearfix"></div>
<div class="col-md-12">
		@if(Session::has('message'))
		<div class="alert alert-success alert-dismissable">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			{{ Session::get('message') }}
		</div>
		@endif
 </div>
<div class="box-content">
<div class="card shadow mb-4 route-tab">
	<div class="card-body tab-content" id="enquiriestabs">
		<div id="activeRoute" class="tab-pane fade show active" role="tabpanel" aria-labelledby="active-route">

			<div class="table-responsive">
				  <table id="userlist" class="table table-striped margin-bottom-10 dt-responsive" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th width="20%"> Part Name</th>
								<th width="15%"> Date of Manufacture </th>
								<th width="15%"> Model Name</th>
								<th width="15%"> Brand Name</th>
								<th width="15%"> date </th>
								<th width="20%"> Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($parts  as $key)
							<tr id="row{{$key->id}}">
								<td>{{$key->name}}</td>
								<td>{{date('F Y',strtotime($key->manufacture_date))}}</td>
								<td>{{$key->model_name}}</td>
								<td>{{$key->brand_name}}</td>
								<td>{{date('d F, Y',strtotime($key->created_at))}}</td>
								<td>
									<div>
										<a href="javascript:;"  class="btn btn-danger remove" data-id="{{$key->id}}">delete</a>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
			</div>
			@if(!$parts->isEmpty())
			{!! $parts->links() !!}
			@endif
		</div>

		 
	</div>
</div>
</div>

@stop
@section('footer')
<script>
	$('.remove').click(function () {
		if (confirm('Do you want to remove this row?')) {
			var id = $(this).attr('data-id');
			$.ajax({
				url:"{{route('remove_row')}}",
				data:{id:id,'table':'app_parts'},
				cache:false,
				success:function (response){
					$('#row'+id).fadeOut(1200).css({'background-color':'#f2dede'});
				}
			})
		}else{
			return false;
		}
	});
</script>
@stop
