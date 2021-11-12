@extends('layouts.user')
@section('content')
<div class="d-sm-flex flex-wrap justify-content-between align-items-center pb-2">
    <h2 class="h3 py-2 me-2 text-center text-sm-start">Ubah Produk {{$item->id}}</h2>
    <div class="py-2">
    </div>
  </div>
  <form method="POST" action="{{route('reseller.product.update',['item'=> $item])}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3 pb-2">
      <label class="form-label" for="unp-product-name">Judul Produk</label>
      <input class="form-control" value="{{$item->name}}" name="title" type="text" id="unp-product-name">
      <div class="form-text">Maximum 100 characters. No HTML or emoji allowed.</div>
    </div>
    <div class="mb-3 pb-2">
      <label class="form-label" for="unp-category">Kategori Produk</label>  
      <select class="form-select" name="category" id="category">
        <option>Pilih Kategori</option>
          @foreach ($categories as $cat)
            <option value="{{$cat->id}}">{{$cat->name}}</option>
          @endforeach
      </select>
    </div>
    <div class="mb-3 pb-2">
      <label class="form-label" for="unp-category">Subkategori Produk</label>  
      <select class="form-select" name="subcategory" id="subcategory">
        <option>Pilih Subkategori</option>
      </select>
    </div>
    <div class="row">
        <div class="col-12">
            <div id="list-img" class="row">
                @foreach ($item->images as $img)
                    <!-- Item -->
                    <div class="col-xl-4 col-sm-12">
                        <a href="{{url(Storage::url($img->name))}}" class="gallery-item" data-sub-html='<h6 class="fs-sm text-light">{{$img->caption}}</h6>'>
                        <img src="{{url(Storage::url($img->name))}}" alt="{{$img->caption}}">
                        <span class="gallery-item-caption">{{$img->caption}}</span>
                        </a>
                    </div>
                @endforeach
                <div class="col-12">
                    <button id="editButton" class="btn btn-warning d-block w-100" type="button"><i class="ci-edit fs-lg me-2"></i>Ubah gambar</button>
                </div>
            </div>
            <div id="list-upload" style="display:none" class="row">
                <div class="col-xl-4 col-sm-12">
                    <div class="file-drop-area mb-3">
                        <div class="file-drop-icon ci-cloud-upload"></div><span class="file-drop-message">Drag and drop here to upload product screenshot</span>
                        <input class="file-drop-input" name="files[]" type="file">
                        <button class="file-drop-btn btn btn-primary btn-sm mb-2" type="button">Or select file</button>
                        <div class="form-text">1000 x 800px ideal size for hi-res displays</div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-12">
                    <div class="file-drop-area mb-3">
                        <div class="file-drop-icon ci-cloud-upload"></div><span class="file-drop-message">Drag and drop here to upload product screenshot</span>
                        <input class="file-drop-input" name="files[]" type="file">
                        <button class="file-drop-btn btn btn-primary btn-sm mb-2" type="button">Or select file</button>
                        <div class="form-text">1000 x 800px ideal size for hi-res displays</div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-12">
                    <div class="file-drop-area mb-3">
                        <div class="file-drop-icon ci-cloud-upload"></div><span class="file-drop-message">Drag and drop here to upload product screenshot</span>
                        <input class="file-drop-input" name="files[]" type="file">
                        <button class="file-drop-btn btn btn-primary btn-sm mb-2" type="button">Or select file</button>
                        <div class="form-text">1000 x 800px ideal size for hi-res displays</div>
                    </div>
                </div>
                <div class="col-12">
                    <button id="cancelButton" class="btn btn-danger d-block w-100" type="button"><i class="ci-close fs-lg me-2"></i>Batal ubah gambar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3 py-2">
      <label class="form-label" for="unp-product-description">Deskripsi Produk</label>
      <textarea class="form-control" name="description" rows="6" id="unp-product-description">{{$item->description}}</textarea>
      <div class="bg-secondary p-3 fs-ms rounded-bottom"><span class="d-inline-block fw-medium me-2 my-1">Markdown supported:</span><em class="d-inline-block border-end pe-2 me-2 my-1">*Italic*</em><strong class="d-inline-block border-end pe-2 me-2 my-1">**Bold**</strong><span class="d-inline-block border-end pe-2 me-2 my-1">- List item</span><span class="d-inline-block border-end pe-2 me-2 my-1">##Heading##</span><span class="d-inline-block">--- Horizontal rule</span></div>
    </div>
    <div class="row">
      <div class="col-sm-12 mb-3">
        <label class="form-label" for="unp-standard-price">Harga Produk</label>
        <div class="input-group"><span class="input-group-text">Rp</span>
          <input class="form-control" value="{{$item->price}}" name="price" type="text" id="unp-standard-price">
        </div>
        <div class="form-text">Average marketplace price for this category is $15.</div>
      </div>
    </div>
    <button class="btn btn-primary d-block w-100" type="submit"><i class="ci-cloud-upload fs-lg me-2"></i>Ubah Produk</button>
  </form>
@endsection
@section('extra-js')
<script type="text/javascript">
    $(document).ready(function(){
        let editButton = document.getElementById("editButton");
        let cancelButton = document.getElementById("cancelButton");
        editButton.addEventListener("click", function(){
            document.getElementById("list-img").style.display = "none";        
            document.getElementById("list-upload").style.display = "flex";
        });
        cancelButton.addEventListener("click", function(){
            document.getElementById("list-img").style.display = "flex";        
            document.getElementById("list-upload").style.display = "none";
        });

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
    })
</script>
@endsection