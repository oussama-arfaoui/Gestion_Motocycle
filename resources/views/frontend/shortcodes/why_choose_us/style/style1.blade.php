{{-- Style 1 File --}}

<section id="why-us-section" class="why_choose_us_style1 global_container">

    <div class="why_choose_us_style1-content">

        <div class="why_choose_us_style1-content-text">
            <div class="why_choose_us_style1-content-text-tag">
                {{-- <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m16.2 19 4.8-7-4.8-7H3l4.8 7L3 19h13.2Z" />
                </svg> --}}
                <p>{{$section_tag}}</p>
            </div>
            <h2 class="why_choose_us_style1-content-text-title">{{$title}}</h2>
            <p class="why_choose_us_style1-content-text-description">{{$description}}</p>
            <x-primary_button path='{{$primary_button_link}}' text="{{$primary_button_label}}"></x-primary_button>
        </div>

        <div class="why_choose_us_style1-content-nodes">

            <div class="why_choose_us_style1-content-nodes-node">
                <img src="./icons/icon-{{$node_icon_1}}.png" alt="quality-icon">
                <h3>{{ $node_title_1 }}</h3>
                <p>{{ $node_description_1 }}</p>
            </div>

            <div class="why_choose_us_style1-content-nodes-node">
                <img src="./icons/icon-{{$node_icon_2}}.png" alt="quality-icon">
                <h3>{{ $node_title_2 }}</h3>
                <p>{{ $node_description_2 }}</p>
            </div>

            <div class="why_choose_us_style1-content-nodes-node">
                <img src="./icons/icon-{{$node_icon_3}}.png" alt="quality-icon">
                <h3>{{ $node_title_3 }}</h3>
                <p>{{ $node_description_3 }}</p>
            </div>

            <div class="why_choose_us_style1-content-nodes-node">
                <img src="./icons/icon-{{$node_icon_4}}.png" alt="quality-icon">
                <h3>{{ $node_title_4 }}</h3>
                <p>{{ $node_description_4 }}</p>
            </div>
        </div>
    </div>
    
</section>