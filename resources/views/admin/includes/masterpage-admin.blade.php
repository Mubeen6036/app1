<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="title" content="">
     <meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="icon" type="image/png" href="{{url('/')}}/public/uploads/admin/{{ Auth::user()->photo}}"/>
    <title>Dashboard - IFACC</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('public/assets/backend/vendor/chartist/css/chartist.min.css')}}">    
    <link href="{{ URL::asset('public/assets/backend/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('public/assets/backend/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">    
    <link href="{{ URL::asset('public/assets/admin/css/parsley.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('public/assets/backend/vendor/summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('public/assets/backend/css/style.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('public/assets/backend/css/style-2.css')}}" rel="stylesheet">
</head>

<body>
<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
	  
	  
<div id="main-wrapper">
    <div class="nav-header">
        <a href="{!! url('admin/dashboard') !!}" class="brand-logo">
            <img class="logo-abbr" src="{{ url('public/icon-green.png')}}" alt="">
        </a>

        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
        </div>
    </div>
    <div class="header">
        <div class="header-content">
            <nav class="navbar navbar-expand">
                <div class="collapse navbar-collapse justify-content-between">
                    <div class="header-left">
                        <div class="dashboard_bar">
                            Dashboard
                        </div>
                    </div>
                    <ul class="navbar-nav header-right">
                        <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown">
                                    <img src="{{ url('public/icon-green.png')}}" width="20" alt=""/>
                                    <div class="header-info">
                                        <span class="text-black"><strong>{{ Auth::user()->name }}</strong></span>
                                        <p class="fs-12 mb-0">Super Admin</p>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <div class="deznav">
            <div class="deznav-scroll">
                <ul class="metismenu" id="menu">
            <li class="nav-item  {{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
                <a href="{!! url('dashboard') !!}">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span></a>
            </li>			
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-notepad"></i>
                    <span class="nav-text">Car Manufacturing</span>
                </a>
                 <ul aria-expanded="false">
                    <li><a href="{!! url('brand') !!}">Brand</a></li>
                    <li><a href="{!! url('models') !!}">Model</a></li>
                    <li><a href="{!! url('parts') !!}">Parts</a></li>
                </ul>
            </li>
		    <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                    <i class="flaticon-381-television"></i>
                    <span class="nav-text">Logout</span></a>
            </li>			 
        </ul>
    </div>
</div>
<div class="content-body">
    <div class="container-fluid">
	   @yield('content')
	</div>
</div>
<div class="footer">
    <div class="copyright">
        <p>&copy; IFACC <span id="date"></span> | Designed &amp; Developed by <a href="http://amrsoftec.com/" target="_blank">AMR Softec</a></p>
    </div>
</div>
	

	<!-- /#wrapper -->
	<script>
		var baseUrl = '{!! url(' / ') !!}';
 	</script>
   <script src="{{ URL::asset('public/assets/backend/vendor/global/global.min.js')}}"></script>
    <script src="{{ URL::asset('public/assets/backend/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <!-- <script src="{{ URL::asset('public/assets/backend/vendor/chart.js/Chart.bundle.min.js')}}"></script> -->
    <script src="{{ URL::asset('public/assets/backend/js/custom.min.js')}}"></script>
    <script src="{{ URL::asset('public/assets/backend/js/deznav-init.js')}}"></script>    
    <script src="{{ URL::asset('public/assets/backend/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ URL::asset('public/assets/backend/js/plugins-init/datatables.init.js')}}"></script>
    <script src="{{ URL::asset('public/assets/admin/js/parsley.js')}}"></script>
     <script src="{{ URL::asset('public/assets/backend/vendor/summernote/js/summernote.min.js')}}"></script>
    <!-- Summernote init -->
    <script src="{{ URL::asset('public/assets/backend/js/plugins-init/summernote-init.js')}}"></script>
    
    <!-- Chart piety plugin files -->
    <script src="{{ URL::asset('public/assets/backend/vendor/peity/jquery.peity.min.js')}}"></script>
    
    <!-- Apex Chart -->
    <!-- <script src="{{ URL::asset('public/assets/backend/vendor/apexchart/apexchart.js')}}"></script> -->
    
    <!-- Dashboard 1 -->
    <!-- <script src="{{ URL::asset('public/assets/backend/js/dashboard/dashboard-1.js')}}"></script> -->


   <script>
    const date = new Date();
    document.getElementById("date").innerHTML = date.getFullYear();
    </script>
<script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

         $('body').tooltip({selector: '[data-toggle="tooltip"]'});

         //on click preventDefault text options
          $(".number").bind("keypress", function (e) {
              var keyCode = e.which ? e.which : e.keyCode
                   
              if (!(keyCode >= 48 && keyCode <= 57)) {
                $(".numbererror").css("display", "inline");
                return false;
              }else{
                $(".numbererror").css("display", "none");
              }
          });
            $("li").on('click', function(e){
              //  $(this).addClass('current').siblings().removeClass('current'); 
            });
    </script>
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
	$(document).ready(function() {
			  setTimeout(function() {
				 $( ".tox-notifications-container" ).remove();
			  }, 1000);
	  });
 
 
        /* Encode string to slug */
        function convertToSlug(str) {
            document.getElementById("seoTitle").value =   str;
            //replace all special characters | symbols with a space
            str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ').toLowerCase();

            // trim spaces at start and end of string
            str = str.replace(/^\s+|\s+$/gm, '');

            // replace space with dash/hyphen
            str = str.replace(/\s+/g, '-');
            document.getElementById("slug").value = str;
            //return str;
        }
</script>

  @yield('footer')

</body>

</html>
