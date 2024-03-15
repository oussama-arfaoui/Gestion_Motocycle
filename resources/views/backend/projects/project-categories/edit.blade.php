@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('projects-categories.index') }}">Project Categories</a>
        <x-arrow-icon />
        <a href="#">Edit Project Category</a>
    </div>

    {{-- Form for editing the category --}}
    <div class="dashboard-main-container-modules">
        <form action="{{ route('projects-categories.update', $projectscategories->id) }}" method="POST"
            enctype="multipart/form-data" class="node-form">
            @csrf
            @method('PUT')

            <div class="node-input">
                <label for="category_name" class="form-label">Category Name</label>
                <input type="text" name="category_name" id="category_name" class="form-control"
                    value="{{ $projectscategories->category_name }}">
            </div>

            <div class="node-input">
                <label for="description" class="form-label">Description</label>
                <input type="text" name="description" id="description" class="form-control"
                    value="{{ $projectscategories->description }}">
            </div>

            <div class="node-input">
                <label for="image" class="form-label">Current Image</label>
                <img src="{{ asset('storage/images/general/' . $projectscategories->image) }}" alt="Current Image">
            </div>
            
            <div class="node-input">
                <label for="image" class="form-label">New Image (Optional)</label>
                <input type="file" name="image" id="image">
            </div>
            

            <button type="submit" class="dashboard-main-button">
                <x-save-icon />
                <span>Update</span>
            </button>

        </form>
    </div>

</div>
@endsection
