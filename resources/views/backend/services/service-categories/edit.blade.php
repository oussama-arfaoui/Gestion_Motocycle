@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <span>Edit Service Category</span>
    </div>

    {{-- Form for editing the service category --}}
    <div class="dashboard-main-container-modules">
        <form action="{{ route('service-categories.update', $category->id) }}" method="POST"
            enctype="multipart/form-data" class="node-form">
            @csrf
            @method('PUT')

            <div class="node-input">
                <label for="category_name" class="form-label">Category Name</label>
                <input type="text" name="category_name" id="category_name" class="form-control"
                    value="{{ $category->category_name }}">
            </div>


            <div class="node-input">
                <label for="image" class="form-label">Current Image</label>
                <img src="{{ asset('storage/images/general/' . $category->image) }}" alt="Current Image">
            </div>
            
            <div class="node-input">
                <label for="image" class="form-label">New Image (Optional)</label>
                <input type="file" name="image" id="image">
            </div>
            <div class="node-input">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control"
                    rows="4">{{ $category->description }}</textarea>
            </div>

            <button class="dashboard-main-button" type="submit">
                <x-save-icon />
                <span>Save Changes</span>
            </button>
        </form>
    </div>
</div>
@endsection
