@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('projects.index') }}">Projects</a>
        <x-arrow-icon />
        <a href="#">Edit Project</a>
    </div>

    <div class="dashboard-main-container-modules">

        {{-- Form for editing a project --}}
        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="node-input">
                <label for="id" class="form-label">ID:</label>
                <input type="text" name="id" id="id" class="form-control" value="{{ $project->id }}" disabled>
            </div>

            <div class="node-input">
                <label for="projects_title" class="form-label">Title</label>
                <input type="text" name="projects_title" id="projects_title" class="form-control"
                    value="{{ $project->projects_title }}">
            </div>

            <div class="node-input">
                <label for="projects_subtitle" class="form-label">Subtitle</label>
                <input type="text" name="projects_subtitle" id="projects_subtitle" class="form-control"
                    value="{{ $project->projects_subtitle }}">
            </div>

            <div class="node-input">
                <label for="projects_description" class="form-label">Description</label>
                <input type="text" name="projects_description" id="projects_description" class="form-control"
                    value="{{ $project->projects_description }}">
            </div>

            <div class="node-input">
                <label for="status" class="form-label">Status</label>
                <input type="text" name="status" id="status" class="form-control" value="{{ $project->status }}">
            </div>

            <div class="node-input">
                <label for="template" class="form-label">Template</label>
                <input type="text" name="template" id="template" class="form-control" value="{{ $project->template }}">
            </div>

            <div class="node-input">
                <label for="seo_title" class="form-label">SEO Title</label>
                <input type="text" name="seo_title" id="seo_title" class="form-control"
                    value="{{ $project->seo_title }}">
            </div>

            <div class="node-selector">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select">
                    @foreach($projectscategories as $projectscategory)
                    <option value="{{ $projectscategory->id }}" {{ $projectscategory->id == $project->category_id ? 'selected' : '' }}>
                        {{ $projectscategory->category_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Images -->
            <div class="node-input">
                <label for="images" class="form-label">Images</label>
                @foreach(json_decode($project->images) as $image)
                <img src="{{ asset('storage/Images/general/' . $image) }}" alt="Project Image">
                @endforeach
                <input type="file" name="images[]" id="images" class="form-control" multiple>
            </div>

            <!-- Points -->
            <div class="node-input">
                <label for="points" class="form-label">List of Points</label>
                <textarea name="points" id="points" class="form-control"
                    rows="4">{{ implode(PHP_EOL, json_decode($project->points)) }}</textarea>
            </div>

            <!-- Characteristics -->
            <div class="node-input">
                <label for="characteristics" class="form-label">Characteristics</label>
                <textarea name="characteristics" id="characteristics" class="form-control"
                    rows="4">{{ $project->characteristics }}</textarea>
            </div>

            <!-- Attributes -->
            <div class="node-input" id="attributeFields">
                <label for="attributes" class="form-label">Attributes</label>
                @foreach(json_decode($project->attributes) as $attribute => $value)
                <div class="attribute">
                    <input type="text" name="attributes[name][]" placeholder="Attribute Name" value="{{ $attribute }}"
                        class="form-control">
                    <input type="text" name="attributes[value][]" placeholder="Attribute Value" value="{{ $value }}"
                        class="form-control">
                </div>
                @endforeach
            </div>
            <button type="button" id="addAttribute" class="btn btn-primary mt-3">Add Attribute</button>

            <button type="submit" class="dashboard-main-button">
                <x-save-icon />
                <span>Save</span>
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
