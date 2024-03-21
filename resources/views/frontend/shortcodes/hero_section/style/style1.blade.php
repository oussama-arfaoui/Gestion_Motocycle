{{-- Style 1 File --}}

<section class="hero_section_style1">

    <div class="hero_section_style1-content global_container">

        <div class="hero_section_style1-content-text">
            {{-- <p>{{ $section_tag }}</p> --}}

            <h1>{{ $title }}</h1>

            {{-- <h2>{{ $subtitle }}</h2> --}}

            <p>{{ $description }}</p>

            <div class="hero_section_style1-content-text-actions">
                <x-primary_button path="/services" text="{{ $primary_button_label }}"></x-primary_button>
                <x-primary_button path="/catalogue" text="{{ $secondary_button_label }}"></x-primary_button>
            </div>
        </div>
    </div>

</section>