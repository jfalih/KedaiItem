<div class="col-12">
    <div class="paginator">
        <div class="paginator__counter">
            {{$paginator->count()}} from {{$paginator->total()}}
        </div>

        <ul class="paginator__wrap">
            @if ($paginator->onFirstPage())
            <li class="paginator__item paginator__item--prev">
                <a href="#">
                    <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><polyline points='244 400 100 256 244 112' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px'/><line x1='120' y1='256' x2='412' y2='256' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px'/></svg>
                </a>
            </li>
            @else
            <li class="paginator__item paginator__item--prev">
                <a href="{{ $paginator->previousPageUrl() }}">
                    <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><polyline points='244 400 100 256 244 112' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px'/><line x1='120' y1='256' x2='412' y2='256' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px'/></svg>
                </a>
            </li>
            @endif
            @foreach ($elements as $element)   
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="paginator__item paginator__item--active"><a href="#">{{$page}}</a></li>
                        @else
                            <li class="paginator__item"><a href="{{$url}}">{{$page}}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if($paginator->hasMorePages())            
                <li class="paginator__item paginator__item--next">
                    <a href="{{ $paginator->nextPageUrl() }}">
                        <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><polyline points='268 112 412 256 268 400' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px'/><line x1='392' y1='256' x2='100' y2='256' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px'/></svg>
                    </a>
                </li>
            @else
                <li class="paginator__item paginator__item--next">
                    <a href="{{ $paginator->nextPageUrl() }}">
                        <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'><polyline points='268 112 412 256 268 400' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px'/><line x1='392' y1='256' x2='100' y2='256' style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px'/></svg>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>