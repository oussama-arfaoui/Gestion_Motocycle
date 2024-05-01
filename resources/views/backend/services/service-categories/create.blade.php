@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('service-categories.index') }}">Service Categories</a>
        <x-arrow-icon />
        <a href="{{ route('service-categories.create') }}">Create new Service Category</a>
    </div>

    {{-- Form for creating a new service category --}}
    <div class="dashboard-main-container-modules">
        <form action="{{ route('service-categories.store') }}" method="POST" enctype="multipart/form-data"
            class="node-form">
            @csrf

            <div class="node-input">
                <label for="category_name" class="form-label">Category Name</label>
                <input type="text" name="category_name" id="category_name" class="form-control">
            </div>

            <div class="node-input">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <div class="node-input">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4"></textarea>
            </div>

            <button class="dashboard-main-button" type="submit">
                <x-save-icon />
                <span>Save</span>
            </button>
        </form>
    </div>
</div>
@endsection
