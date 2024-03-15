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

    {{-- Form for creating a new service --}}
    <div class="dashboard-main-container-modules">

        <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data" class="node-form">
            @csrf

            <div class="node-input">
                <label for="service_title" class="form-label">Title</label>
                <input type="text" name="service_title" id="service_title" class="form-control">
            </div>
            <div class="node-input">
                <label for="service_subtitle" class="form-label">Subtitle</label>
                <input type="text" name="service_subtitle" id="service_subtitle" class="form-control">
            </div>
            <div class="node-input">
                <label for="service_description" class="form-label">Description</label>
                <input type="text" name="service_description" id="service_description" class="form-control">
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
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select">
                    @foreach($servicecategories as $servicecategory)
                    <option value="{{ $servicecategory->id }}">{{ $servicecategory->category_name }}</option>
                    @endforeach
                </select>
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
