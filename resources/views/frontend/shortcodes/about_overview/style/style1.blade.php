<section class="about_overview_style1 global_container">

    <div class="about_overview_style1-content">

        <div class="about_overview_style1-content-text">
            <div class="about_overview_style1-content-text-tag">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M3 21H21M18 21V6.2C18 5.0799 18 4.51984 17.782 4.09202C17.5903 3.71569 17.2843 3.40973 16.908 3.21799C16.4802 3 15.9201 3 14.8 3H9.2C8.0799 3 7.51984 3 7.09202 3.21799C6.71569 3.40973 6.40973 3.71569 6.21799 4.09202C6 4.51984 6 5.0799 6 6.2V21M15 12H15.01"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
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