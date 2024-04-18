{{-- Style 1 File --}}

<section class="product_overview_style1">

    <div class="product_overview_style1-title">
        <div class="product_overview_style1-title-tag">

            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m16.2 19 4.8-7-4.8-7H3l4.8 7L3 19h13.2Z" />
            </svg>
            <p>{{ $section_tag }}</p>
        </div>

        <h2>{{ $title }}</h2>
    </div>

    <div class="product_overview_style1-section global_container">
        <div class="product_overview_style1-section-img">
            <img src="./bgs/service-overview-1.jpg" alt="">
        </div>
        <div class="product_overview_style1-section-text">
            <h3>{{ $subtitle }}</h3>
            <p>{{ $description }}</p>
        </div>
    </div>

    <div class="product_overview_style1-section global_container">
        <div class="product_overview_style1-section-nodes">
            <div class="product_overview_style1-section-nodes-node">
                <img src="./icons/icon-{{$node_icon_1}}.png" alt="">
                <h4>{{ $node_title_1 }}</h4>
                <p>{{ $node_description_1 }}</p>
            </div>
            <div class="product_overview_style1-section-nodes-node">
                <img src="./icons/icon-{{$node_icon_2}}.png" alt="">
                <h4>{{ $node_title_2 }}</h4>
                <p>{{ $node_description_2 }}</p>
            </div>
            <div class="product_overview_style1-section-nodes-node">
                <img src="./icons/icon-{{$node_icon_3}}.png" alt="">
                <h4>{{ $node_title_3 }}</h4>
                <p>{{ $node_description_3 }}</p>
            </div>
            <div class="product_overview_style1-section-nodes-node">
                <img src="./icons/icon-{{$node_icon_4}}.png" alt="">
                <h4>{{ $node_title_4 }}</h4>
                <p>{{ $node_description_4 }}</p>
            </div>
        </div>
        <div class="product_overview_style1-section-img">
            <img src="./bgs/service-overview-2.jpg" alt="">
        </div>
    </div>

    <div class="product_overview_style1-actions">
        <x-primary_button path='tel: {{$contact_number}}' text='{{ $primary_button_label }}'></x-primary_button>

        <x-primary_button path='/service-categories/5' text='{{ $secondary_button_label }}'></x-primary_button>

        <x-primary_button path='/contact' text='{{ $ternary_button_label }}'></x-primary_button>
    </div>

</section>