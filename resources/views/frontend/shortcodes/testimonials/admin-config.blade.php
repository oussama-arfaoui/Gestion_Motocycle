{{-- Admin Config File --}}
@php
    // Assuming $categories is an array of category objects passed from the controller
    $testimonials = App\Models\Testimonial::all(); // Example of fetching categories from the database
@endphp
<section class="shortcode-editor">

    <div class="node-input">
        <label class="control-label">Title</label>
        <input name="title" value="" />
    </div>
    
    <div class="node-input">
        <label class="control-label">Description</label>
        <textarea name="description" value=""></textarea>
    </div>

    <div class="node-selector">
        <label for="testimonials" class="form-label">testimonials</label>
        <select name="testimonials" id="testimonials" class="form-select" multiple>
            @foreach($testimonials as $testimonial)
                <option value="{{ $testimonial->id }}">{{ $testimonial->name }}</option>
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
