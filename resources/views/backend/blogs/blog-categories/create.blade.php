@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('blogs-categories.index') }}">Blog Categories</a>
        <x-arrow-icon />
        <a href="{{ route('blogs-categories.create') }}">Create Blog Category</a>
    </div>

    {{-- Form for creating a new category --}}
    <div class="dashboard-main-container-modules">

        <form action="{{ route('blogs-categories.store') }}" method="POST" enctype="multipart/form-data"
            class="node-form">
            @csrf
            
            <div class="node-input">
                <label for="parent_id" class="form-label">Parent Category</label>
                <select name="parent_id" id="parent_id" class="form-control">
                    <option value="">Select Parent Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="node-input">
                <label for="category_name" class="form-label">Category Name</label>
                <input type="text" name="category_name" id="category_name" class="form-control" required maxlength="191">
            </div>
            
            
            <div class="node-input">
                <label for="description" class="form-label">Description</label>
                <input type="text" name="description" id="description" class="form-control">
            </div>
            
            <div class="node-file-input">
                <label for="images" class="form-label">Images</label>
                <input type="file" name="images[]" id="images" class="form-control" onchange="previewImage(event)" multiple>
                <img id="image-preview" src="#" alt="Preview Image" style="display: none; max-width: 200px; margin-top: 10px;">
            </div>            
            
            <div class="node-input">
                <label for="order" class="form-label">Order</label>
                <input type="number" name="order" id="order" class="form-control" value="0">
            </div>
            
            <div class="node-input">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                    <option value="archived">Archived</option>
                </select>
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
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('image-preview');
            output.src = reader.result;
            output.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection
