<section class="gallery_overview_style1 global_container">
    <div class="gallery_overview_style1-text">
        <div class="gallery_overview_style1-text-tag">
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m16.2 19 4.8-7-4.8-7H3l4.8 7L3 19h13.2Z" />
            </svg>
            <p>{{$section_tag}}</p>
        </div>
        <h2 class="gallery_overview_style1-text-title">{{$title}}</h2>
        <p class="gallery_overview_style1-text-description">{{$description}}</p>
        <x-primary_button path='/contact' text="{{$primary_button_label}}"></x-primary_button>
    </div>

    <div class="gallery_overview_style1-grid">
        <div class="gallery_overview_style1-grid-item grid-item-1" onclick="showPopup(1)">
            <img src="./projects/thumbnails/project-1.jpg" alt="">

            <div class="gallery_overview_style1-grid-item-banner">
                <h3>{{$project_title_1}}</h3>
                <p>{{$project_description_1}}</p>
            </div>
        </div>
        <div class="gallery_overview_style1-grid-item grid-item-2" onclick="showPopup(2)">
            <img src="./projects/thumbnails/project-2.jpg" alt="">

            <div class="gallery_overview_style1-grid-item-banner">
                <h3>{{$project_title_2}}</h3>
                <p>{{$project_description_2}}</p>
            </div>
        </div>
        <div class="gallery_overview_style1-grid-item grid-item-3" onclick="showPopup(3)">
            <img src="./projects/thumbnails/project-3.jpg" alt="">

            <div class="gallery_overview_style1-grid-item-banner">
                <h3>{{$project_title_3}}</h3>
                <p>{{$project_description_3}}</p>
            </div>
        </div>
        <div class="gallery_overview_style1-grid-item grid-item-4" onclick="showPopup(4)">
            <img src="./projects/thumbnails/project-4.jpg" alt="">

            <div class="gallery_overview_style1-grid-item-banner">
                <h3>{{$project_title_4}}</h3>
                <p>{{$project_description_4}}</p>
            </div>
        </div>
        <div class="gallery_overview_style1-grid-item grid-item-5" onclick="showPopup(5)">
            <img src="./projects/thumbnails/project-5.jpg" alt="">

            <div class="gallery_overview_style1-grid-item-banner">
                <h3>{{$project_title_5}}</h3>
                <p>{{$project_description_5}}</p>
            </div>
        </div>
    </div>
</section>

<div id="project_popup1" class="project_popup" onclick="closePopup(1)">
    <div style="background-image: url(./projects/thumbnails/project-1.jpg)" class="project_popup-content">
        <span class="project_popup-content-close" onclick="closePopup(1)">&times;</span>

        <video autoplay loop muted>
            <source src="./projects/videos/project-1.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <h2 class="project_popup-content-title">{{$project_title_1}}</h2>
        <p class="project_popup-content-description">{{$project_description_1}}</p>

        <ul class="project_popup-content-data">
            <li class="project_popup-content-data-point">Quantité De Portes:
                <span>{{$project_number_of_doors_1}}</span>
            </li>
            <li class="project_popup-content-data-point">Date: <span>{{$project_date_1}}</span> </li>
            <li class="project_popup-content-data-point">Période: <span>{{$project_period_1}}</span></li>
            <li class="project_popup-content-data-point">Location: <span>{{$project_location_1}}</span></li>
        </ul>
    </div>
</div>
<div id="project_popup2" class="project_popup" onclick="closePopup(2)">
    <div style="background-image: url(./projects/thumbnails/project-2.jpg)" class="project_popup-content">
        <span class="project_popup-content-close" onclick="closePopup(2)">&times;</span>


        <video autoplay loop muted>
            <source src="./projects/videos/project-2.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <h2 class="project_popup-content-title">{{$project_title_2}}</h2>
        <p class="project_popup-content-description">{{$project_description_2}}</p>

        <ul class="project_popup-content-data">
            <li class="project_popup-content-data-point">Quantité De Portes:
                <span>{{$project_number_of_doors_2}}</span>
            </li>
            <li class="project_popup-content-data-point">Date: <span>{{$project_date_2}}</span> </li>
            <li class="project_popup-content-data-point">Période: <span>{{$project_period_2}}</span></li>
            <li class="project_popup-content-data-point">Location: <span>{{$project_location_2}}</span></li>
        </ul>
    </div>
</div>
<div id="project_popup3" class="project_popup" onclick="closePopup(3)">
    <div style="background-image: url(./projects/thumbnails/project-3.jpg)" class="project_popup-content">
        <span class="project_popup-content-close" onclick="closePopup(3)">&times;</span>


        <video autoplay loop muted>
            <source src="./projects/videos/project-3.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <h2 class="project_popup-content-title">{{$project_title_3}}</h2>
        <p class="project_popup-content-description">{{$project_description_3}}</p>

        <ul class="project_popup-content-data">
            <li class="project_popup-content-data-point">Quantité De Portes:
                <span>{{$project_number_of_doors_3}}</span>
            </li>
            <li class="project_popup-content-data-point">Date: <span>{{$project_date_3}}</span> </li>
            <li class="project_popup-content-data-point">Période: <span>{{$project_period_3}}</span></li>
            <li class="project_popup-content-data-point">Location: <span>{{$project_location_3}}</span></li>
        </ul>
    </div>
</div>
<div id="project_popup4" class="project_popup" onclick="closePopup(4)">
    <div style="background-image: url(./projects/thumbnails/project-4.jpg)" class="project_popup-content">
        <span class="project_popup-content-close" onclick="closePopup(4)">&times;</span>


        <video autoplay loop muted>
            <source src="./projects/videos/project-4.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <h2 class="project_popup-content-title">{{$project_title_4}}</h2>
        <p class="project_popup-content-description">{{$project_description_4}}</p>

        <ul class="project_popup-content-data">
            <li class="project_popup-content-data-point">Quantité De Portes:
                <span>{{$project_number_of_doors_4}}</span>
            </li>
            <li class="project_popup-content-data-point">Date: <span>{{$project_date_4}}</span> </li>
            <li class="project_popup-content-data-point">Période: <span>{{$project_period_4}}</span></li>
            <li class="project_popup-content-data-point">Location: <span>{{$project_location_4}}</span></li>
        </ul>
    </div>
</div>
<div id="project_popup5" class="project_popup" onclick="closePopup(5)">
    <div style="background-image: url(./thumbnails/project-5.jpg)" class="project_popup-content">
        <span class="project_popup-content-close" onclick="closePopup(5)">&times;</span>

        <video autoplay loop muted>
            <source src="./projects/videos/project-5.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <h2 class="project_popup-content-title">{{$project_title_5}}</h2>
        <p class="project_popup-content-description">{{$project_description_5}}</p>

        <ul class="project_popup-content-data">
            <li class="project_popup-content-data-point">Quantité De Portes:
                <span>{{$project_number_of_doors_5}}</span>
            </li>
            <li class="project_popup-content-data-point">Date: <span>{{$project_date_5}}</span> </li>
            <li class="project_popup-content-data-point">Période: <span>{{$project_period_5}}</span></li>
            <li class="project_popup-content-data-point">Location: <span>{{$project_location_5}}</span></li>
        </ul>
    </div>
</div>

<script>
    function showPopup( number ) {
        const project_popup = document.getElementById(`project_popup${number}`);

        project_popup.classList.add('active');
        document.body.classList.add('project_popup-open');

    }

    function closePopup(number) {
        document.getElementById(`project_popup${number}`).classList.remove('active');
        document.body.classList.remove('project_popup-open');
    }

</script>