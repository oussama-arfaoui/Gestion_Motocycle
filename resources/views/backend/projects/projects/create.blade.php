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

    {{-- Form for creating a new project --}}
    <div class="dashboard-main-container-modules">

        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" class="node-form">
            @csrf


            <div class="node-input">
                <label for="projects_title" class="form-label">Title</label>
                <input type="text" name="projects_title" id="projects_title" class="form-control">
            </div>
            <div class="node-input">
                <label for="projects_subtitle" class="form-label">Subtitle</label>
                <input type="text" name="projects_subtitle" id="projects_subtitle" class="form-control">
            </div>
            <div class="node-input">
                <label for="projects_description" class="form-label">Description</label>
                <input type="text" name="projects_description" id="projects_description" class="form-control">
            </div>


            <div class="node-input">
                <label for="status" class="form-label">Status</label>
                <input type="text" name="status" id="status" class="form-control">
            </div>
            <div class="node-input">
                <label for="template" class="form-label">Template</label>
                <input type="text" name="template" id="template" class="form-control">
            </div>


            <div class="node-input">
                <label for="seo_title" class="form-label">SEO Title</label>
                <input type="text" name="seo_title" id="seo_title" class="form-control">
            </div>


            <div class="node-input">
                <label for="images" class="form-label">Images</label>
                <input type="file" name="images[]" id="images" class="form-control" multiple>
            </div>

            <div class="node-input">
                <label for="points" class="form-label">List of Points</label>
                <textarea name="points" id="points" class="form-control" rows="4"></textarea>
            </div>
                       
            <div class="node-input">
                <label for="characteristics" class="form-label">Characteristics</label>
                <textarea name="characteristics" id="characteristics" class="form-control"></textarea>
            </div>
            
            <div class="node-input" id="attributeFields">
                <label for="attributes" class="form-label">Attributes</label>
                <div class="attribute">
                    <input type="text" name="attributes[name][]" placeholder="Attribute Name" class="form-control">
                    <input type="text" name="attributes[value][]" placeholder="Attribute Value" class="form-control">
                </div>
            </div>
            <button type="button" id="addAttribute" class="btn btn-primary mt-3">Add Attribute</button>

            <div class="node-selector">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select">
                    @foreach($projectscategories as $projectscategory)
                    <option value="{{ $projectscategory->id }}">{{ $projectscategory->category_name }}</option>
                    @endforeach
                </select>
            </div>

            <button class="dashboard-main-button" type="submit">
                <x-save-icon />
                <span>
                    Save
                </span>
            </button>

        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('addAttribute').addEventListener('click', function() {
            var attributeField = document.createElement('div');
            attributeField.classList.add('attribute');
            attributeField.innerHTML = `
                <input type="text" name="attributes[name][]" placeholder="Attribute Name" class="form-control">
                <input type="text" name="attributes[value][]" placeholder="Attribute Value" class="form-control">
                <button type="button" class="btn btn-danger removeAttribute">Remove</button>
            `;
            document.getElementById('attributeFields').appendChild(attributeField);
        });

        document.getElementById('attributeFields').addEventListener('click', function(e) {
            if (e.target.classList.contains('removeAttribute')) {
                e.target.parentElement.remove();
            }
        });
    });
</script>
@endsection
