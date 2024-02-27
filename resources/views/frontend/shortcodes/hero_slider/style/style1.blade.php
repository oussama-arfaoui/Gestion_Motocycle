<div class="hero-carousel">
    <button class="nav-btn prev-btn"><svg class="with-icon_icon__MHUeb" data-testid="geist-icon" fill="none" height="24"
            shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="1.5" viewBox="0 0 24 24" width="24"
            style="color:var(--geist-foreground);width:24px;height:24px">
            <path d="M15 18l-6-6 6-6" />
        </svg></button>
    <button class="nav-btn next-btn"><svg class="with-icon_icon__MHUeb" data-testid="geist-icon" fill="none" height="24"
            shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="1.5" viewBox="0 0 24 24" width="24"
            style="color:var(--geist-foreground);width:24px;height:24px">
            <path d="M9 18l6-6-6-6" />
        </svg></button>


    <section style="background-image: url('/bgs/slide-1.jpg')" class="hero-slider active">
        <div class="hero-slider-dark-overlay"></div>
        <div class="hero-slider-content">
            <h1>{{$title}}</h1>
            <p>{{$description}}</p>
            <x-primary_button path='/catalogue' text="{{$button_primary_label}}"></x-primary_button>
        </div>
    </section>


    <section style="background-image: url('/bgs/slide-2.jpg')" class="hero-slider">
        <div class="hero-slider-dark-overlay"></div>
        <div class="hero-slider-content">
            <h1>Qualité et diversité à prix abordable</h1>
            <p>Une large gamme de portes PVC haut de gamme sans sacrifier votre budget.</p>
            <x-primary_button path='/catalogue' text="Voir Nos options"></x-primary_button>
        </div>
    </section>

    <section style="background-image: url('/bgs/slide-3.jpg')" class="hero-slider">
        <div class="hero-slider-dark-overlay"></div>
        <div class="hero-slider-content">
            <h1>Faites des économies exceptionnelles</h1>
            <p>Des portes PVC livrées rapidement pour une installation immédiate.</p>
            <x-primary_button path='/catalogue' text="{{$button_primary_label}}"></x-primary_button>
        </div>
    </section>

    <section style="background-image: url('/bgs/slide-4.jpg')" class="hero-slider">
        <div class="hero-slider-dark-overlay"></div>
        <div class="hero-slider-content">
            <h1>Ce que vous voyez est ce que vous obtenez</h1>
            <p>Des devis transparents et des représentations exactes des produits.</p>
            <x-primary_button path='/catalogue' text="Obtenir Un Devis Gratuit"></x-primary_button>
        </div>
    </section>

    <section style="background-image: url('/bgs/slide-5.jpg')" class="hero-slider">
        <div class="hero-slider-dark-overlay"></div>
        <div class="hero-slider-content">
            <h1>Dédié aux promoteurs immobiliers</h1>
            <p>Nous répondons spécifiquement à vos besoins en portes en grand volume.</p>
            <x-primary_button path='/catalogue' text="Contactez-Nous Directement"></x-primary_button>
        </div>
    </section>
    <!-- Add more slides as needed -->
</div>

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