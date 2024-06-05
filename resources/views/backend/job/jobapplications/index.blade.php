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
                <th>CV</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobApplications as $application)
            <tr>
                <td>{{ $application->carrier->title }}</td>
                <td>{{ $application->name }}</td>
                <td>{{ $application->email }}</td>
                <td>{{ $application->phone }}</td>
                <td>{{ $application->message }}</td>
                <td>
                    <a href="{{ asset('storage/' . $application->cv) }}" target="_blank">
                        <div style="width: 100px; height: 100px; border: none;">
                            <iframe src="{{ asset('storage/' . $application->cv) }}" width="100" height="100" style="border: none;"></iframe>
                        </div>
                    </a>
                    <a href="{{ asset('storage/' . $application->cv) }}" download>
                        <button class="dashboard-icon-button action-download">
                            <x-eye-icon />
                        </button>
                    </a>                
                </td>                                        
                <td>{{ $application->status }}</td>
                <td class="dashboard_main-table-actions">

                    <form action="{{ route('jobapplication.destroy', $application->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="confirmDelete({{ $application->id }})"
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
    function confirmDelete(applicationId) {
        if (confirm('Are you sure you want to delete this application?')) {
            document.getElementById('deleteForm' + applicationId).submit();
        }
    }
</script>

@endsection
