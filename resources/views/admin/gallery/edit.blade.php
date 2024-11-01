@extends('layoutadmin.main')

@section('content')
    <div class="container">
        <h1>Edit Gallery</h1>

        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="image">Gambar</label><br>
                        <input type="file" class="form-control-file" id="image" name="image" onchange="previewImage(event)">
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div><br>
                    <button type="submit" class="btn btn-primary">Update Gallery</button>
                </form>
            </div>
            <div class="col-md-6">
                <h4>Preview Gambar</h4>
                <div id="previewContainer" class="preview-container">
                    <img 
                        id="imagePreview" 
                        src="{{ asset('images/gallery/' . $gallery->image) }}" 
                        alt="Preview Gambar" 
                        style="display: block; width: 100%; max-width: 300px;"
                    >
                </div>
            </div>
        </div>
    </div>

    <style>
        .preview-container {
            width: 100%;
            max-width: 300px;
            height: 300px;
            background-color: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px dashed #ccc;
            position: relative;
        }
        .preview-container::before {
            content: "\f03e";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            font-size: 48px;
            color: #999;
            position: absolute;
            display: none;
        }
    </style>

    <script>
        function previewImage(event) {
            var image = document.getElementById('imagePreview');
            var previewContainer = document.getElementById('previewContainer');

            image.src = URL.createObjectURL(event.target.files[0]);
            image.style.display = 'block';
            previewContainer.style.backgroundColor = 'transparent';
            previewContainer.style.border = 'none';
        }
    </script>
@endsection
