@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <span>Job Applications</span>
    </div>

    {{-- Table --}}
    <table class="dashboard-main-container-table">
        <thead>
            <tr>
                <th>Career</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobApplications as $application)
            <tr>
                <td>{{ $application->career->title }}</td>
                <td>{{ $application->name }}</td>
                <td>{{ $application->email }}</td>
                <td>{{ $application->phone }}</td>
                <td>{{ $application->message }}</td>
                <td>{{ $application->status }}</td>
                <td class="dashboard_main-table-actions">
                    <a href="{{ route('job-applications.show', $application->id) }}" target="_blank">
                        <button class="dashboard-icon-button action-view">
                            <x-eye-icon />
                        </button>
                    </a>
                    <a href="{{ route('job-applications.edit', $application->id) }}">
                        <button class="dashboard-icon-button action-edit">
                            <x-edit-icon />
                        </button>
                    </a>
                    <!-- Add your delete form for application here -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function confirmDelete(applicationId) {
        if (confirm('Are you sure you want to delete this application?')) {
            document.getElementById('deleteForm' + applicationId).submit();
        }
    }
</script>

@endsection
