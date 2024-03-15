@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('services.index') }}">Services</a> <!-- Change route to services.index -->
    </div>

    {{-- Actions for the services table --}}
    <div class="dashboard-main-container-actions">
        {{-- Main Button --}}
        <a class="dashboard-main-button" href="{{ route('services.create') }}"> <!-- Change route to services.create -->
            <x-add-icon />
            <span>Create New Service</span>
        </a>
    </div>

    {{-- Table --}}
    <table class="dashboard-main-container-table">
        <thead>
            <tr>
                <th>Service Title</th>
                <th>Service Description</th>
                <th>Status</th>
                <th>Category</th>
                <th>Images</th>
                <th>Points</th>
                <th>Characteristics</th>
                <th>Attributes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
            <tr>
                <td>{{ $service->service_title }}</td>
                <td>{{ $service->service_description }}</td>
                <td>{{ $service->status }}</td>
                <td>{{ optional($service->category)->category_name ?? 'null' }}</td>
                    <!-- Check if images exist for the project -->
                    @if($service->images)
                        <!-- Decode the JSON array of images -->
                        @php
                        $imageArray = json_decode($service->images, true);
                        $firstImage = isset($imageArray[0]) ? $imageArray[0] : null;
                        @endphp

                        <!-- Check if the first image exists -->
                        @if($firstImage)
                            <!-- Display the first image -->
                            <td><img id="image-fucked" src="{{ asset('storage/Images/general/' . $firstImage) }}" alt="First Image"></td>
                        @else
                            <!-- Display a message if no image is available -->
                            <td>No image available</td>
                        @endif
                    @else
                        <!-- Display a message if no image is available -->
                        <td>No image available</td>
                    @endif


                <td>{{ $service->points }}</td>
                <td>{{ $service->characteristics }}</td>
                <td>{{ $service->attributes }}</td>
                <td class="dashboard_main-table-actions">
                    <a href="{{ route('services.show', $service->id) }}" target="_blank"> <!-- Change route to services.show -->
                        <button class="dashboard-icon-button action-view">
                            <x-eye-icon />
                        </button>
                    </a>
                    <a href="{{ route('services.edit', $service->id) }}"> <!-- Change route to services.edit -->
                        <button class="dashboard-icon-button action-edit">
                            <x-edit-icon />
                        </button>
                    </a>
                    <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="confirmDelete({{ $service->id }})"
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
    function confirmDelete(serviceId) {
        if (confirm('Are you sure you want to delete this service?')) {
            document.getElementById('deleteForm' + serviceId).submit();
        }
    }
</script>

@endsection
