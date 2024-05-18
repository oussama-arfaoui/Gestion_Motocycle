{{-- Admin Config File --}}
@php
    // Assuming $categories is an array of category objects passed from the controller
    $Projects = App\Models\Projects::all(); // Example of fetching categories from the database
@endphp

<section class="shortcode-editor">

    <div class="node-input">
        <label>title</label>
        <input name="title" value="" />
    </div>

    <div class="node-selector">
        <label for="Projects" class="form-label">Projects</label>
        <select name="Projects" id="Projects" class="form-select" multiple>
            @foreach($Projects as $Project)
                <option value="{{ $Project->id }}">{{ $Project->projects_title }}</option>
            @endforeach
        </select>
    </div>


    <div class="node-selector">
        <label>Style</label>
        <select name="style">
            <option value="style1">Style 1</option>
            <option value="style2">Style 2</option>
            <option value="style3">Style 3</option>
            <option value="style4">Style 4</option>
            <option value="style5">Style 5</option>
            <option value="style6">Style 6</option>
            <option value="style7">Style 7</option>
            <option value="style8">Style 8</option>
            <option value="style9">Style 9</option>
            <option value="style10">Style 10</option>
        </select>
    </div>

</section>