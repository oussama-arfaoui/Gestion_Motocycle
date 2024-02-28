@extends('backend.layouts.admin-dashboard')

@section('content')

<div class="dashboard-main-container">

    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('media.uploadForm') }}">Upload Image</a>
        <x-arrow-icon />
        <a href="#">Upload</a>
    </div>

    <div class="dashboard-main-container-actions">
        <a class="dashboard-main-button" href="{{ route('media.upload') }}">
            <x-save-icon />
            <span>Upload</span>
        </a>
    </div>

    <div class="dashboard-main-container-modules">
        <div class="row">
            @foreach ($fileNames as $fileName)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="image-container">
                    <a href="{{ asset('storage/Images/general/' . $fileName) }}" data-lightbox="image-gallery">
                    
                <img src="{{ asset('storage/Images/general/' . $fileName) }}" alt="{{ $fileName }}">
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>

@endsection
