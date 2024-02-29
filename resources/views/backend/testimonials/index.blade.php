@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">

    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('testimonials.index') }}">Testimonials</a>
    </div>

    {{-- Actions for the testimonials table --}}
    <div class="dashboard-main-container-actions">

        {{-- Main Button --}}
        <a class="dashboard-main-button" href="{{ route('testimonials.create') }}">
            <x-add-icon />
            <span>Create New Testimonial</span>
        </a>
    </div>

    {{-- Table --}}
    <table class="dashboard-main-container-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Subtitle</th>
                <th>Job Description</th>
                <th>Image</th>
                <th>Testimonial</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($testimonials as $testimonial)
            <tr>
                <td>{{ $testimonial->name }}</td>
                <td>{{ $testimonial->subtitle }}</td>
                <td>{{ $testimonial->job_description }}</td>
                <td>
                    @if($testimonial->image)
                    <img src="{{ asset('storage/Images/general/' . $testimonial->image) }}" alt="Testimonial Image">
                    @else
                        <p>No image available</p>
                    @endif
    
                </td>

                <td>{{ $testimonial->testimonial }}</td>
                <td class="dashboard_main-table-actions">
                    <a href="{{ route('testimonials.edit', $testimonial->id) }}">
                        <button class="dashboard-icon-button action-edit">
                            <x-edit-icon />
                        </button>
                    </a>
                    <form id="deleteForm{{ $testimonial->id }}" action="{{ route('testimonials.destroy', $testimonial->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="confirmDelete({{ $testimonial->id }})" class="dashboard-icon-button action-delete">
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
    function confirmDelete(testimonialId) {
        if (confirm('Are you sure you want to delete this testimonial?')) {
            document.getElementById('deleteForm' + testimonialId).submit();
        }
    }
</script>

@endsection
