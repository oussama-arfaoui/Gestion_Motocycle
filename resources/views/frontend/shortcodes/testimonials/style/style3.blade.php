<section class="testimonials_style3">

    <div class="testimonials_style3-content ">
        <div class="testimonials_style3-content-text global_container">

            <div class="testimonials_style3-content-text-tag">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m16.2 19 4.8-7-4.8-7H3l4.8 7L3 19h13.2Z" />
                </svg>
                <p>Témoignages de Clients</p>
            </div>
            <h2 class="testimonials_style3-content-text-title">{{$title}}</h2>
            <p class="testimonials_style3-content-text-description">{{$description}}</p>

        </div>

        <div class="swiper-2">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->

                @foreach(explode(',', $testimonials) as $testimonialsId)
                @foreach($testimonialss as $testimonialy)
                @if($testimonialy->id == $testimonialsId)

                <div class="swiper-slide">
                    <div class="testimonials_style3-content-slide-title">
                        <h3 class="testimonials_style3-content-slide-title-name" data-swiper-parallax="-100">{{ $testimonialy->name }}</h3>
                        <p class="testimonials_style3-content-slide-title-job">{{ $testimonialy->job_description }}</p>
                        <p class="testimonials_style3-content-slide-title-location">{{ $testimonialy->job_location }}
                        </p>
                    </div>
                    <div class="testimonials_style3-content-slide-content">
                        <div class="testimonials_style3-content-slide-content-image">
                            @if($testimonialy->image)
                            <img src="{{ asset('storage/Images/general/' . $testimonialy->image) }}"
                                alt="Testimonial Image">
                            @else
                            <p>No image available</p>
                            @endif
                        </div>
                        <div data-swiper-parallax="-200" class="testimonials_style3-content-slide-content-text">
                            <p>{{ $testimonialy->testimonial }}</p>
                        </div>
                    </div>
                </div>

                @endif
                @endforeach
                @endforeach

            </div>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev-2"></div>
            <div class="swiper-button-next-2"></div>
        </div>
</section>