@extends('layouts.user')
@section('content')
<div class="pt-2 px-4 ps-lg-0 pe-xl-5">
  <!-- Title-->
  <div class="d-sm-flex flex-wrap justify-content-between align-items-center border-bottom">
    <h2 class="h3 py-2 me-2 text-center text-sm-start">Produk Kamu<span class="badge bg-faded-accent fs-sm text-body align-middle ms-2">{{\App\Models\Item::where('user_id', Auth::user()->id)->count()}}</span></h2>
  </div>
  @forelse($items as $item)
  
  <!-- Product-->
  <div class="d-block d-sm-flex align-items-center py-4 border-bottom">
    <a class="d-block mb-3 mb-sm-0 me-sm-4 ms-sm-0 mx-auto" href="marketplace-single.html" style="width: 12.5rem;">
      <img class="rounded-3" src="" alt=""></a>
    <div class="text-center text-sm-start">
      <h3 class="h6 product-title mb-2"><a href="marketplace-single.html">{{$item->name}}</a></h3>
      <div class="d-inline-block text-accent">Rp{{number_format($item->price,2,',','.')}}</div>
      <div class="d-inline-block text-muted fs-ms border-start ms-2 ps-2">Penjualan: <span class="fw-medium">{{$item->sold}}</span></div>
      <div class="d-inline-block text-muted fs-ms border-start ms-2 ps-2">Pendapatan: <span class="fw-medium">Rp 2103210</span></div>
      <div class="d-flex justify-content-center justify-content-sm-start pt-3">
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
      <h1 class="h3">Kemu belum menjual apapun :(</h1>
      <h3 class="h5 fw-normal mb-4">Kami tidak dapat menemukan barang yang kamu jual.</h3>
      <a href="{{route('reseller.product.add')}}" class="btn btn-primary">Mulai Berjualan</a>
    </div>
  </div>
  @endforelse
</div>
@endsection
@section('extra-js')

@endsection