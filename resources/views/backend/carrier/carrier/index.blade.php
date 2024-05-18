@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <span>Carriers</span>
    </div>

    {{-- Actions for the carriers table --}}
    <div class="dashboard-main-container-actions">
        {{-- Main Button --}}
        <a class="dashboard-main-button" href="{{ route('carrier.create') }}">
            <x-add-icon />
            <span>Create New Carrier</span>
        </a>
    </div>

    {{-- Table --}}
    <table class="dashboard-main-container-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Location</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carrier as $carrier)
            <tr>
                <td>{{ $carrier->title }}</td>
                <td>{{ $carrier->description }}</td>
                <td>{{ $carrier->location }}</td>
                <td>{{ $carrier->status }}</td>
                <td class="dashboard_main-table-actions">
                    <a href="{{ route('carriers.show', $carrier->id) }}" target="_blank">
                        <button class="dashboard-icon-button action-view">
                            <x-eye-icon />
                        </button>
                    </a>
                    <a href="{{ route('carriers.edit', $carrier->id) }}">
                        <button class="dashboard-icon-button action-edit">
                            <x-edit-icon />
                        </button>
                    </a>
                    <!-- Add your delete form for carrier here -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function confirmDelete(carrierId) {
        if (confirm('Are you sure you want to delete this carrier?')) {
            document.getElementById('deleteForm' + carrierId).submit();
        }
    }
</script>

@endsection
