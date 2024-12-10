@extends('layouts.template')
@section('content')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container">
    <div class="content flex-row-fluid" id="kt_content">
        <div class="content col-12 mt-n6" id="kt_content">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <h3>Upload dan Preview File</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('kop-upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">Upload File</label>
                            <input type="file" class="form-control" id="file" name="file" onchange="previewFile(event)">
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Upload</button>
                    </form>

                    @if($file ?? '')
                    <div class="form-group mt-3">
                        <label>File yang diunggah:</label>
                        <div id="filePreview" class="border p-3 text-center">
                            <img id="imagePreview" src="{{ asset($file ?? '') }}" alt="Preview Image"
                                style="max-width: 100%; height: auto;">
                            <div class="text-center">

                                <a href="{{ asset($file ?? '') }}" download class="btn btn-secondary mt-2">Download
                                    File</a>

                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    function previewFile(event) {
        const file = event.target.files[0];
        const fileInfo = document.getElementById('fileInfo');
        const imagePreview = document.getElementById('imagePreview');

        if (file) {
            fileInfo.textContent = `File: ${file.name}`;
            
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.style.display = 'none';
            }
        } else {
            fileInfo.textContent = 'Belum ada file yang diunggah';
            imagePreview.style.display = 'none';
        }
    }
</script>