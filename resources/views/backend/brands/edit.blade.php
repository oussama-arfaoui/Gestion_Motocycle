@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    <!-- Breadcrumbs -->
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('brands.index') }}">Brands</a>
        <x-arrow-icon />
        <span>Edit Brand</span>
    </div>

    <!-- Form -->
    <div class="dashboard-main-container-modules">
        <form class="node-form" action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Use PUT method for update -->

            <!-- Name Input -->
            <div class="node-input">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $brand->name }}" required autocomplete="off">
            </div>

            <!-- Link Input -->
            <div class="node-input">
                <label for="link">Link</label>
                <input type="text" name="link" class="form-control" id="link" value="{{ $brand->link }}">
            </div>

                <!-- Existing Images -->
                <div class="node-input">
                    <label>Existing Images</label>
                    @if ($brand->images)
                        @foreach(json_decode($brand->images) as $image)
                            <img src="{{ asset('storage/Images/general/' . $image) }}" alt="Brand Image">
                        @endforeach
                    @else
                        <p>No existing images</p>
                    @endif
                </div>


            <!-- Image Input for Adding More Images -->
            <div class="node-input">
                <label for="images">Add More Images</label>
                <input type="file" name="images[]" class="form-control" id="images" multiple>
            </div>

            <!-- Save Button -->
            <button type="submit" class="dashboard-main-button">
                <x-save-icon />
                <span>Update Brand</span>
            </button>
        </form>
    </div>
</div>
@endsection
