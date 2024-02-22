@extends('backend.layouts.admin-dashboard')

@section('content')
<div class="dashboard-main-container">

    <div class="dashboard-main-container-breadcrumbs">
        <a href='/admin'>Home</a>
        <x-arrow-icon />
        <a href="{{ route('pages.index') }}">Pages</a>
        <x-arrow-icon />
        <a href="#">Edit Pages</a>
    </div>

    <div class="dashboard-main-container-actions">
        <a class="dashboard-secondary-button" href="#">
            <x-save-icon />
            <span>Save</span>
        </a>
        <a class="dashboard-main-button" href="{{ route('pages.create') }}">
            <x-save-icon />
            <span>Save & Publish</span>
        </a>
    </div>

    <div class="dashboard-main-container-modules">
        <form class="node-form" action="{{ route('pages.update', $page->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="node-input">
                <label for="name">Name</label>
                <input type="text" name="name" autocomplete="off" class="form-control" id="name"
                    value="{{ $page->name }}" required>
            </div>

            <!-- Permalink section -->
            <div class="node-permalink">
                <label class="form-label required" for="slug" aria-required="true">Permalink</label>
                <div class="node-permalink-preview">
                    <span class="input-group-text">{{ config('app.url') }}</span>
                    <input class="form-control ps-0" type="text" name="slug" id="slug"
                        value="{{ optional($page->slug)->key }}" required aria-required="true">
                </div>
            </div>

            {{-- <small class="form-hint mt-n2 text-truncate" id="previewLink">Preview:
                @if($page->slug)
                <a href="{{ config('app.url') }}{{ $page->slug->key }}" target="_blank">{{ config('app.url') }}{{
                    $page->slug->key
                    }}</a>
                @else
                No preview available
                @endif
            </small> --}}
            <!-- End Permalink section -->


            <!-- In your Blade template -->
            <div class="node-shortcode-picker">
                <label for="shortcodeType">Select Shortcode Type</label>
                <select name="shortcodeType" id="shortcodeType" class="form-control">
                    <option value="">Select Shortcode</option>
                    @foreach ($shortcodeTypes as $shortcodeType => $shortcodeData)
                    <option value="{{ $shortcodeData['view'] }}">{{ ucfirst($shortcodeData['name']) }} Shortcode
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group" id="shortcodeConfigContainer">
                <!-- The shortcode configuration will be dynamically loaded here -->
                <!-- You can leave this empty -->
            </div>

            <button id="generateShortcodeBtn" class="dashboard-action-button" disabled>Generate Shortcode</button>
            <!-- End Shortcode configuration -->

            <div class="node-input">
                <label for="content">Content</label>
                <textarea name="content" class="form-control" id="content" rows="4">{{ $page->content }}</textarea>
            </div>
            <div class="node-input">
                <label for="image">Image</label>
                <input type="text" name="image" class="form-control" id="image" value="{{ $page->image }}">
            </div>
            <div class="node-input">
                <label for="template">Template</label>
                <input type="text" name="template" class="form-control" id="template" value="{{ $page->template }}">
            </div>
            <div class="node-input"">
                <label for=" description">Description</label>
                <input type="text" name="description" class="form-control" id="description"
                    value="{{ $page->description }}">
            </div>
            <div class="node-selector">
                <label for="status">Status</label>
                <select name="status" class="form-control" id="status">
                    <option value="published" {{ $page->status == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="pending" {{ $page->status == 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </div>
            <button type="submit" class="dashboard-main-button">
                <x-save-icon />
                Update & Publish
            </button>
        </form>
    </div>
</div>

<script>
    // Function to generate a slug from the given string
    function generateSlug(str) {
        return str.toLowerCase().replace(/\s+/g, '-').replace(/[^\w-]+/g, '');
    }

    // Event listener for changes in the name input field
    document.getElementById('name').addEventListener('input', function () {
        // Get the value of the name input field
        var name = this.value;
        // Generate the slug
        var slug = generateSlug(name);
        // Populate the slug input field with the generated slug
        document.getElementById('slug').value = slug;
    });

    document.getElementById('shortcodeType').addEventListener('change', function() {
        var shortcodeType = this.value; // Get the selected shortcode type
        if (shortcodeType !== '') {
            // Send an AJAX request to retrieve the view content
            fetch('/get-shortcode-config/' + shortcodeType)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('shortcodeConfigContainer').innerHTML = data; // Populate the container with the view content
                })
                .catch(error => {
                    console.error('Failed to load shortcode configuration', error);
                });
        } else {
            document.getElementById('shortcodeConfigContainer').innerHTML = ''; // Clear the container if no shortcode is selected
        }
    });

    document.getElementById('shortcodeType').addEventListener('change', function() {
        var shortcodeType = this.value; // Get the selected shortcode type
        var button = document.getElementById('generateShortcodeBtn');
        if (shortcodeType !== '') {
            // Show the button when a shortcode is selected
            button.style.display = 'block';
        } else {
            // Hide the button when no shortcode is selected
            button.style.display = 'none';
        }
    });

    document.getElementById('shortcodeType').addEventListener('change', function() {
        var shortcodeType = this.value; // Get the selected shortcode type
        var button = document.getElementById('generateShortcodeBtn');
        if (shortcodeType !== '') {
            // Enable the button when a shortcode is selected
            button.disabled = false;
        } else {
            // Disable the button when no shortcode is selected
            button.disabled = true;
        }
    });

    document.getElementById('generateShortcodeBtn').addEventListener('click', function(e) {
    // Prevent the default form submission behavior
    e.preventDefault();
    
    // Get the selected shortcode type from the dropdown
    var shortcodeType = document.getElementById('shortcodeType').value;
    
    // Extract the shortcode name from the selected value
    var shortcodeName = shortcodeType.split('.').slice(-2, -1)[0];
    
    // Construct the shortcode
    var shortcode = '[' + shortcodeName + ' ';
    
    // Get data from dynamic inputs and construct shortcode
    var inputs = document.querySelectorAll('#shortcodeConfigContainer input, #shortcodeConfigContainer textarea');
    inputs.forEach(function(input) {
        if (input.value.trim() !== '') {
            shortcode += input.getAttribute('name') + '="' + input.value.trim().replace(/'/g, '’') + '" ';
        }
    });
    
    // Get selected value from dropdown and add it to the shortcode
    var select = document.querySelector('#shortcodeConfigContainer select');
    var selectedValue = select.options[select.selectedIndex].value;
    shortcode += 'style="' + selectedValue + '" ';
    
    shortcode += ']';
    
    // Append the closing shortcode tag
    shortcode += '[/' + shortcodeName + ']';
    
    // Append constructed shortcode to the content textarea
    var contentTextarea = document.getElementById('content');
    contentTextarea.value += shortcode;
});


</script>

@endsection