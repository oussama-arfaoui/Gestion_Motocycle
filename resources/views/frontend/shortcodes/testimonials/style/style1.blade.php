<section class="testimonials_style1 global_container">
    <div class="testimonials_style1-text">
        <h2>{{$title}}</h2>
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
            @endif
            <p>{{ $testimonialy->testimonial }}</p>
        </div>
        @endif
        @endforeach
        @endforeach
        {{-- End of Testimonials Loop --}}
    </div>
    <div class="testimonials_style1_navigation">
        <button class="prev">
            <x-chevron-icon></x-chevron-icon>
        </button>
        
        <div class="dots">
            {{-- Dots will be added dynamically --}}
        </div>

        <button class="next">
            <x-chevron-icon></x-chevron-icon>
        </button>
    </div>

</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const items = document.querySelectorAll('.testimonials_style1-items-item');
    const dotsContainer = document.querySelector('.testimonials_style1_navigation .dots');
    
    // Create dots
    items.forEach((item, index) => {
    const dot = document.createElement('div');
    dot.classList.add('dot');
    if (index === 0) {
    dot.classList.add('active');
    }
    dotsContainer.appendChild(dot);
    });
    
    const dots = document.querySelectorAll('.dot');
    
    let currentSlide = 0;
    showSlide(currentSlide);
    
    function showSlide(index) {
    items.forEach((item, i) => {
    if (i === index) {
    item.style.display = 'block';
    } else {
    item.style.display = 'none';
    }
    });
    dots.forEach((dot, i) => {
    if (i === index) {
    dot.classList.add('active');
    } else {
    dot.classList.remove('active');
    }
    });
    }
    
    function nextSlide() {
    currentSlide++;
    if (currentSlide >= items.length) {
    currentSlide = 0;
    }
    showSlide(currentSlide);
    }
    
    function prevSlide() {
    currentSlide--;
    if (currentSlide < 0) { currentSlide=items.length - 1; } showSlide(currentSlide); }
        document.querySelector('.testimonials_style1_navigation .prev').addEventListener('click', prevSlide);
        document.querySelector('.testimonials_style1_navigation .next').addEventListener('click', nextSlide);
        dots.forEach((dot, index)=> {
        dot.addEventListener('click', () => {
        currentSlide = index;
        showSlide(currentSlide);
        });
        });
        });
</script>