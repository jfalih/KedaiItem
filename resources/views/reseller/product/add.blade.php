@extends('layouts.user')
@section('content')
<div class="d-sm-flex flex-wrap justify-content-between align-items-center pb-2">
    <h2 class="h3 py-2 me-2 text-center text-sm-start">Tambah Produk Baru</h2>
  </div>
  <form method="POST" action="{{route('reseller.product.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3 pb-2">
      <label class="form-label" for="unp-category">Kategori Produk</label>  
      <select class="form-select" name="category" id="category">
        <option value="">Pilih Kategori</option>
          @foreach ($categories as $cat)
            <option value="{{$cat->id}}">{{$cat->name}}</option>
          @endforeach
      </select>
    </div>
    <div class="mb-3 pb-2">
      <label class="form-label" for="unp-category">Subkategori Produk</label>  
      <select class="form-select" name="subcategory" id="subcategory">
        <option>Pilih Category Dahulu</option>
      </select>
    </div>
    <div class="mb-3 pb-2">
      <label class="form-label" for="unp-product-name">Judul Produk</label>
      <input class="form-control" name="title" type="text" placeholder="Judul" id="unp-product-name">
      <div class="form-text">Gunakan judul produk yang sesuai dengan produk yang akan dijual, agar memudahkan pencarian.</div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="row">
              <div class="col-mb-3 col-sm-6">
                  <div class="file-drop-area mb-3">
                      <div class="file-drop-icon ci-cloud-upload"></div>
                      <span class="file-drop-message">
                      Upload gambar produk kamu disini.
                      </span>
                      <input class="file-drop-input" name="files[]" type="file">
                      <button class="file-drop-btn btn btn-primary btn-sm mb-2" type="button">Or select file</button>
                      <div class="form-text">
                        Ukuran maksimal 2MB, dengan format JPEG, JPG, PNG dan GIF.
                      </div>
                  </div>
              </div>
              <div class="col-mb-3 col-sm-6">
                  <div class="file-drop-area mb-3">
                      <div class="file-drop-icon ci-cloud-upload"></div>
                      <span class="file-drop-message">
                      Upload gambar produk kamu disini.
                      </span>
                      <input class="file-drop-input" name="files[]" type="file">
                      <button class="file-drop-btn btn btn-primary btn-sm mb-2" type="button">Or select file</button>
                      <div class="form-text">
                        Ukuran maksimal 2MB, dengan format JPEG, JPG, PNG dan GIF.
                      </div>
                  </div>
              </div>
              <div class="col-mb-3 col-sm-6">
                  <div class="file-drop-area mb-3">
                      <div class="file-drop-icon ci-cloud-upload"></div>
                      <span class="file-drop-message">
                      Upload gambar produk kamu disini.
                      </span>
                      <input class="file-drop-input" name="files[]" type="file">
                      <button class="file-drop-btn btn btn-primary btn-sm mb-2" type="button">Or select file</button>
                      <div class="form-text">
                        Ukuran maksimal 2MB, dengan format JPEG, JPG, PNG dan GIF.
                      </div>
                  </div>
              </div>
              <div class="col-mb-3 col-sm-6">
                  <div class="file-drop-area mb-3">
                      <div class="file-drop-icon ci-cloud-upload"></div>
                      <span class="file-drop-message">
                      Upload gambar produk kamu disini.
                      </span>
                      <input class="file-drop-input" name="files[]" type="file">
                      <button class="file-drop-btn btn btn-primary btn-sm mb-2" type="button">Or select file</button>
                      <div class="form-text">
                        Ukuran maksimal 2MB, dengan format JPEG, JPG, PNG dan GIF.
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
    <div class="mb-3 py-2">
      <label class="form-label" for="unp-product-description">Deskripsi Produk</label>
      <textarea class="form-control" name="description" rows="6" id="unp-product-description"></textarea>
      @if(App\Models\Setting::first())
      <div class="bg-secondary p-3 fs-ms rounded-bottom">
        Demi keamanan kamu, dilarang memberikan kontak / link pribadi baik (email, telepon, id sosial media) di deskripsi, foto dagangan, foto profile, fitur pesan dan slogan karena tidak sesuai dengan aturan penggunaan {{App\Models\Setting::first()->name}}. Jika kamu tetap melakukannya maka akun kamu akan dinonaktifkan.
      </div>
      @else
      <div class="bg-secondary p-3 fs-ms rounded-bottom">
        Demi keamanan kamu, dilarang memberikan kontak / link pribadi baik (email, telepon, id sosial media) di deskripsi, foto dagangan, foto profile, fitur pesan dan slogan karena tidak sesuai dengan aturan penggunaan {{config('app.name')}}. Jika kamu tetap melakukannya maka akun kamu akan dinonaktifkan.
      </div>
      @endif
    </div>
    <div class="row">
      <div class="col-sm-12 mb-3">
        <label class="form-label" for="unp-standard-price">Harga Produk</label>
        <div class="input-group"><span class="input-group-text">Rp</span>
          <input class="form-control" name="price" type="text" placeholder="0" id="unp-standard-price">
        </div>
        @if(App\Models\Setting::first())
          <div class="form-text">Harga per 1 Produk. {{App\Models\Setting::first()->harga}}</div>
        @endif
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6 mb-3">
        <label class="form-label" for="unp-standard-price">Stok</label>
        <div class="input-group">
          <input class="form-control" name="stok" type="text" placeholder="0" id="unp-standard-price">
          <span class="input-group-text">Produk</span>
        </div>
        <div class="form-text">Stok produk yang kamu jual.</div>
      </div>
      
      <div class="col-sm-6 mb-3">
        <label class="form-label" for="unp-standard-price">Minimal Pembelian</label>
        <div class="input-group">
          <input class="form-control" name="min" type="text" placeholder="0" id="unp-standard-price">
          <span class="input-group-text">Produk</span>
        </div>
        <div class="form-text">Minimal pembelian produk yang kamu jual.</div>
      </div>
    </div>
    <button class="btn btn-primary d-block w-100" type="submit"><i class="ci-cloud-upload fs-lg me-2"></i>Tambah Produk</button>
  </form>
@endsection
@section('extra-js')
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="category"]').on('change', function() {
            var categoryID = $(this).val();
            var url = '{{route("category.subcategory",["category" =>":id"])}}';
            url = url.replace(':id', categoryID );
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
                $('select[name="subcategory"]').append('<option>Pilih Category Dahulu</option>');
                        
            }
        });
    });
</script>
@endsection