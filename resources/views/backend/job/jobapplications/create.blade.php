@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('jobapplication.index') }}">Job Applications</a>
        <x-arrow-icon />
        <span>Create Job Application</span>
    </div>

    {{-- Form for creating a new job application --}}
    <div class="dashboard-main-container-modules">
        <form action="{{ route('jobapplication.store') }}" method="POST" enctype="multipart/form-data"
            class="node-form">
            @csrf
            <div class="node-input">
                <label for="career_id" class="form-label">Select Carrier</label>
                <select name="career_id" id="career_id" class="form-control" required>
                    <option value="">Select Carrier</option>
                    @foreach($carriers as $carrier)
                        <option value="{{ $carrier->id }}">{{ $carrier->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="node-input">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="node-input">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="node-input">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" required>
            </div>
            <div class="node-input">
                <label for="cv" class="form-label">CV (PDF only)</label>
                <input type="file" name="cv" id="cv" class="form-control" accept=".pdf" required>
            </div>
            <div class="node-input">
                <label for="message" class="form-label">Message</label>
                <textarea name="message" id="message" class="form-control"></textarea>
            </div>
            <div class="node-input">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                </select>
            </div>
            <button type="submit" class="dashboard-main-button">
                <x-save-icon />
                <span>Submit</span>
            </button>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('image-preview');
            output.src = reader.result;
            output.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection
