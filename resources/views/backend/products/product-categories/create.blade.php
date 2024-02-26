@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('product-categories.index') }}">Product Categories</a>
    </div>

    {{-- Form for creating a new category --}}
    <form action="{{ route('product-categories.store') }}" method="POST" enctype="multipart/form-data" class="my-4 p-4 border border-gray-300 rounded-lg">
    @csrf
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="category_name" class="form-label">Category Name</label>
            <input type="text" name="category_name" id="category_name" class="form-control">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image">
        </div>
    </div>
    <div class="d-grid">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>


</div>
@endsection
