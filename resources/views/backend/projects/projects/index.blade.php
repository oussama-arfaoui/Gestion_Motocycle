@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('projects.index') }}">Projects</a> <!-- Change route to projects.index -->
    </div>

    {{-- Actions for the projects table --}}
    <div class="dashboard-main-container-actions">
        {{-- Main Button --}}
        <a class="dashboard-main-button" href="{{ route('projects.create') }}"> <!-- Change route to projects.create -->
            <x-add-icon />
            <span>Create New Project</span>
        </a>
    </div>

    {{-- Table --}}
    <table class="dashboard-main-container-table">
        <thead>
            <tr>
                <th>Project Image</th> <!-- Change to Project Image -->
                <th>Project Title</th> <!-- Change to Project Title -->
                <th>Project Subtitle</th> <!-- Add Project Subtitle -->
                <th>Project Description</th> <!-- Add Project Description -->
                <th>Status</th>
                <th>Template</th>
                <th>SEO Title</th>
                <th>Categories</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project) <!-- Change $products to $projects -->
            <tr>
                @if($project->images)

                <!--hadi dyales image-->
                @php
                $imageArray = json_decode($project->images, true);
                $firstImage = isset($imageArray[0]) ? $imageArray[0] : null;
                @endphp

                @if($firstImage)
                <td><img id="image-fucked" src="{{ asset('storage/Images/general/' . $firstImage) }}" alt="First Image"></td>
                @else
                <td>No image available</td>
                @endif
                @else
                <td>No image available</td>
                @endif
                <!--hadi dyales image-->

                <td>{{ $project->projects_title }}</td> <!-- Change to projects_title -->
                <td>{{ $project->projects_subtitle }}</td> <!-- Add projects_subtitle -->
                <td>{{ $project->projects_description }}</td> <!-- Add projects_description -->
                <td>{{ $project->status }}</td>
                <td>{{ $project->template }}</td>
                <td>{{ $project->seo_title }}</td>
                <td>{{ optional($project->projectscategory)->category_name ?? 'null' }}</td>
                </td>
                <td class="dashboard_main-table-actions">
                        <!-- Add button for viewing project details -->
                    <a href="{{ route('projects.show', $project->id) }}" target="_blank"> <!-- Change route to projects.show -->
                        <button class="dashboard-icon-button action-view">
                            <x-eye-icon />
                        </button>
                    </a>
                    <a href="{{ route('projects.edit', $project->id) }}"> <!-- Change route to projects.edit -->
                        <button class="dashboard-icon-button action-edit">
                            <x-edit-icon />
                        </button>
                    </a>
                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="confirmDelete({{ $project->id }})"
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
    function confirmDelete(projectId) {
        if (confirm('Are you sure you want to delete this project?')) {
            document.getElementById('deleteForm' + projectId).submit();
        }
    }
</script>

@endsection
