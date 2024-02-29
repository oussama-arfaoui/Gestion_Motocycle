@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    <!-- Breadcrumbs -->
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('testimonials.index') }}">Testimonials</a>
        <x-arrow-icon />
        <span>Edit Testimonial</span>
    </div>

    <!-- Form -->
    <div class="dashboard-main-container-modules">
        <form class="node-form" action="{{ route('testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Image Input -->
            <div class="node-input">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control" id="image">
            </div>

            <!-- Name Input -->
            <div class="node-input">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $testimonial->name }}" required autocomplete="off">
            </div>

            <!-- Subtitle Input -->
            <div class="node-input">
                <label for="subtitle">Subtitle</label>
                <input type="text" name="subtitle" class="form-control" id="subtitle" value="{{ $testimonial->subtitle }}">
            </div>

            <!-- Job Description Input -->
            <div class="node-input">
                <label for="job_description">Job Description</label>
                <input type="text" name="job_description" class="form-control" id="job_description" value="{{ $testimonial->job_description }}">
            </div>

            <!-- Job Location Input -->
            <div class="node-input">
                <label for="job_location">Job Location</label>
                <input type="text" name="job_location" class="form-control" id="job_location" value="{{ $testimonial->job_location }}">
            </div>

            <!-- Testimonial Input -->
            <div class="node-input">
                <label for="testimonial">Testimonial</label>
                <textarea name="testimonial" class="form-control" id="testimonial" rows="5">{{ $testimonial->testimonial }}</textarea>
            </div>
            
            <!-- Save Button -->
            <button type="submit" class="dashboard-main-button">
                <x-save-icon />
                <span>Update Testimonial</span>
            </button>
        </form>
        
        
    </div>
</div>
@endsection
