
    <div class="page-title-overlap bg-accent pt-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
          <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                <li class="breadcrumb-item"><a class="text-nowrap" href="{{url('/')}}"><i class="ci-home"></i>Home</a></li>
                @php 
                  $arr = Request::segments();
                  $i = 0; 
                @endphp
                @foreach ($arr as $value)
                    @php $i++; @endphp
                    @if($i === count(Request::segments()))
                      <li class="breadcrumb-item text-nowrap active">
                        {{$arr[$i-1]}}
                      </li>
                    @else 
                      @if($i % 2 === 0)
                      <li class="breadcrumb-item text-nowrap">
                        <a href="{{url($arr[$i-2].'/'.$arr[$i-1])}}">
                          {{$arr[$i-1]}}
                        </a>
                      </li>
                      @endif
                    @endif
                @endforeach
              </ol>
            </nav>
          </div>
          <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
            <h1 class="h3 text-light mb-0">{{$title}}</h1>
          </div>
        </div>
      </div>