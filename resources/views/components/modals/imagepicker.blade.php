
    <div class="modal fade" id="imagepicker-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <form method="POST" action="{{route('change_avatar')}}" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">Pilih Gambar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Drag and drop file upload -->
                <!-- Text input -->
                <div class="file-drop-area mb-3">
                    <div class="file-drop-icon ci-cloud-upload"></div>
                    <span class="file-drop-message">Drag and drop here to upload</span>
                    <input type="file" name="profile" class="file-drop-input">
                    <button type="button" class="file-drop-btn btn btn-primary btn-sm">Or select file</button>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal" type="submit">
                    Close
                </button>
                <button class="btn btn-primary btn-sm" type="submit">
                    Upload gambar
                </button>
              </div>
            </form>
        </div>
    </div>