{{-- Style 1 File --}}

<section class="double_screen_style1">
    <div style="background-image: url('/bgs/service_category_1.png')" class="double_screen_style1-card">
        <h2 class="double_screen_style1-card-title">{{$title_1}}</h2>
        <p class="double_screen_style1-card-description">{{$description_1}}</p>
        <x-primary_button path="/contact" text={{$button_1}}></x-primary_button>
    </div>
    <div style="background-image: url('/bgs/service_category_2.png')" class="double_screen_style1-card">
        <h2 class="double_screen_style1-card-title">{{$title_2}}</h2>
        <p class="double_screen_style1-card-description">{{$description_2}}</p>
        <x-primary_button path="/contact" text={{$button_2}} ></x-primary_button>
    </div>
</section>