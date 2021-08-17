
    <div class="modal fade" id="upload-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-fullscreen" role="document">
          <form method="POST" enctype="multipart/form-data" action="{{route('galeri.addImage')}}" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">Upload Gambar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Drag and drop file upload -->
                <!-- Text input -->
                <div class="mb-3">
                    <label for="text-input" class="form-label">Caption Gambar</label>
                    <input class="form-control" name="caption" type="text" id="text-input" placeholder="Caption">
                </div>
                <div class="file-drop-area">
                    <div class="file-drop-icon ci-cloud-upload"></div>
                    <span class="file-drop-message">Drag and drop here to upload</span>
                    <input type="file" name="image" class="file-drop-input">
                    <button type="button" class="file-drop-btn btn btn-primary btn-sm">Or select file</button>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-primary" type="submit">
                    Upload gambar
                </button>
              </div>
            </form>
        </div>
    </div>