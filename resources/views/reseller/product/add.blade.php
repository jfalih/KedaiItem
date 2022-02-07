@extends('layouts.user')
@section('css')
@parent
<link rel="stylesheet" type="text/css" href="{{asset('assets_users/assets/css/dropzone.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets_users/assets/css/sweetalert2.css')}}">
@endsection
@section('content')
<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3>Tambah Product</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Tambah Product</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header pb-0">
            <h5>Tambah Product</h5>
            <span>Tambah product/item yang ingin kamu jual disini.</span>
          </div>
          <div class="card-body">
              <div id="alert"></div>
              <form id="form_order" class="row g-3 mb-3">
                <div class="col-md-12">
                  <div class="dropzone dz-clickable" id="image-upload">
                    <div class="dz-message needsclick"><i class="icon-cloud-up"></i>
                      <h6>Upload foto produk disini.</h6>
                      <span class="note needsclick">File tidak lebih dari 4 dan besar tidak lebih dari 2mb.</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="exampleFormControlSelect9">Category</label>
                    <select class="form-select digits" name="category">
                      <option>-- Pilih Category --</option>
                      @foreach($categories as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="exampleFormControlSelect9">Subcategory</label>
                    <select class="form-select digits" name="subcategory">
                      <option>-- Pilih Category Dahulu --</option>
                    </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label" >Nama Produk</label>
                  <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" required>
                  @error('title')
                  <div class="invalid-feedback">{{$message}}</div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label class="form-label" >Harga</label>
                  <input class="form-control @error('price') is-invalid @enderror" type="number" name="price" required>
                  @error('price')
                  <div class="invalid-feedback">{{$message}}</div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label class="form-label" >Stok</label>
                  <fieldset>
                    <div class="input-group">
                      <input class="touchspin" type="text" name="stok" value="0">
                    </div>
                  </fieldset>
                  @error('stok')
                  <div class="invalid-feedback">{{$message}}</div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label class="form-label" >Min</label>
                  <fieldset>
                    <div class="input-group">
                      <input class="touchspin" type="text" name="min" value="0">
                    </div>
                  </fieldset>
                  @error('min')
                  <div class="invalid-feedback">{{$message}}</div>
                  @enderror
                </div>
                <div class="col-md-12">
                  <label class="form-label">Deskripsi</label>
                  <textarea name="description" id="description" class="form-control"  rows="10" cols="50"></textarea>
                  @error('description')
                  <div class="invalid-feedback">{{$message}}</div>
                  @enderror
                </div>
              </form>
              <button id="submit" class="btn btn-primary">Tambah Product</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->
</div>   
@endsection
@section('js')
@parent
<script src="{{asset('assets_users/assets/js/touchspin/vendors.min.js')}}"></script>
<script src="{{asset('assets_users/assets/js/touchspin/touchspin.js')}}"></script>
<script src="{{asset('assets_users/assets/js/touchspin/input-groups.min.js')}}"></script>
<script src="{{asset('assets_users/assets/js/dropzone/dropzone.js')}}"></script>
<script src="{{asset('assets_users/assets/js/sweet-alert/sweetalert.min.js')}}"></script>
<script src="{{asset('assets_users/assets/js/editor/ckeditor/ckeditor.js')}}"></script>
<script>
   var konten = document.getElementById("description");
    CKEDITOR.replace(konten,{
      toolbar: [
        ['Bold', 'Italic', 'Underline', 'Strike', 'TextColor', '-', 'NumberedList', 'BulletedList']
      ],
     language:'en-gb'
   });
   CKEDITOR.config.allowedContent = true;
</script>
<script type="text/javascript">
  Dropzone.autoDiscover = false;
  $(document).ready(function () {
        $("#image-upload").dropzone({
          autoProcessQueue: false,
          uploadMultiple: true,
          parallelUploads: 100,
          maxFiles: 4,
          url: "{{route('reseller.product.store')}}",
           init: function() {
        var myDropzone = this;
        // First change the button to actually tell Dropzone to process the queue.
        $("#submit").click(function(e){
          e.preventDefault();
          e.stopPropagation();
          if (!myDropzone.files || !myDropzone.files.length) {
            $("#alert").html(`
            <div class="alert alert-danger dark alert-dismissible fade show mb-3" role="alert">
            <span>Silahkan upload gambar terlebih dahulu!</span>
            </div>
            `)
          } else {
            myDropzone.processQueue();
            swal({
              title:'Loading',
              text:'Loading adding item..',
              closeOnClickOutside: false,
              buttons:false
            });
          }

        })
        // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
        // of the sending event because uploadMultiple is set to true.
        this.on("sendingmultiple", function(file,xhr, formData) {
          formData.append("_token", "{{ csrf_token() }}");
          var category = $('select[name=category] option').filter(':selected').val();
          var subcategory = $('select[name=subcategory] option').filter(':selected').val();
          var description = CKEDITOR.instances.description.getData();
          $("form").find("input").each(function(){
              formData.append($(this).attr("name"), $(this).val());
          });
          formData.append("category", category);
          formData.append("description", description);
          formData.append("subcategory", subcategory);
        });
        this.on("successmultiple", function(files, response) {
          swal.close();
          console.log(response);
          if(response.success) {
            $('#form_order').trigger("reset");
            $("#alert").html(`
            <div class="alert alert-success dark alert-dismissible fade show mb-3" role="alert">
            <span>${response.message}</span>
            </div>
            `)
          } else {
            $("#alert").html(`
            <div class="alert alert-danger dark alert-dismissible fade show mb-3" role="alert">
            <span>${response.message}</span>
            </div>
            `)
          }
        });
        this.on("errormultiple", function(files, response) {
          console.log(response);
        });
        this.on("maxfilesexceeded", function(file){
          $("#alert").html(`
            <div class="alert alert-danger dark alert-dismissible fade show mb-3" role="alert">
            <span>Tidak bisa mengupload lebih dari 4 file</span>
            </div>
            `)
        });
         } 
        });
   })
</script>
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
                            $('select[name="subcategory"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
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