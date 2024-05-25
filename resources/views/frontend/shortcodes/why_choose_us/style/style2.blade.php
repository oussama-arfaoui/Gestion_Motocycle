{{-- Style 2 File --}}

<section class="why_choose_us_style2">

    <div class="why_choose_us_style2-content">

        <div class="why_choose_us_style2-content-text global_container">
            <div class="why_choose_us_style2-content-text-tag">
                <p>{{$section_tag}}</p>
            </div>
            <h2 class="why_choose_us_style2-content-text-title">{{$title}}</h2>
            <h3 class="why_choose_us_style2-content-text-subtitle">{{$subtitle}}</h3>
            <p class="why_choose_us_style2-content-text-description">{{$description}}</p>
            <div class="why_choose_us_style2-content-text-actions">
                <x-primary_button path="{{$primary_button_link}}" text="{{$primary_button_label}}"></x-primary_button>
                <x-secondary_button path="{{$secondary_button_link}}" text="{{$secondary_button_label}}">
                </x-secondary_button>
            </div>
        </div>

        <div class="why_choose_us_style2-content-nodes">

            <div class="why_choose_us_style2-content-nodes-node">
                <img src="./icons/icon-{{$node_icon_1}}.png" alt="quality-icon">
                <h3>{{ $node_title_1 }}</h3>
                <p>{{ $node_description_1 }}</p>
            </div>

            <div class="why_choose_us_style2-content-nodes-node">
                <img src="./icons/icon-{{$node_icon_2}}.png" alt="quality-icon">
                <h3>{{ $node_title_2 }}</h3>
                <p>{{ $node_description_2 }}</p>
            </div>

            <div class="why_choose_us_style2-content-nodes-node">
                <img src="./icons/icon-{{$node_icon_3}}.png" alt="quality-icon">
                <h3>{{ $node_title_3 }}</h3>
                <p>{{ $node_description_3 }}</p>
            </div>

            <div class="why_choose_us_style2-content-nodes-node">
                <img src="./icons/icon-{{$node_icon_4}}.png" alt="quality-icon">
                <h3>{{ $node_title_4 }}</h3>
                <p>{{ $node_description_4 }}</p>
            </div>
        </div>
    </div>
    
</section>