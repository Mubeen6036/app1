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
	 <h1 class="h3 mb-0 text-gray-800"> User List
	     <a href="{!! url('admin/user/create') !!}" class="d-sm-inline-block btn btn-info shadow-sm ml-auto btn-icon-split"><span class="icon text-white-50"><i class="fas fa-plus fa-sm text-white"></i></span><span class="text">Create User</span></a>
	 </h1>

	 <a href="{!! url('admin/user/export-user') !!}" class="d-sm-inline-block btn btn-success shadow-sm ml-auto btn-icon-split"><span class="icon text-white-50"><i class="fas fa-download fa-sm text-white"></i></span><span class="text">Download </span></a>
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
	<ul class="card-header py-3 nav nav-tabs" id="routetab" role="tablist">
		     <li class="nav-item status stats" data-id="active" data-user_type="user" data-login_type="user" ><a data-toggle="tab" href="#enquiriestabs" id="open" class="nav-link active" >Active </a></li>
			 <li class="nav-item status " data-id="deactive" data-user_type="user" data-login_type="user" ><a data-toggle="tab" href="#enquiriestabs" id="close" class="nav-link" > Closed </a></li>
    </ul> 

				
				
	<div class="card-body tab-content" id="enquiriestabs">
		<div id="activeRoute" class="tab-pane fade show active" role="tabpanel" aria-labelledby="active-route">

			<div class="table-responsive">
				  <table id="userlist" class="table table-striped margin-bottom-10 dt-responsive" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th width="20%"> Name</th>
								<th width="20%"> Email</th>
								<th width="15%"> Phone</th>
								<th width="10%"> Verify</th>
								<th width="15%"> Join at </th>
								<th width="20%"> Actions</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
			</div>
		</div>

		 
	</div>
</div>
</div>

<div class="modal table-modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-lg modal-dialog-centered">
		<div class="modal-content panel-danger">
			<div class="modal-header panel-heading">
				<h3 class="modal-title center" id="myModalLabel"><i class="fa fa-exclamation-circle fa-fw"></i> Confirm Delete</h3>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<p>You are about to delete this Record.</p>
				<h4>Do you want to proceed?</h4>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
				<a class="btn btn-danger btn-ok">Delete</a>
			</div>
		</div>
	</div> 
</div>


<div class="modal table-modal fade" id="send-mail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-lg modal-dialog-centered">
		<div class="modal-content panel-danger">
			<div class="modal-header panel-heading">
				<h3 class="modal-title center" id="myModalLabel"><i class="as fa-fw fa fa-envelope"></i> Send Mail </h3>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>

			 <form id="message_form">
               

			<div class="modal-body">
					<div class="col-lg-12 col-xs-12">
                       	  <div id="message_success" style="display:none;" class="alert alert-success">success</div>
	                      <div id="message_error" style="display:none;" class="alert alert-danger"> error</div>
	                      		 

					  <div class="card shadow mb-4">
							<div class="card-header py-3"><h6 class="m-0 font-weight-bold">Email : </h6></div>
							<div class="card-body">
								    <input type="hidden" class="form-control" autocomplete="off" name="name"  id="sender_name" value=""> 
							 		<input type="text" readonly=""  class="form-control" autocomplete="off" name="mail" id="sender_email" value=""> 
							</div>
						</div>
						 <div class="card shadow mb-4">
							<div class="card-header py-3"><h6 class="m-0 font-weight-bold">Subject : </h6></div>
							<div class="card-body">
								  	<input type="text" class="form-control" autocomplete="off" name="subject"  id="sender_subject" placeholder="Type your Subject" required="">
							</div>
						</div>
						<div class="card shadow mb-4">
							<div class="card-header py-3"><h6 class="m-0 font-weight-bold" > Message </h6></div>
							<div class="card-body">
									<textarea name="message" class="form-control" id="sender_message" placeholder="Type your Message" > </textarea>
							</div>
						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success sendmail"  ><i class="as fa-fw fa fa-envelope"></i>Send Mail</button>
				<button type="button" class="btn btn-warning close_messsage"  data-dismiss="modal"><i class="as fa-fw fa fa-times-circle"></i>Cancel</button>
			</div>
            </form>

		</div>
	</div> 
