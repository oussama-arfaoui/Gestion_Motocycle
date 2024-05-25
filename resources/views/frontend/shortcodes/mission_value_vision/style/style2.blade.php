{{-- Style 2 File --}}

<section class="mission_value_vision_style2 global_container">

    <div class="mission_value_vision_style2-content">


        <div class="mission_value_vision_style2-content-text">
            <div class="mission_value_vision_style2-content-text-tag">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m16.2 19 4.8-7-4.8-7H3l4.8 7L3 19h13.2Z" />
                </svg>
                <p>{{$section_tag}}</p>
            </div>

            <h2 class="mission_value_vision_style2-content-text-title">{{ $title }}</h2>
            <p class="mission_value_vision_style2-content-text-description">{{ $description }}</p>
        </div>


        <div class="mission_value_vision_style2-content-nodes">

            <div class="mission_value_vision_style2-content-nodes-node">
                <img src="./icons/icon-mission.png" alt="icon">
                <h3>{{ $node_title_1 }}</h3>
                <p>{{ $node_description_1 }}</p>
            </div>
            
            <div class="mission_value_vision_style2-content-nodes-node">
                <img src="./icons/icon-values.png" alt="icon">
                <h3>{{ $node_title_2 }}</h3>
                <p>{{ $node_description_2 }}</p>
            </div>
            
            <div class="mission_value_vision_style2-content-nodes-node">
                <img src="./icons/icon-vision.png" alt="icon">
                <h3>{{ $node_title_3 }}</h3>
                <p>{{ $node_description_3 }}</p>
            </div>

        </div>
    </div>

</section>