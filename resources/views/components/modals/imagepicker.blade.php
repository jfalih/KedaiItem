
    <div class="modal fade" id="imagepicker-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-fullscreen" role="document">
          <form method="POST" enctype="multipart/form-data" action="{{route('galeri.addImage')}}" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">Pilih Gambar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Drag and drop file upload -->
                <!-- Text input -->
                <div class="row">
                    
                    <div class="col-sm-3">
                        <div class="mb-3">
                            <label for="text-input" class="form-label">Caption Gambar</label>
                            <input class="form-control" name="caption" type="text" id="text-input" placeholder="Caption">
                        </div>
                        <div class="file-drop-area mb-3">
                            <div class="file-drop-icon ci-cloud-upload"></div>
                            <span class="file-drop-message">Drag and drop here to upload</span>
                            <input type="file" name="image" class="file-drop-input">
                            <button type="button" class="file-drop-btn btn btn-primary btn-sm">Or select file</button>
                        </div>
                        <button class="btn btn-primary d-block">Upload Gambar</button>
                    </div>
                    <div class="col-sm-9">
                        <div class="row">    
                            @foreach (Auth::user()->images as $id => $image)
                            <div class="col-sm-3">        
                                <label for="{{$id}}" style="cursor: pointer" class="card gallery">
                                    <a data-sub-html='<h6 class="fs-sm text-light">Gallery image caption</h6>'>
                                    <img style="object-fit: cover; width:300px; height:200px;" src="{{Storage::url($image->name)}}" alt="{{$image->caption}}">
                                    </a>
                                    <div class="card-body">                                        
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="{{$id}}" name="radio">
                                            <label class="form-check-label" for="{{$id}}">{{$image->caption}}</label>
                                        </div>

                                    </div>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-primary" type="submit">
                    Pilih gambar
                </button>
              </div>
            </form>
        </div>
    </div>