@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <span>Create New Carrier Category</span>
    </div>

    {{-- Form for creating a new carrier category --}}
    <div class="dashboard-main-container-modules">
        <form action="{{ route('carrier-categories.store') }}" method="POST">
            @csrf

            <div class="node-input">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="node-input">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4"></textarea>
            </div>

            <div class="node-input">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <button class="dashboard-main-button" type="submit">
                <x-save-icon />
                <span>Save</span>
            </button>
        </form>
    </div>
</div>
@endsection
