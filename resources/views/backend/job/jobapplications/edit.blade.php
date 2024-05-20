@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('jobapplication.index') }}">Job Applications</a>
        <x-arrow-icon />
        <span>Edit Job Application</span>
    </div>

    {{-- Form for editing an existing job application --}}
    <div class="dashboard-main-container-modules">
        <form action="{{ route('jobapplication.update', $jobApplication->id) }}" method="POST" enctype="multipart/form-data"
            class="node-form">
            @csrf
            @method('PUT')
            <div class="node-input">
                <label for="career_id" class="form-label">Select Career</label>
                <select name="career_id" id="career_id" class="form-control" required>
                    <option value="">Select Career</option>
                    @foreach($carriers as $career)
                        <option value="{{ $career->id }}" {{ $career->id == $jobApplication->career_id ? 'selected' : '' }}>
                            {{ $career->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="node-input">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $jobApplication->name }}" required>
            </div>
            <div class="node-input">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $jobApplication->email }}" required>
            </div>
            <div class="node-input">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ $jobApplication->phone }}" required>
            </div>
            <div class="node-input">
                <label for="cv" class="form-label">CV (PDF only)</label>
                <input type="file" name="cv" id="cv" class="form-control" accept=".pdf">
                @if($jobApplication->cv)
                    <iframe src="{{ asset('storage/' . $jobApplication->cv) }}" style="width: 100px; height: 100px;" frameborder="0"></iframe>
                @endif
            </div>
            <div class="node-input">
                <label for="message" class="form-label">Message</label>
                <textarea name="message" id="message" class="form-control">{{ $jobApplication->message }}</textarea>
            </div>
            <div class="node-input">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="pending" {{ $jobApplication->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="reviewed" {{ $jobApplication->status == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                </select>
            </div>
            <button type="submit" class="dashboard-main-button">
                <x-save-icon />
                <span>Update</span>
            </button>
        </form>
    </div>
</div>
@endsection
