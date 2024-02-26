@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('products.index') }}">Products</a>
    </div>

    {{-- Actions for the products table --}}
    <div class="dashboard-main-container-actions">
        {{-- Main Button --}}
        <a class="dashboard-main-button" href="{{ route('products.create') }}">
            <x-add-icon />
            <span>Create New Product</span>
        </a>
    </div>

    {{-- Form for creating a new product --}}
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="my-4 p-4 border border-gray-300 rounded-lg">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="product_name" class="form-label">Name</label>
                <input type="text" name="product_name" id="product_name" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="product_description" class="form-label">Description</label>
                <input type="text" name="product_description" id="product_description" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="status" class="form-label">Status</label>
                <input type="text" name="status" id="status" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="template" class="form-label">Template</label>
                <input type="text" name="template" id="template" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="seo_title" class="form-label">SEO Title</label>
                <input type="text" name="seo_title" id="seo_title" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="images" class="form-label">Images</label>
                <input type="file" name="images[]" id="images" class="form-control" multiple>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="categories" class="form-label">Categories</label>
                <select name="categories[]" id="categories" class="form-select" multiple>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
@endsection
