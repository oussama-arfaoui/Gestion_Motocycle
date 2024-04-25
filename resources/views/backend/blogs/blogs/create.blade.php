@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('blogs.index') }}">Blogs</a>
        <x-arrow-icon />
        <span>Create New Blog</span>
    </div>

    {{-- Form for creating a new blog --}}
    <div class="dashboard-main-container-modules">

        <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data" class="node-form">
            @csrf
            <div class="node-input">
                <label for="category_id" class="form-label">Parent Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">Select Parent Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="node-input">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control">
            </div>

            <div class="node-input">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" id="content" class="form-control" rows="4"></textarea>
            </div>
                     
            <div class="node-input">
                <label for="images" class="form-label">Images</label>
                <input type="file" name="images[]" id="images" class="form-control" onchange="previewImage(event)" multiple>
                <img id="image-preview" src="#" alt="Preview Image" style="display: none; max-width: 200px; margin-top: 10px;">
            </div>                      

            <div class="node-input">
                <label for="views" class="form-label">Views</label>
                <input type="number" name="views" id="views" class="form-control">
            </div>

            <div class="node-input">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                    <option value="archived">Archived</option>
                </select>
            </div>

            <button class="dashboard-main-button" type="submit">
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
