<section class="hero_slider_style2">

    <div class="hero-carousel">
        <button class="nav-btn prev-btn"><svg class="with-icon_icon__MHUeb" data-testid="geist-icon" fill="none"
                height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"
                style="color:var(--geist-foreground);width:24px;height:24px">
                <path d="M15 18l-6-6 6-6" />
            </svg></button>
        <button class="nav-btn next-btn"><svg class="with-icon_icon__MHUeb" data-testid="geist-icon" fill="none"
                height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"
                style="color:var(--geist-foreground);width:24px;height:24px">
                <path d="M9 18l6-6-6-6" />
            </svg></button>


        <section style="background-image: url('/bgs/background-3.jpg')" class="hero-slider active">
            <div class="hero-slider-dark-overlay"></div>
            <div class="hero-slider-content">
                <h1>{{$title}}</h1>
                <p>{{$description}}</p>
                <x-primary_button path='/spaces' text="{{$button_primary_label}}"></x-primary_button>
            </div>
        </section>


        <section style="background-image: url('/bgs/background-6.jpg')" class="hero-slider">
            <div class="hero-slider-dark-overlay"></div>
            <div class="hero-slider-content">
                <h1>Qualité et diversité à prix abordable</h1>
                <p>Une large gamme de portes PVC haut de gamme sans sacrifier votre budget.</p>
                <x-primary_button path='/spaces' text="Voir Nos options"></x-primary_button>
            </div>
        </section>
        <!-- Add more slides as needed -->
        <a class="hero_slider_style2-indicator">
            <x-chevron-icon></x-chevron-icon>
        </a>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    let slides = document.querySelectorAll(".hero-slider");
    let currentSlide = 0;
    let isDragging = false;
    let startPosX = 0;
    let currentPosX = 0;
    let timer = 8000;
    
    function showSlide(index) {
    slides.forEach((slide, i) => {
    if (i === index) {
    slide.classList.add("active");
    } else {
    slide.classList.remove("active");
    }
    });
    }

    function startSliderInterval() {
    intervalId = setInterval(nextSlide, timer);
    }
    
    function stopSliderInterval() {
    clearInterval(intervalId);
    }
    
    function nextSlide() {
    stopSliderInterval(); 
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
    startSliderInterval();
    }
    
    function prevSlide() {
    stopSliderInterval(); 
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    showSlide(currentSlide);
    startSliderInterval(); 
    }

    document.querySelector(".next-btn").addEventListener("click", nextSlide);
    document.querySelector(".prev-btn").addEventListener("click", prevSlide);
    
    function handleStart(e) {
    isDragging = true;
    startPosX = e.clientX;
    currentPosX = startPosX;
    }
    
    function handleMove(e) {
    if (!isDragging) return;
    currentPosX = e.clientX;
    }
    
    function handleEnd(e) {
    isDragging = false;
    let diff = startPosX - currentPosX;
    if (diff > 50) {
    nextSlide();
    } else if (diff < -50) { prevSlide(); } } 
    document.addEventListener("mousedown", handleStart);
    document.addEventListener("mousemove", handleMove);
    document.addEventListener("mouseup", handleEnd);
    document.addEventListener("mouseleave", handleEnd);
    startSliderInterval(); });
</script>