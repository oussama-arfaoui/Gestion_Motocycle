<section class="about_overview_style5">

    <div class="dark-overlay"></div> <!-- Dark overlay -->

    <div class="about_overview_style5-content global_container">

        <div class="about_overview_style5-content-text">
            <div class="about_overview_style5-content-text-tag">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m16.2 19 4.8-7-4.8-7H3l4.8 7L3 19h13.2Z" />
                </svg>
                <p>{{$section_tag}}</p>
            </div>
            <h2 class="about_overview_style5-content-text-title">{{$title}}</h2>
            <p class="about_overview_style5-content-text-description">{{$description}}</p>
            <x-primary_button path='/contact' text="{{$primary_button_label}}"></x-primary_button>
        </div>
        {{--
        <div class="about_overview_style5-content-image">
            <img src="./blanks/1000x500.png" alt="It seems as if it's passed me by">
        </div> --}}
    </div>

</section>

<script>
    // JavaScript for parallax effect
 window.addEventListener('scroll', function() {
const parallaxSection = document.querySelector('.about_overview_style5');

const sectionOffset = parallaxSection.getBoundingClientRect().top;

    let scrollPosition = window.scrollY - (parallaxSection.clientHeight + 500); // Adjust the offset and factor here
    parallaxSection.style.backgroundPositionY = scrollPosition * 0.3 + 'px'; // Adjust the speed of the parallax effect here

});
</script>