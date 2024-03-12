{{-- Admin Config File --}}
@php
    // Assuming $categories is an array of category objects passed from the controller
    $Brands = App\Models\Brand::all(); // Example of fetching categories from the database
@endphp

<section class="shortcode-editor">
    <div class="node-selector">

        <div class="node-selector">
            <label for="Brands" class="form-label">Brands</label>
            <select name="Brands" id="Brands" class="form-select" multiple>
                @foreach($Brands as $Brand)
                    <option value="{{ $Brand->id }}">{{ $Brand->name }}</option>
                @endforeach
            </select>
        </div>

        <label class="control-label">Style</label>
        <select name="style" class="form-control">
            <option value="style1">Style 1</option>
            <option value="style2">Style 2</option>
        </select>
    </div>
</section>