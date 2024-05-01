@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">

    {{-- Breadcrumbs --}}
    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="/admin/pagesstyle">Create Page Style</a>
    </div>

    {{-- Actions for the pages_style table --}}
    <div class="dashboard-main-container-actions">
        <button type="submit" class="dashboard-main-button" onclick="submitForm()">
            <x-save-icon />
            <span>Save Styles</span>
        </button>
    </div>

    <div class="dashboard-main-container-modules">

        <form id="stylesForm" action="{{ route('pagesstyle.updateAll') }}" method="POST">
            @csrf
            @method('PUT')

            <div id="stylesContainer">

                @foreach($pagesstyles as $pagesstyle)
                <div class="attribute">
                    <div class="dashboard-row-half">
                        <input type="text" name="styles[{{ $pagesstyle->id }}][name]" placeholder="Attribute Name"
                            class="form-control " value="{{ $pagesstyle->name }}">
                        <select name="styles[{{ $pagesstyle->id }}][style]" class="form-control">
                            <option value="style1" {{ $pagesstyle->style == 'style1' ? 'selected' : '' }}>Style 1
                            </option>
                            <option value="style2" {{ $pagesstyle->style == 'style2' ? 'selected' : '' }}>Style 2
                            </option>
                            <option value="style3" {{ $pagesstyle->style == 'style3' ? 'selected' : '' }}>Style 3
                            </option>
                            <!-- Add more options if needed -->
                        </select>
                    </div>
                    <input type="hidden" name="deletePageStyle[]" value="{{ $pagesstyle->id }}">




                </div>
                @endforeach
            </div>

            <div class="node-input" id="attributeFields">
                <label for="attributes" class="form-label">Add New Style</label>
                <div class="dashboard-row-half">
                    <input type="text" name="newStyles[name][]" placeholder="Attribute Name" class="form-control">
                    <select name="newStyles[style][]" class="form-control">
                        <option value="style1">Style 1</option>
                        <option value="style2">Style 2</option>
                        <option value="style3">Style 3</option>
                        <!-- Add more options if needed -->
                    </select>
                    <button onclick="removeAttribute(this)" class="dashboard-icon-button action-view">
                        <x-add-icon />
                    </button>
                </div>
            </div>

            <div class="dashboard-final-actions">
                <button type="button" id="addAttribute" class="dashboard-secondary-button">Add Style</button>
                <button type="submit" class="dashboard-main-button">Save Changes</button>
            </div>

        </form>
    </div>
</div>

<script>
    function submitForm() {
        // Submit the form
        console.log('Submitting form...');
        document.getElementById('stylesForm').submit();
    }

    
function confirmDelete() {
    return confirm('Are you sure you want to delete this attribute?');
}

    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('addAttribute').addEventListener('click', function() {
            var attributeField = document.createElement('div');
            attributeField.classList.add('attribute');
            attributeField.innerHTML = `
                <input type="text" name="newStyles[name][]" placeholder="Attribute Name" class="form-control">
                <select name="newStyles[style][]" class="form-control">
                    <option value="style1">Style 1</option>
                    <option value="style2">Style 2</option>
                    <option value="style3">Style 3</option>
                    <!-- Add more options if needed -->
                </select>
                <button type="button" class="btn btn-danger removeAttribute" onclick="removeAttribute(this)">Remove</button>
            `;
            document.getElementById('attributeFields').appendChild(attributeField);
        });
    });
</script>

@endsection