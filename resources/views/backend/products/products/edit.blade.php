@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('products.index') }}">Products</a>
    </div>

    {{-- Form for editing a product --}}
    <form action="{{ route('product.update', $product->id) }}" method="POST" class="my-4 p-4 border border-gray-300 rounded-lg">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $product->id }}">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="product_name" class="form-label">Name</label>
                <input type="text" name="product_name" id="product_name" class="form-control" value="{{ $product->product_name }}">
            </div>
            <div class="col-md-6">
                <label for="product_description" class="form-label">Description</label>
                <input type="text" name="product_description" id="product_description" class="form-control" value="{{ $product->product_description }}">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="status" class="form-label">Status</label>
                <input type="text" name="status" id="status" class="form-control" value="{{ $product->status }}">
            </div>
            <div class="col-md-6">
                <label for="template" class="form-label">Template</label>
                <input type="text" name="template" id="template" class="form-control" value="{{ $product->template }}">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="seo_title" class="form-label">SEO Title</label>
                <input type="text" name="seo_title" id="seo_title" class="form-control" value="{{ $product->seo_title }}">
            </div>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
@endsection
