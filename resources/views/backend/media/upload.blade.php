@extends('backend.layouts.admin-dashboard')

@section('content')

<div class="dashboard-main-container">

    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('media.index') }}">Media</a>
        <x-arrow-icon />
        <a href="#">Upload</a>
    </div>

    <div class="dashboard-main-container-modules">
        <form action="{{ route('media.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="node-input">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" accept="image/*" required>
            </div>

            <button type="submit" class="dashboard-main-button">
                <x-save-icon />
                <span>Upload</span>
            </button>
        </form>
    </div>

</div>

@endsection
