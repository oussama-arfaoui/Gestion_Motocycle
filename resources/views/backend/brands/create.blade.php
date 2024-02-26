@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    <!-- Breadcrumbs -->
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('brands.index') }}">Brands</a>
        <x-arrow-icon />
        <span>Create Brand</span>
    </div>

    <!-- Form -->
    <div class="dashboard-main-container-modules">
        <form class="node-form" action="{{ route('brands.store') }}" method="POST">
            @csrf

            <!-- Name Input -->
            <div class="node-input">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" required autocomplete="off">
            </div>
        
            <!-- Link Input -->
            <div class="node-input">
                <label for="link">Link</label>
                <input type="text" name="link" class="form-control" id="link">
            </div>
        
          
            <!-- Image Input -->
            <div class="node-input">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control" id="image">
            </div>


            <!-- Save Button -->
            <button type="submit" class="dashboard-main-button">
                <x-save-icon />
                <span>Save Brand</span>
            </button>
        </form>
    </div>
</div>
@endsection
