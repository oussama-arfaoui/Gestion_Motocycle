{{-- Admin Config File --}}
@php
    // Assuming $categories is an array of category objects passed from the controller
    $categories = App\Models\ProductCategories::all(); // Example of fetching categories from the database
@endphp
<section class="shortcode-editor">

    <div class="node-selector">
        <label for="categories" class="form-label">Categories</label>
        <select name="categories" id="categories" class="form-select" multiple>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="node-selector">
        <label>Style</label>
        <select name="style">
            <option value="style1">Style 1</option>
            <option value="style2">Style 2</option>
        </select>
    </div>

</section>
