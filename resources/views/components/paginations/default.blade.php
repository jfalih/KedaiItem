
<div class="col-lg-12">
    <div class="footer-pagection">
        <p class="page-info">Tampil {{$paginator->count()}} dari {{$paginator->total()}} item</p>
        <ul class="pagination">
            @if($paginator->onFirstPage())
                <li class="page-item">
                    <a class="page-link" href="#"><i class="fas fa-long-arrow-alt-left"></i></a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i class="fas fa-long-arrow-alt-left"></i></a>
                </li>
            @endif
            @foreach ($elements as $element)   
                @if (is_string($element))
                    <li class="page-item">...</li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())    
                            <li class="page-item">
                                <a class="page-link active" href="#">{{$page}}</a>
                            </li>
                        @else    
                            <li class="page-item">
                                <a class="page-link active" href="{{$url}}">{{$page}}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if($paginator->hasMorePages())           
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}"><i class="fas fa-long-arrow-alt-right"></i></a>
                </li>
            @else   
                <li class="page-item">
                    <a class="page-link" href="#"><i class="fas fa-long-arrow-alt-right"></i></a>
                </li>
            @endif
        </ul>
    </div>
</div>