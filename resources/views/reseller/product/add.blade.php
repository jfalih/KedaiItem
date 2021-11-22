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
      <input class="form-control" name="title" type="text" id="unp-product-name">
      <div class="form-text">Maximum 100 characters. No HTML or emoji allowed.</div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="row">
              <div class="col-4">
                  <div class="file-drop-area mb-3">
                      <div class="file-drop-icon ci-cloud-upload"></div><span class="file-drop-message">Drag and drop here to upload product screenshot</span>
                      <input class="file-drop-input" name="files[]" type="file">
                      <button class="file-drop-btn btn btn-primary btn-sm mb-2" type="button">Or select file</button>
                      <div class="form-text">1000 x 800px ideal size for hi-res displays</div>
                  </div>
              </div>
              <div class="col-4">
                  <div class="file-drop-area mb-3">
                      <div class="file-drop-icon ci-cloud-upload"></div><span class="file-drop-message">Drag and drop here to upload product screenshot</span>
                      <input class="file-drop-input" name="files[]" type="file">
                      <button class="file-drop-btn btn btn-primary btn-sm mb-2" type="button">Or select file</button>
                      <div class="form-text">1000 x 800px ideal size for hi-res displays</div>
                  </div>
              </div>
              <div class="col-4">
                  <div class="file-drop-area mb-3">
                      <div class="file-drop-icon ci-cloud-upload"></div><span class="file-drop-message">Drag and drop here to upload product screenshot</span>
                      <input class="file-drop-input" name="files[]" type="file">
                      <button class="file-drop-btn btn btn-primary btn-sm mb-2" type="button">Or select file</button>
                      <div class="form-text">1000 x 800px ideal size for hi-res displays</div>
                  </div>
              </div>
            </div>
        </div>
    </div>
    <div class="mb-3 py-2">
      <label class="form-label" for="unp-product-description">Deskripsi Produk</label>
      <textarea class="form-control" name="description" rows="6" id="unp-product-description"></textarea>
      <div class="bg-secondary p-3 fs-ms rounded-bottom"><span class="d-inline-block fw-medium me-2 my-1">Markdown supported:</span><em class="d-inline-block border-end pe-2 me-2 my-1">*Italic*</em><strong class="d-inline-block border-end pe-2 me-2 my-1">**Bold**</strong><span class="d-inline-block border-end pe-2 me-2 my-1">- List item</span><span class="d-inline-block border-end pe-2 me-2 my-1">##Heading##</span><span class="d-inline-block">--- Horizontal rule</span></div>
    </div>
    <div class="row">
      <div class="col-sm-12 mb-3">
        <label class="form-label" for="unp-standard-price">Harga Produk</label>
        <div class="input-group"><span class="input-group-text">Rp</span>
          <input class="form-control" name="price" type="text" id="unp-standard-price">
        </div>
        <div class="form-text">Average marketplace price for this category is $15.</div>
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