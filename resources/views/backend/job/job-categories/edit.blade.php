@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('job-categories.index') }}">Job Categories</a>
        <x-arrow-icon />
        <span>Edit Job Category</span>
    </div>

    {{-- Form for editing the job category --}}
    <div class="dashboard-main-container-modules">
        <form action="{{ route('job-categories.update', $jobcategory->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="node-input">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $jobcategory->name }}">
            </div>

            <div class="node-input">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ $jobcategory->description }}</textarea>
            </div>

            <div class="node-input">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="active" {{ $jobcategory->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $jobcategory->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <button class="dashboard-main-button" type="submit">
                <x-save-icon />
                <span>Save Changes</span>
            </button>
        </form>
    </div>
</div>
@endsection
