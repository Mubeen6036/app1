 <section class="resources-search-section main-color-bg text-white">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-2"><h2>Search</h2></div>
                    <div class="col-md-10 search-form-col">
                        <div class="d-md-flex flex-md-wrap justify-content-md-center align-items-md-center">
                            <div class="knowledge-hub-search">
                                <label class="search-input-label" for="search">
                                    <img class="search-icon " src="{{url('public/assets/front/images/search-icon.svg')}}">
                                    <div class="search-text">What knowledge can we help you find ?</div>
                                </label>
                                <div class="search-popup">
                                    <form  method="GET" action="{{url('/search')}}">
                                        <div class="input-group">
                                         <input type="text" id="keyword" class="form-control search-field product-search-field"   value=""  name="q"  autocomplete="off">
                                         <a href="javascript:;" class="search-close"><img class="search-icon " src="{{url('public/assets/front/images/close-icon.svg')}}"></a>
                                         <button type="button" class="search-btn"><img class="search-icon " src="{{url('public/assets/front/images/search-icon-green.svg')}}"></button>
                                      </div>
                                   </form>
                                   <div class="search-quick-links">
                                        <h6><b>Quick Links</b></h6>
                                        <ul>
                                            @if($category)
                                            @foreach($category as $key => $value)
                                                <li><a href="{{url('resources/')}}/{{$value->slug}}">{{ $value->name}}</a></li>
                                                @endforeach
                                            @endif
                                        </ul>
                                        <h6><b>Biome</b></h6>
                                        <ul>
                                            @if($biome)
                                            @foreach($biome as $key => $value)
                                                <li><a href="{{url('/search?biome=')}}{{$value->slug}}">{{ $value->name}}</a></li>
                                                @endforeach
                                            @endif
                                        </ul>
                                   </div>
                               </div>
                            </div>
                            <a href="{{url('advanced-filters')}}" class="show-advance-filter">Advanced Filters</a>
                        </div>
                        <form class="advance-filters d-none" >
                            <div class="main-color-bg row align-items-center">  
                                <div class="col-md-3">  
                                    <select class="form-input" name="resource"  id="resource_name" >
                                        <option value="">Select Resource(s)</option> 
                                        @if($category)
                                            @foreach($category as $key => $value)  
                                                <option value="{{$value->slug}}" <?php if(@in_array($value->slug,@$resource_array)){ echo 'selected'; } ?>>{{$value->name}}</option>  
                                             @endforeach 
                                         @endif
                                    </select>
                                </div>
                                <div class="col-md-5 custom-checkbox">
                                    <div class="d-flex search-form-checkbox">
                                        @if($biome)
                                        @foreach($biome as $key => $value)  
                                            <label><input type="checkbox" name="biome" class="biome_name" value="{{$value->slug}}" <?php if(@in_array($value->slug,@$biome_array)){echo 'checked';}?>  ><span>{{$value->name}}</span></label>
                                        @endforeach
                                        @endif                                     
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <input type="hidden" name="resource" id="resource_filter" value="" >
                                    <input type="hidden" name="biome"  id="biome_filter" value="">
                                    <input type="button" name="advance-filter"    id="advance_filter" value="Search" class="btn">
                                </div>
                                <div class="col-md-1">
                                    <a href="javascript:void(0);" class="text-white close-advance-filter">Close</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
		

	