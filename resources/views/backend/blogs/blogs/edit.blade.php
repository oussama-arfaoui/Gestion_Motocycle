@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('blogs.index') }}">Blogs</a>
        <x-arrow-icon />
        <span>Edit Blog</span>
    </div>

    {{-- Form for editing the blog --}}
    <div class="dashboard-main-container-modules">

        <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data" class="node-form">
            @csrf
            @method('PUT') <!-- Add this line to use PUT method for update -->
            <div class="node-input">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $blog->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="node-input">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $blog->title }}">
            </div>

            <div class="node-input">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" id="content" class="form-control" rows="4">{{ $blog->content }}</textarea>
            </div>
                     
            <!-- Images -->
            <div class="node-input" id="old-images-preview">
                <label for="images" class="form-label">Old Images</label>
                @foreach(json_decode($category->image) as $image)
                    <img src="{{ asset('storage/Images/general/' . $image) }}" alt="Old Project Image" style="max-width: 300px; margin-top: 10px;">
                @endforeach
            </div>
            
            <div class="node-input">
                <label for="new_images" class="form-label">New Images</label>
                <input type="file" name="new_images[]" id="new_images" class="form-control" onchange="previewImage(event)" multiple>
                <div id="new-images-preview" style="margin-top: 10px;"></div>
            </div>                     

            <div class="node-input">
                <label for="views" class="form-label">Views</label>
                <input type="number" name="views" id="views" class="form-control" value="{{ $blog->views }}">
            </div>

            <div class="node-input">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="published" {{ $blog->status == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ $blog->status == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="archived" {{ $blog->status == 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
            </div>

            <button class="dashboard-main-button" type="submit">
                <x-save-icon />
                <span>Update</span>
            </button>

        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        var oldImagesPreview = document.getElementById('old-images-preview');
        oldImagesPreview.style.display = 'none';

        var output = document.getElementById('new-images-preview');
        output.innerHTML = '';
        for (var i = 0; i < event.target.files.length; i++) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = document.createElement("img");
                img.src = e.target.result;
                img.style.maxWidth = '200px';
                img.style.marginTop = '10px';
                output.appendChild(img);
            }
            reader.readAsDataURL(event.target.files[i]);
        }
    }
</script>

@endsection
