    <section class="section partners-section light-green-bg">
        <div class="container">
            <div class="title-block">
                <h2 class="text-center">IFACC <span class="green-color">Partners</span> </h2>
            </div>
            <div class="slick partners">
                  @if($partners)
                     @foreach($partners as $data)
                        <div> 
                              <a href="{{$data->link}}" target="_blank"> 
                                  @if($data->photo)
                                          <img src="{{ url('public/uploads/partners/')}}/{{$data->photo}}">
                                   @else
                                        <img src="{{ url('public/uploads/no.jpg')}}">
                                   @endif 
                             </a>  
                        </div>
                      @endforeach 
                  @endif
            </div>
        </div>
    </section>


