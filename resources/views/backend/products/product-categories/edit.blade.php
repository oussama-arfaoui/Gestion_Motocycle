@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('product-categories.index') }}">Product Categories</a>
        <x-arrow-icon />
        <span>Edit Category</span>
    </div>

    {{-- Form for editing the category --}}
    <form action="{{ route('product-categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="my-4 p-4 border border-gray-300 rounded-lg">
        @csrf
        @method('PUT') {{-- Use PUT method for updating --}}
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="category_name" class="form-label">Category Name</label>
                <input type="text" name="category_name" id="category_name" class="form-control" value="{{ $category->category_name }}">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image">
            </div>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection
