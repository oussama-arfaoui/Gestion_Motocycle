{{-- Admin Config File --}}
@php
    // Assuming $categories is an array of category objects passed from the controller
    $Carrers = App\Models\Carrier::all(); // Example of fetching categories from the database
@endphp

<section class="shortcode-editor">
    <div class="node-selector">
        <div class="node-input">
            
            <label>title</label>
            <input name="title" value="" />
        </div>

        <div class="node-selector">
            <label for="Carrers" class="form-label">Carrers</label>
            <select name="Carrers" id="Carrers" class="form-select" multiple>
                @foreach($Carrers as $Carrer)
                    <option value="{{ $Carrer->id }}">{{ $Carrer->title }}</option>
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