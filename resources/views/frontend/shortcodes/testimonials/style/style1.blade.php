@foreach(explode(',', $testimonials) as $testimonialsId)
@foreach($testimonialss as $testimonialy)
@if($testimonialy->id == $testimonialsId)
<section class="category_with_examples_style1 global_container">

    <div class="category_with_examples_style1-button">
        <x-primary_button path='/product-categories/{{ $testimonialy->id }}' text='{{ $testimonialy->name }}'>
        </x-primary_button>
    </div>
    <div class="category_with_examples_style1-items-item">
        <div class="category_with_examples_style1-items-item-tag">
            <p>{{ $testimonialy->name }}</p>
        </div>
        <!-- Check if images exist for the product -->
        <p>   @if($testimonialy->image)
        <img src="{{ asset('storage/Images/general/' . $testimonialy->image) }}" alt="Testimonial Image">
        @else
            <p>No image available</p>
        @endif</p>
        <p>{{ $testimonialy->subtitle }}</p>
        <p>{{ $testimonialy->job_description }}</p>
        <p>{{ $testimonialy->job_location }}</p>
        <p>{{ $testimonialy->testimonial }}</p>
    </div>
</section>
@endif
@endforeach
@endforeach