{{-- Style 1 File --}}

<section class="contact_hero_style1">

    <div class="hero-carousel">

        <section style="background-image: url('/blanks/1920x1080.png')" class="hero-slider active">
            <div class="hero-slider-dark-overlay"></div>
            <div class="hero-slider-content">
                <h1>{{$title}}</h1>
                <p>{{$description}}</p>
                <x-primary_button path='tel: {{$contact_number}}' text="{{$primary_action}}"></x-primary_button>
                <x-primary_button path='tel: {{$contact_whatsapp}}' text="{{$secondary_action}}"></x-primary_button>
            </div>
        </section>

        <!-- Add more slides as needed -->
        <a class="contact_hero_style1-indicator">
            <x-chevron-icon></x-chevron-icon>
        </a>
    </div>
</section>
