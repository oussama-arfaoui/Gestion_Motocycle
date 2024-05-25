@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">
    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('services.index') }}">Services</a>
        <x-arrow-icon />
        <span>Edit Service</span>
    </div>

    {{-- Form for editing the service --}}
    <div class="dashboard-main-container-modules">
        <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data" class="node-form">
            @csrf
            @method('PUT')

            <div class="node-input">
                <label for="service_title" class="form-label">Title</label>
                <input type="text" name="service_title" id="service_title" class="form-control" value="{{ $service->service_title }}">
            </div>
            <div class="node-input">
                <label for="service_subtitle" class="form-label">Subtitle</label>
                <input type="text" name="service_subtitle" id="service_subtitle" class="form-control" value="{{ $service->service_subtitle }}">
            </div>
            <div class="node-input">
                <label for="service_description" class="form-label">Description</label>
                <input type="text" name="service_description" id="service_description" class="form-control" value="{{ $service->service_description }}">
            </div>

            <div class="node-input">
                <label for="status" class="form-label">Status</label>
                <input type="text" name="status" id="status" class="form-control" value="{{ $service->status }}">
            </div>
            <div class="node-input">
                <label for="template" class="form-label">Template</label>
                <input type="text" name="template" id="template" class="form-control" value="{{ $service->template }}">
            </div>

            <div class="node-input">
                <label for="seo_title" class="form-label">SEO Title</label>
                <input type="text" name="seo_title" id="seo_title" class="form-control" value="{{ $service->seo_title }}">
            </div>

            <div class="node-input">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select">
                    @foreach($servicecategories as $servicecategory)
                        <option value="{{ $servicecategory->id }}" {{ $servicecategory->id == $service->category_id ? 'selected' : '' }}>{{ $servicecategory->category_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Images -->
            <div class="node-file-input">
                <label for="images" class="form-label">Images</label>
                @foreach(json_decode($service->images) as $image)
                <img src="{{ asset('storage/Images/general/' . $image) }}" alt="service Image">
                @endforeach
                <input type="file" name="images[]" id="images" class="form-control" multiple>
            </div>


            <div class="node-input">
                <label for="points" class="form-label">List of Points</label>
                <textarea name="points" id="points" class="form-control" rows="4">{{ $service->points }}</textarea>
            </div>

            <div class="node-input">
                <label for="characteristics" class="form-label">Characteristics</label>
                <textarea name="characteristics" id="characteristics" class="form-control">{{ $service->characteristics }}</textarea>
            </div>

            <!-- Attributes -->
            <div class="node-input" id="attributeFields">
                <label for="attributes" class="form-label">Attributes</label>
                @foreach(json_decode($service->attributes) as $attribute => $value)
                <div class="dashboard-row">
                    <input type="text" name="attributes[name][]" placeholder="Attribute Name" value="{{ $attribute }}"
                        class="form-control">
                    <input type="text" name="attributes[value][]" placeholder="Attribute Value" value="{{ $value }}"
                        class="form-control">
                    <button type="button" id="addAttribute" class="btn btn-primary mt-3">Add Attribute</button>
                </div>
                @endforeach
            </div>

            <button class="dashboard-main-button" type="submit">
                <x-save-icon />
                <span>Update</span>
            </button>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('addAttribute').addEventListener('click', function() {
            var attributeField = document.createElement('div');
            attributeField.classList.add('dashboard-row');
            attributeField.innerHTML = `
                <input type="text" name="attributes[name][]" placeholder="Attribute Name" class="form-control">
                <input type="text" name="attributes[value][]" placeholder="Attribute Value" class="form-control">
                <button type="button" class="dashboard-danger-button removeAttribute">Remove</button>
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
