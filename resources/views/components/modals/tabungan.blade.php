
<div class="modal fade" id="tabungan" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
    <form method="POST"  enctype="multipart/form-data" action="{{route('tabungan.verif')}}" class="modal-content">
        @csrf
        <div class="modal-header">
            <h4 class="modal-title">Verifikasi Buku Tabungan</h4>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="col-sm-12">
                <div class="file-drop-area mb-3">
                    <div class="file-drop-icon ci-cloud-upload"></div>
                    <span class="file-drop-message">Drag and drop here to upload</span>
                    <input type="file" name="image" class="file-drop-input">
                    <button type="button" class="file-drop-btn btn btn-primary btn-sm">Or select file</button>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary btn-sm" type="button" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-primary btn-shadow btn-sm" type="submit">Upload</button>
        </div>
    </form>
</div>
</div>