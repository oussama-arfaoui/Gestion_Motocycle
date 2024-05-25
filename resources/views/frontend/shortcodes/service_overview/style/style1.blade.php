{{-- Style 1 File --}}

<section class="service_overview_style1">

    <div class="service_overview_style1-content global_container">

        <div class="service_overview_style1-content-text">
            <div class="service_overview_style1-content-text-tag">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m16.2 19 4.8-7-4.8-7H3l4.8 7L3 19h13.2Z" />
                </svg>
                <p>{{$section_tag}}</p>
            </div>
            <h2 class="service_overview_style1-content-text-title">{{$title}}</h2>
            <p class="service_overview_style1-content-text-description">{{$description}}</p>
            <x-primary_button path='/contact' text="{{$primary_button_label}}"></x-primary_button>
        </div>
{{-- 
        <div class="service_overview_style1-image">
            <img src="./blanks/1000x500.png" alt="It seems as if it's passed me by">
        </div> --}}


        <div class="service_overview_style1-nodes">

            <div class="service_overview_style1-nodes-node">

                <div class="service_overview_style1-nodes-node-icon">
                    <img src="./icons/icon-{{$node_icon_1}}.png" alt="">
                </div>

                <h3>{{$node_title_1}}</h3>
                <p>{{$node_description_1}}</p>
            </div>

            <div class="service_overview_style1-nodes-node">
                <div class="service_overview_style1-nodes-node-icon">
                    <img src="./icons/icon-{{$node_icon_2}}.png" alt="">
                </div>

                <h3>{{$node_title_2}}</h3>
                <p>{{$node_description_2}}</p>
            </div>

            <div class="service_overview_style1-nodes-node">

                <div class="service_overview_style1-nodes-node-icon">
                    <img src="./icons/icon-{{$node_icon_3}}.png" alt="">
                </div>

                <h3>{{$node_title_3}}</h3>
                <p>{{$node_description_3}}</p>
            </div>

            <div class="service_overview_style1-nodes-node">

                <div class="service_overview_style1-nodes-node-icon">
                    <img src="./icons/icon-{{$node_icon_4}}.png" alt="">
                </div>

                <h3>{{$node_title_4}}</h3>
                <p>{{$node_description_4}}</p>
            </div>


        </div>
    </div>




</section>