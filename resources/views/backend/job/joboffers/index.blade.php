@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <span>Job Offers</span>
    </div>

    {{-- Actions for the job offers table --}}
    <div class="dashboard-main-container-actions">
        {{-- Main Button --}}
        <a class="dashboard-main-button" href="{{ route('joboffer.create') }}">
            <x-add-icon />
            <span>Create New Job Offer</span>
        </a>
    </div>

    {{-- Table --}}
    <table class="dashboard-main-container-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Requirements</th>
                <th>Location</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobOffers as $jobOffer)
            <tr>
                <td>{{ $jobOffer->title }}</td>
                <td>{{ $jobOffer->description }}</td>
                <td>{{ $jobOffer->requirements }}</td>
                <td>{{ $jobOffer->location }}</td>
                <td>{{ $jobOffer->status }}</td>
                <td class="dashboard_main-table-actions">
                    <!-- Add button for viewing job offer details -->
                    <a href="{{ route('job-offers.show', $jobOffer->id) }}" target="_blank">
                        <button class="dashboard-icon-button action-view">
                            <x-eye-icon />
                        </button>
                    </a>
                    <a href="{{ route('job-offers.edit', $jobOffer->id) }}">
                        <button class="dashboard-icon-button action-edit">
                            <x-edit-icon />
                        </button>
                    </a>
                    <form action="{{ route('job-offers.destroy', $jobOffer->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="confirmDelete({{ $jobOffer->id }})"
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
    function confirmDelete(jobOfferId) {
        if (confirm('Are you sure you want to delete this job offer?')) {
            document.getElementById('deleteForm' + jobOfferId).submit();
        }
    }
</script>

@endsection
