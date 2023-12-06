<!doctype html>
    <html class="no-js" lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="keywords" content="{{@$settings->meta_keyword}}">
        <meta name="title" content="{{@$settings->meta_title}}">
		@stack('meta')
        <title>{{@$settings->title}}</title>
        <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <![endif]--> 
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no ">
        <link rel="apple-touch-icon" sizes="57x57" href="{{ url('public/assets/front/images/favicon/apple-icon-57x57.png')}}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ url('public/assets/front/images/favicon/apple-icon-60x60.png')}}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ url('public/assets/front/images/favicon/apple-icon-72x72.png')}}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ url('public/assets/front/images/favicon/apple-icon-76x76.png')}}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ url('public/assets/front/images/favicon/apple-icon-114x114.png')}}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ url('public/assets/front/images/favicon/apple-icon-120x120.png')}}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ url('public/assets/front/images/favicon/apple-icon-144x144.png')}}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ url('public/assets/front/images/favicon/apple-icon-152x152.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ url('public/assets/front/images/favicon/apple-icon-180x180.png')}}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ url('public/assets/front/images/favicon/android-icon-192x192.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ url('public/assets/front/images/favicon/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ url('public/assets/front/images/favicon/favicon-96x96.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ url('public/assets/front/images/favicon/favicon-16x16.png')}}">
        <link rel="manifest" href="{{ url('public/assets/front/images/favicon/manifest.json')}}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ url('public/assets/front/images/favicon/ms-icon-144x144.png')}}">
        <meta name="theme-color" content="#ffffff">
        <link rel="stylesheet" href="https://use.typekit.net/jps3erh.css">
        <link rel="stylesheet" href="{{ url('public/assets/front/css/bootstrap/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ url('public/assetsslick/slick-theme.css')}}">
        <link rel="stylesheet" href="{{ url('public/assetsslick/slick.css')}}">
        <link rel="stylesheet" href="{{ url('public/assets/front/css/main.css')}}">
   </head>



   <body>
        <header class="navigation content-page">
            <div class="container">
                <div class="d-md-flex flex-md-wrap justify-content-md-center align-items-md-center">
                    <a class="logo d-flex align-items-center me-md-auto" href="{{url('/')}}">
                        <img class="logo-main" src="{{ url('public/assets/front/images/ifacc-logo.svg')}}">
                        <img class="logo-white" src="{{ url('public/assets/front/images/ifacc-white-logo.svg')}}">
                        <span>Knowledge Hub</span>
                    </a>
                    <a class="mobile-menu-btn">
                        <span></span>
                    </a>
                    <ul class="nav">
                        <li>
                            <a href="{{url('/')}}" class="nav-link">Home</a>
                        </li>
                        <li class="resources-menu"><a>Resource(s)</a>
                            <ul>
                                @if($category)
                                    @foreach($category as $key => $value)  
                                        <li><a href="{{url('resources/')}}/{{$value->slug}}" class="top-category">{{$value->name}}</a></li> 
                                     @endforeach 
                                 @endif
                            </ul>
                        </li>
                        <li>
                            <a href="https://www.tropicalforestalliance.org/en/collective-action-agenda/finance/ifacc/" class="nav-link" target="_blank">About IFACC</a>
                        </li>
                        <li class="btn-li">
                            <a href="{{url('/contact')}}" class="btn">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
<!-- header area end -->
  @yield('content')

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <!-- <div class="footer-logo">
                        <img src="{{ url('public/assets/front/images/ifacc-white-logo.svg')}}" alt="">
                    </div> -->
                     &copy; IFACC <span id="date"></span>
                </div>
                <div class="col-sm-4 text-center">
                    <ul class="social">
                            <li>
                                <a href=""> <img src="{{ url('public/assets/front/images/social-icon-instagram.svg')}}" alt=""></a>
                                <a href=""> <img src="{{ url('public/assets/front/images/social-icon-facebook.svg')}}" alt=""></a>
                                <a href=""> <img src="{{ url('public/assets/front/images/social-icon-twitter.svg')}}" alt=""></a>
                                <a href=""> <img src="{{ url('public/assets/front/images/social-icon-linkedin.svg')}}" alt=""></a>
                            </li>
                        </ul>
                </div>
                    <div class="col-sm-4 text-right">
                            <a target="_blank" href="https://www.amrsoftec.com/"> Website Design &amp; Development By <b>AMR Softec</b></a>
                        </div>
                </div>
            </div>
        </footer>
        <script src="{{ url('public/assets/front/js/jquery.min.js')}}"></script>
        <script src="{{ url('public/assets/front/js/bootstrap/bootstrap.min.js')}}"></script>
        <script src="{{ url('public/assets/front/js/scripts.js')}}"></script>
 
    
@yield('footer')
<!-- footer area end -->
<script>
    const date = new Date();
    document.getElementById("date").innerHTML = date.getFullYear();
    </script>
 <script>  
          
	jQuery(document).ready(function() { 
		
			jQuery('body').on('change', '#resource_name', function() {
				 var val =  jQuery(this).val()
				 jQuery('#resource_filter').val(val);
				   
			}); 
			
			
			
			
		    jQuery('body').on('click', '.biome_name', function() {
					if($(this).prop("checked") == true){ 
							var name = [];
							jQuery.each(jQuery("input[name='biome']:checked"), function(){
								name.push(jQuery(this).val());					
							});
							var name = name.join(",");
					} else if($(this).prop("checked") == false){
							var name = [];
							jQuery.each(jQuery("input[name='biome']:checked"), function(){
								name.push(jQuery(this).val());
							});
							var name = name.join(",");
					}
					 jQuery('#biome_filter').val(name);
			});
			
			
			//advance_filter
		  jQuery('body').on('click', '#advance_filter', function() {
				   var resource =  jQuery('#resource_filter').val();
				   if (resource!='') {
						resource = 'resource='+resource;
					}else{
						resource = '';
					}
						
				   var biome =  jQuery('#biome_filter').val();
				    if (biome!='') {
						biome = '&biome='+biome;
					}else{
						biome = '';
					}
		            
					
					baseurl = "{{url('search?')}}";
                    window.location.href=baseurl+resource+biome;
		
		  });



			  
		      jQuery("#keyword").keyup(function(){
				    $('.search-quick-links').html('');
				    var search = $(this).val();  
						$.ajax({
						url: '{{route("search_filter")}}',
						data: {
								search: search,
						},
						cache: false,
						success: function(response) {
					        $('.search-quick-links').html(response);
						       return false(); 
						} 
					 }); 
			  });



              $.ajax({
                    url: '{{route("cookie")}}',
                    data: {},
                    cache: false,
                    success: function(response) {
                         console.log(response);
                    } 
                });



			  
		  });
		</script>
    </body>
 </html>