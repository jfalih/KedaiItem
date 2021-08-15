
    <nav class="d-flex justify-content-between pt-2" aria-label="Page navigation">
        
        @if ($paginator->onFirstPage())
        <ul class="pagination">
            <li class="page-item"><a class="page-link"><i class="ci-arrow-left me-2"></i>Prev</a></li>
        </ul>
        @else
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i class="ci-arrow-left me-2"></i>Prev</a></li>
        </ul>
        @endif
        <ul class="pagination">
            <li class="page-item d-sm-none"><span class="page-link page-link-static">{{$paginator->currentpage()}} / {{$paginator->lastpage()}}</span></li>
        @foreach ($elements as $element)   
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active d-none d-sm-block" aria-current="page"><span class="page-link">{{$page}}<span class="visually-hidden">(current)</span></span></li>
                    @else
                        <li class="page-item d-none d-sm-block"><a class="page-link" href="{{$url}}">{{$page}}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        </ul>
        @if ($paginator->hasMorePages())            
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">Next<i class="ci-arrow-right ms-2"></i></a></li>
            </ul>
        @else
            <ul class="pagination">
                <li class="page-item"><a class="page-link" aria-label="Next">Next<i class="ci-arrow-right ms-2"></i></a></li>
            </ul>
        @endif
    </nav>