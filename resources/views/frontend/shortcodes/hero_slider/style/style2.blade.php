<section id="introduction" class="hero_slider_style2">
    <div class="hero_slider_style2-swiper global_container">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">

            <!-- Slides -->
            <div class="swiper-slide">

                <div class="hero_slider_style2-slide">
                    <div class="hero_slider_style2-slide-bg">
                    </div>
                    <div class="hero_slider_style2-slide-overlay"></div>
                    <div class="hero_slider_style2-slide-content">
                        <h1>{{ $title }}</h1>
                        <h2>{{ $subtitle }}</h2>
                        <p>{{ $description }}</p>
                        <div class="hero_slider_style2-slide-content-actions">
                            <x-primary_button text='{{$primary_button_label}}' path='{{$primary_button_link}}'>
                            </x-primary_button>
                            <x-secondary_button text='{{$secondary_button_label}}' path='{{$secondary_button_link}}'>
                            </x-secondary_button>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>


{{--

<p>{{ $bg_img }}</p>

<p>{{ $section_tag }}</p>

<p>{{ $title }}</p>

<p>{{ $subtitle }}</p>

<p>{{ $description }}</p>

<p>{{ $keyword }}</p>

<p>{{ $primary_button_label }}</p>

<p>{{ $primary_button_link }}</p>

<p>{{ $secondary_button_label }}</p>

<p>{{ $secondary_button_link }}</p>

<p>{{ $img_1 }}</p>

<p>{{ $img_2 }}</p>

<p>{{ $img_3 }}</p>

<p>{{ $img_4 }}</p>

--}}