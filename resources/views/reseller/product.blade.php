@extends('layouts.user')
@section('content')
<div class="pt-2 ps-lg-0 mb-4">
  <!-- Title-->
  <div class="d-sm-flex mb-4 flex-wrap justify-content-between align-items-center border-bottom">
    <h2 class="h3 py-2 me-2 text-center text-sm-start">Produk Kamu<span class="badge bg-faded-accent fs-sm text-body align-middle ms-2">{{\App\Models\Item::where('user_id', Auth::user()->id)->count()}}</span></h2>
    <div class="py-2">
      <div class="d-flex flex-nowrap align-items-center pb-3">
        <!-- Launch default modal -->
        <button class="btn btn-outline-secondary" type="button" data-bs-toggle="offcanvas" data-bs-target="#filterRight">
          <i class="ci-filter-alt me-2"></i>Filter
        </button>
      </div>
    </div>
  </div>
    <!-- Textual addon -->
  @forelse($items as $item)
  
  <!-- Product-->
  <div class="d-block d-sm-flex align-items-center py-4 border-bottom">
    <a class="d-block mb-3 mb-sm-0 me-sm-4 ms-sm-0 mx-auto" href="{{url('penjual/'.Auth::user()->username.'/item/'.$item->slug)}}">
      <img style="width: 10.5rem;height: 10.5rem;object-fit: cover;" class="rounded-3" src="{{Storage::url($item->images->first()->name)}}" alt="">
    </a>
    <div class="text-center text-sm-start">
      <h3 class="h6 product-title mb-2">
        <a href="marketplace-single.html">{{$item->name}}</a>
      </h3>
      <p>{{$item->description}}</p>
      <div class="d-inline-block text-accent">Rp{{number_format($item->price,2,',','.')}}</div>
      <div class="d-inline-block text-muted fs-ms border-start ms-2 ps-2">Stok: <span class="fw-medium">{{$item->stok}}</span></div>
      <div class="d-inline-block text-muted fs-ms border-start ms-2 ps-2">Penjualan: <span class="fw-medium">{{$item->sold}}</span></div>
      <div class="d-inline-block text-muted fs-ms border-start ms-2 ps-2">Pendapatan: <span class="fw-medium">Rp{{$item->price*$item->sold}}</span></div>
      <div class="d-flex justify-content-center justify-content-sm-start pt-3">
        <a class="btn bg-faded-warning btn-icon me-2" href="{{route('item.detail',['seller' => Auth::user()->username,'product' => $item->slug])}}" data-bs-toggle="tooltip" title="View"><i class="ci-eye text-warning"></i></a>
        <a class="btn bg-faded-info btn-icon me-2" href="{{route('reseller.product.edit',['item' => $item])}}" data-bs-toggle="tooltip" title="Edit"><i class="ci-edit text-info"></i></a>
        <form method="POST" action="{{route('reseller.product.delete', ['item'=> $item])}}">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn bg-faded-danger btn-icon" type="button" data-bs-toggle="tooltip" title="Delete"><i class="ci-trash text-danger"></i></button>
        </form>
      </div>
    </div>
  </div>
  @empty
  <div class="row justify-content-center pt-lg-4 text-center">
    <div class="col-12">
      <img class="d-block mx-auto mb-5" src="{{Storage::url('public/website/illustration/sad.png')}}" width="340" alt="404 Error">
      <h1 class="h3">Kami tidak menemukan produk apapun :(</h1>
      <h3 class="h5 fw-normal mb-4">Kami tidak dapat menemukan barang yang kamu jual.</h3>
      <a href="{{route('reseller.product.add')}}" class="btn btn-primary">Mulai Berjualan</a>
    </div>
  </div>
  @endforelse
</div>
{{$items->links('components.paginations.default')}}
<!-- Offcanvas -->
<div class="offcanvas offcanvas-end" id="filterRight" tabindex="-1">
  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title">Filter</h5>
    <button class="btn-close" type="button" data-bs-dismiss="offcanvas"></button>
  </div>
  <form method="POST" action="{{route('reseller.product')}}" class="offcanvas-body" data-simplebar>
    @csrf
    <!-- Select -->
    <div class="mb-2">
      <label for="select-input" class="form-label">Kategori</label>
      <select class="form-select" name="category" id="category">
        <option>Pilih Kategori..</option>
        @foreach($categories as $cat)
          <option value="{{$cat->id}}">{{$cat->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="mb-2">
      <label for="select-input" class="form-label">Subkategori</label>
      <select class="form-select" name="subcategory">
        <option>Pilih Kategori Dahulu..</option>
      </select>
    </div>
    <div class="mb-2">
      <label for="text-input" class="form-label">Nama Barang</label>
      <input class="form-control" type="text" name="nama_barang" placeholder="Nama Barang">
    </div>
    <div class="mb-2">
      <label for="text-input" class="form-label">Minimal</label>      
      <input class="form-control" type="number" min="0" name="min" placeholder="Minimal">
    </div>
    <div class="mb-2">
      <label for="text-input" class="form-label">Stok</label>      
      <input class="form-control" type="number" min="0" name="stok" placeholder="Stok">
    </div>
    <!-- Select -->
    <div class="mb-4">
      <label for="sort-by" class="form-label">Urutkan</label>
      <select class="form-select" id="sort-by">
        <option>Urutkan...</option>
        <option>A - Z</option>
        <option>Z - A</option>
        <option>Penjualan Terbanyak</option>
        <option>Termurah - Termahal</option>
        <option>Termahal - Termurah</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary d-block w-100">Terapkan</button>
  </form>
</div>

<!-- Default modal-->
@endsection
@section('extra-js')
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="category"]').on('change', function() {
            var categoryID = $(this).val();
            var url = '{{route("category.subcategory",["category" =>":id"])}}';
            url = url.replace(':id',categoryID);
            if(categoryID){
                $.ajax({
                    url: url,
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(data) {
                        $('select[name="subcategory"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subcategory"]').append('<option value="'+ key +'">'+ value.name +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="subcategory"]').empty();
                $('select[name="subcategory"]').append('<option>Pilih Kategori Dahulu..</option>');
                        
            }
        });
    });
</script>
@endsection