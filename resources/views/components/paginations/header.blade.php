
    <div class="d-flex justify-content-center justify-content-sm-between align-items-center pt-2 pb-4 pb-sm-5">
        <div class="d-flex flex-wrap">
            <div class="d-flex align-items-center flex-nowrap me-3 me-sm-4 pb-3">
                <label class="text-light opacity-75 text-nowrap fs-sm me-2 d-none d-sm-block" for="sorting">Urutkan:</label>
                <select class="form-select" id="sorting">
                    <option>Harga Terkecil - Terbesar</option>
                    <option>Harga Terbesar - Terkecil</option>
                    <option>Dari A - Z</option>
                    <option>Dari Z - A</option>
                </select><span class="fs-sm text-light opacity-75 text-nowrap ms-2 d-none d-md-block">dari {{$paginator->total()}} Item</span>
            </div>
        </div>
        <div class="d-flex pb-3">
            @if ($paginator->onFirstPage())
            <a class="nav-link-style nav-link-light me-3" href="#"><i class="ci-arrow-left"></i></a>
            @else
            <a class="nav-link-style nav-link-light me-3" href="{{ $paginator->previousPageUrl() }}"><i class="ci-arrow-left"></i></a>
            @endif
            <span class="fs-md text-light">{{$paginator->currentpage()}} / {{$paginator->lastpage()}}</span>
            @if ($paginator->hasMorePages())
            <a class="nav-link-style nav-link-light ms-3" href="{{ $paginator->nextPageUrl() }}"><i class="ci-arrow-right"></i></a>
            @else
            <a class="nav-link-style nav-link-light ms-3" href="#"><i class="ci-arrow-right"></i></a>
            @endif
        </div>
        <div class="d-none d-sm-flex pb-3">
            <a class="btn btn-icon nav-link-style bg-light text-dark disabled opacity-100 me-2" href="#"><i class="ci-view-grid"></i></a><a class="btn btn-icon nav-link-style nav-link-light" href="shop-list-ls.html"><i class="ci-view-list"></i></a>
        </div>
    </div>