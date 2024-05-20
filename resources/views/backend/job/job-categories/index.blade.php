@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <span>Job Categories</span>
    </div>

    {{-- Actions for the job categories table --}}
    <div class="dashboard-main-container-actions">
        {{-- Main Button --}}
        <a class="dashboard-main-button" href="{{ route('job-categories.create') }}">
            <x-add-icon />
            <span>Create New Job Category</span>
        </a>
    </div>

    {{-- Table --}}
    <table class="dashboard-main-container-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobcategories as $jobCategory)
            <tr>
                <td>{{ $jobCategory->name }}</td>
                <td>{{ $jobCategory->description }}</td>
                <td>{{ $jobCategory->status }}</td>
                <td class="dashboard_main-table-actions">
                    <!-- Add button for viewing job category details -->
                    {{-- Commented out for now --}}
                    {{--
                    <a href="{{ route('job-categories.show', $jobCategory->id) }}" target="_blank">
                        <button class="dashboard-icon-button action-view">
                            <x-eye-icon />
                        </button>
                    </a>
                    --}}
                    <a href="{{ route('job-categories.edit', $jobCategory->id) }}">
                        <button class="dashboard-icon-button action-edit">
                            <x-edit-icon />
                        </button>
                    </a>
                    <form action="{{ route('job-categories.destroy', $jobCategory->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="confirmDelete({{ $jobCategory->id }})"
                            class="dashboard-icon-button action-delete">
                            <x-trash-icon />
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function confirmDelete(jobCategoryId) {
        if (confirm('Are you sure you want to delete this job category?')) {
            document.getElementById('deleteForm' + jobCategoryId).submit();
        }
    }
</script>

@endsection