</div>






@stop
@section('footer')
<script>


   	  
    jQuery('body').on('click', '.send_mail', function() {
		   var name = jQuery(this).data('name'); 
		   var email = jQuery(this).data('email'); 
		   $('#sender_email').val(email);
		   $('#sender_name').val(name);
   }); 	   
    jQuery('body').on('click', '.close_messsage', function() {
		    $('#sender_subject').val('');
		    $('#sender_message').val('');
   }); 	 


    jQuery('body').on('click', '.sendmail', function() {
			var sender_name = $('#sender_name').val();
			var sender_email = $('#sender_email').val();
			var sender_subject = $('#sender_subject').val();
			var sender_message = $('#sender_message').val();
			if(sender_subject == "") {
	                $("#message_error").show();
	                $("#message_error").html("Subject is required, please enter valid Subject!");
	                   setTimeout(function() {
	                            $('#message_error').fadeOut(1000);
	                   }, 2000);
	                return false;
	         }
	        if($('#sender_message').val().trim().length <= 0){
	                $("#message_error").show();
	                $("#message_error").html("Message is required, please enter valid Message!");
	                   setTimeout(function() {
	                            $('#message_error').fadeOut(1000);
	                   }, 2000);
	                return false;
	         }
 
	          jQuery.ajax({
                    type:'POST',
                    dataType: 'JSON',
                    url: "{{route('send_ajax_mail')}}",   
                    data:{
                           "_token": "{{ csrf_token() }}",
                           name:sender_name,
                           email:sender_email,
                           subject:sender_subject,
                           message:sender_message,
                         },
                    cache: false,
                    success: function(response) {
                         var message = response[0].message;
                         var status = response[0].status;
                        if (status == 'true') {
                            $('#sender_subject').val('');
		                    $('#sender_message').val('');
		                    $("#message_success").show();
                            $("#message_success").html(message);
                            setTimeout(function() {
                                $('#message_success').fadeOut(1000);
                                $("#send-mail").modal('hide');
                            }, 5000);
                        } else {
                            $("#message_error").show();
                            $("#message_error").html(message);
                            setTimeout(function() {
                                $('#message_error').fadeOut(1000);
                            }, 5000);
                        }
                    }
                });
   }); 	 
 
	$('#confirm-delete').on('show.bs.modal', function(e) {
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	}); 
 
     $(document).ready(function() {
		$.fn.dataTable.ext.errMode = 'throw';
		var dataTable = $("#userlist").DataTable({
			language: {
				processing: '<i class="fa  fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
			},
			"processing": true,
			"serverSide": true,
			"pageLength": 10,
			lengthMenu: [
				[10, 25, 50, 100, 250, 500],
				['10', '25', '50', '100', '250', '500']
			],
			dom: 'Blfrtip',  
			order: [ [1, "desc"] ],
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			],
			"ajax": {
				"url": "<?= route('user_list') ?>",
				"dataType": "json",
				"type": "POST",
				'data': function(data) {
					data.status = $('.stats').attr("data-id");
					data.user_type = $('.stats').attr("data-user_type");
					data.login_type = $('.stats').attr("data-login_type");
					data._token = '<?= csrf_token() ?>';
				}
			}, 
			"drawCallback": function() {
				// $.switcher();
			},
			// show columns which  we want to show  in data  base table
			"columns": [{ "data": "name" },
						{ "data": "email" 	},
						{ 	"data": "phone" },
						{ 	"data": "email_verify" },
						{ 	"data": "created_at" },
						{ 	"data": "action","searchable": false,"orderable": false }
			]
		});
  
		// on clcik show all qnquiry status wise filter status stats
		$('.status').click(function() {
			$('.status').removeClass('stats')
			$(this).addClass('stats'); 
         	dataTable.draw();
		});


	});
 
</script>
@stop
