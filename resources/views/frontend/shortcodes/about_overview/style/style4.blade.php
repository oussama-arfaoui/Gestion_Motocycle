<section class="about_overview_style4 global_container">

    <div class="about_overview_style4-content">

        <div class="about_overview_style4-content-text">
            <div class="about_overview_style1-content-text-tag">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m16.2 19 4.8-7-4.8-7H3l4.8 7L3 19h13.2Z" />
                </svg>
                <p>{{$section_tag}}</p>
            </div>
            <h2 class="about_overview_style1-content-text-title">{{$title}}</h2>
            <p class="about_overview_style1-content-text-description">{{$description}}</p>
            <div class="about_overview_style1-content-text-actions">
                <x-primary_button path='{{$primary_button_link}}' text="{{$primary_button_label}}"></x-primary_button>
                <x-secondary_button path='{{$secondary_button_link}}' text="{{$secondary_button_label}}">
                </x-secondary_button>
            </div>
        </div>

        <div class="about_overview_style4-content-image">
            <img src="./bgs/about_overview/bg_desktop.png" alt="It seems as if life has passed me by...">
        </div>
    </div>

</section>