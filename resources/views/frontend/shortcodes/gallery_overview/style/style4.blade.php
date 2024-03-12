<section class="gallery_overview_style4">
    <div class="gallery_overview_style4-content ">
        <div class="gallery_overview_style4-content-text global_container">

            <div class="gallery_overview_style4-content-text-tag">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m16.2 19 4.8-7-4.8-7H3l4.8 7L3 19h13.2Z" />
                </svg>
                <p>{{$section_tag}}</p>
            </div>
            <h2 class="gallery_overview_style4-content-text-title">{{$title}}</h2>
            <p class="gallery_overview_style4-content-text-description">{{$description}}</p>

            <x-primary_button path='/projects' text='{{$primary_button_label}}'></x-primary_button>
        </div>

        <div class="swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <div class="swiper-slide">
                    <div class="gallery_overview_style4-content-slide">
                        <img src={{@asset('./blanks/700x500.png')}} alt="">
                        <div class="gallery_overview_style4-content-slide-text">
                            <h3>{{$project_title_1}}</h3>
                            <p>{{$project_description_1}}</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="gallery_overview_style4-content-slide">
                        <img src={{@asset('./blanks/700x500.png')}} alt="">
                        <div class="gallery_overview_style4-content-slide-text">
                            <h3>{{$project_title_2}}</h3>
                            <p>{{$project_description_2}}</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="gallery_overview_style4-content-slide">
                        <img src={{@asset('./blanks/700x500.png')}} alt="">
                        <div class="gallery_overview_style4-content-slide-text">
                            <h3>{{$project_title_3}}</h3>
                            <p>{{$project_description_3}}</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="gallery_overview_style4-content-slide">
                        <img src={{@asset('./blanks/700x500.png')}} alt="">
                        <div class="gallery_overview_style4-content-slide-text">
                            <h3>{{$project_title_4}}</h3>
                            <p>{{$project_description_4}}</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="gallery_overview_style4-content-slide">
                        <img src={{@asset('./blanks/700x500.png')}} alt="">
                        <div class="gallery_overview_style4-content-slide-text">
                            <h3>{{$project_title_5}}</h3>
                            <p>{{$project_description_5}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
</section>