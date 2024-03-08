<section class="about_overview_style1 global_container">

    <div class="about_overview_style1-content">

        <div class="about_overview_style1-content-text">
            <div class="about_overview_style1-content-text-tag">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m16.2 19 4.8-7-4.8-7H3l4.8 7L3 19h13.2Z" />
                </svg>
                <p>{{$section_tag}}</p>
            </div>
            <h2 class="about_overview_style1-content-text-title">{{$title}}</h2>
            <p class="about_overview_style1-content-text-description">{{$description}}</p>
            <x-primary_button path='/contact' text="{{$primary_button_label}}"></x-primary_button>
        </div>

        <div class="about_overview_style1-content-image">
            <img src="./bgs/background-1.jpg" alt="It seems as if it's passed me by">
        </div>

    </div>



    <div class="about_overview_style1-nodes">

        <div class="about_overview_style1-nodes-node">

            <div class="about_overview_style1-nodes-node-icon">
                <img src="./icons/icon-quality.png" alt="">
            </div>

            <h3>{{$node_title_1}}</h3>
            <p>{{$node_description_1}}</p>
        </div>

        <div class="about_overview_style1-nodes-node">
            <div class="about_overview_style1-nodes-node-icon">
                <img src="./icons/icon-innovation.png" alt="">
            </div>

            <h3>{{$node_title_2}}</h3>
            <p>{{$node_description_2}}</p>
        </div>

        <div class="about_overview_style1-nodes-node">

            <div class="about_overview_style1-nodes-node-icon">
                <img src="./icons/icon-service.png" alt="">
            </div>

            <h3>{{$node_title_3}}</h3>
            <p>{{$node_description_3}}</p>
        </div>

        <div class="about_overview_style1-nodes-node">

            <div class="about_overview_style1-nodes-node-icon">
                <img src="./icons/icon-efficiency.png" alt="">
            </div>

            <h3>{{$node_title_4}}</h3>
            <p>{{$node_description_4}}</p>
        </div>


    </div>
</section>