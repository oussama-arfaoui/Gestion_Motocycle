@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('carrier.index') }}">Carriers</a>
        <x-arrow-icon />
        <span>Edit Carrier</span>
    </div>

    {{-- Form for editing the carrier --}}
    <div class="dashboard-main-container-modules">

        <form action="{{ route('carrier.update', $carrier->id) }}" method="POST" class="node-form">
            @csrf
            @method('PUT')
            <div class="node-input">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $carrier->title }}" required>
            </div>

            <div class="node-input">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ $carrier->description }}</textarea>
            </div>

            <div class="node-input">
                <label for="requirements" class="form-label">Requirements</label>
                <textarea name="requirements" id="requirements" class="form-control" rows="4">{{ $carrier->requirements }}</textarea>
            </div>

            <div class="node-input">
                <label for="location" class="form-label">Location</label>
                <input type="text" name="location" id="location" class="form-control" value="{{ $carrier->location }}">
            </div>

            <div class="node-input">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="published" {{ $carrier->status == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ $carrier->status == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>

            <div class="node-input">
                <label for="time" class="form-label">Time</label>
                <input type="datetime-local" name="time" id="time" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($carrier->time)) }}">
            </div>

            <div class="node-input">
                <label for="category_id" class="form-label">Job Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">Select Category</option>
                    @foreach($jobcategories as $category)
                        <option value="{{ $category->id }}" {{ $carrier->jobCategory->id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="node-input">
                <label for="carrier_category_id" class="form-label">Carrier Category</label>
                <select name="carrier_category_id" id="carrier_category_id" class="form-control">
                    <option value="">Select Category</option>
                    @foreach($carriercategories as $category)
                        <option value="{{ $category->id }}" {{ $carrier->carrierCategory->id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="node-input">
                <label for="is_job_offer" class="form-label">Is Job Offer</label>
                <input type="checkbox" name="is_job_offer" id="is_job_offer" value="1" {{ $carrier->is_job_offer ? 'checked' : '' }}>
            </div>

            <button class="dashboard-main-button" type="submit">
                <x-save-icon />
                <span>Save</span>
            </button>

        </form>
    </div>
</div>

@endsection
