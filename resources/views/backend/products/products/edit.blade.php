@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('products.index') }}">Products</a>
    </div>

    <div class="dashboard-main-container-modules">

        {{-- Form for editing a product --}}
        <form action="{{ route('product.update', $product->id) }}" method="POST"">
            @csrf
        @method('PUT')
        
        <div class=" node-input">
            <label for="id">ID: </label>
            <input type=" hidden" name="id" value="{{ $product->id }}">
    </div>

    <div class="node-input">
        <label for="product_name" class="form-label">Name</label>
        <input type="text" name="product_name" id="product_name" class="form-control"
            value="{{ $product->product_name }}">
    </div>

    <div class="node-input">
        <label for="product_description" class="form-label">Description</label>
        <input type="text" name="product_description" id="product_description" class="form-control"
            value="{{ $product->product_description }}">
    </div>


    <div class="node-input">
        <label for="status" class="form-label">Status</label>
        <input type="text" name="status" id="status" class="form-control" value="{{ $product->status }}">
    </div>

    <div class="node-input">
        <label for="template" class="form-label">Template</label>
        <input type="text" name="template" id="template" class="form-control" value="{{ $product->template }}">
    </div>

    <div class="node-input">
        <label for="seo_title" class="form-label">SEO Title</label>
        <input type="text" name="seo_title" id="seo_title" class="form-control" value="{{ $product->seo_title }}">
    </div>


    <div class="node-selector">
        <label for="categories" class="form-label">Categories</label>
        <select name="categories[]" id="categories" class="form-select">
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="dashboard-main-button">
        <x-save-icon />
        <span>Save</span>
    </button>

    </form>
</div>
</div>
@endsection