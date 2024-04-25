@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('blogs-categories.index') }}">Blog Categories</a>
        <x-arrow-icon />
        <span>Edit Blog categories</span>
    </div>

    {{-- Form for editing the categories --}}
    <div class="dashboard-main-container-modules">
        <form action="{{ route('blogs-categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="node-form">
            @csrf
            @method('PUT')

            <div class="node-input">
                <label for="parent_id" class="form-label">Parent categories</label>
                <select name="parent_id" id="parent_id" class="form-control">
                    <option value="">Select Parent categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $cat->id == $category->parent_id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="node-input">
                <label for="category_name" class="form-label">Category Name</label>
                <input type="text" name="category_name" id="category_name" class="form-control" value="{{ $category->name }}" required maxlength="191">
            </div>

            <div class="node-input">
                <label for="description" class="form-label">Description</label>
                <input type="text" name="description" id="description" class="form-control" value="{{ $category->description }}">
            </div>

            <div class="node-input">
                <label for="order" class="form-label">Order</label>
                <input type="number" name="order" id="order" class="form-control" value="{{ $category->order }}">
            </div>

            <div class="node-input">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="published" {{ $category->status == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ $category->status == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="archived" {{ $category->status == 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
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
            
            <button type="submit" class="dashboard-main-button">
                <x-save-icon />
                <span>Save</span>
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
