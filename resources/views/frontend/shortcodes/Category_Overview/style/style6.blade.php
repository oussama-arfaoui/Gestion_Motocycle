<section class="category_overview_style6">

    <div class="category_overview_style6-text">
        <div class="category_overview_style6-text-tag">
            <p>{{$section_tag}}</p>
        </div>
        <h2 class="category_overview_style6-text-title">{{$title}}</h2>
        <h3 class="category_overview_style6-text-subtitle">{{$subtitle}}</h3>
        <p class="category_overview_style6-text-description">{{$description}}</p>
        <div class="category_overview_style6-text-actions">
            <x-primary_button path="{{$primary_button_link}}" text="{{$primary_button_label}}"></x-primary_button>
            <x-secondary_button path="{{$secondary_button_link}}" text="{{$secondary_button_label}}">
            </x-secondary_button>
        </div>

        <div class="category_overview_style6-text-nodes">
            <div class="category_overview_style6-text-nodes-node">
                <img src="./icons/icon-{{$node_icon_1}}.png" alt="{{$node_icon_1}}-icon">
                <h3>{{$node_title_1}}</h3>
                <p>{{$node_description_1}}</p>
            </div>
            <div class="category_overview_style6-text-nodes-node">
                <img src="./icons/icon-{{$node_icon_2}}.png" alt="{{$node_icon_1}}-icon">
                <h3>{{$node_title_2}}</h3>
                <p>{{$node_description_2}}</p>
            </div>
            <div class="category_overview_style6-text-nodes-node">
                <img src="./icons/icon-{{$node_icon_3}}.png" alt="{{$node_icon_1}}-icon">
                <h3>{{$node_title_3}}</h3>
                <p>{{$node_description_3}}</p>
            </div>
            <div class="category_overview_style6-text-nodes-node">
                <img src="./icons/icon-{{$node_icon_4}}.png" alt="{{$node_icon_1}}-icon">
                <h3>{{$node_title_4}}</h3>
                <p>{{$node_description_4}}</p>
            </div>
        </div>
    </div>

    <div class="category_overview_style6-content">

        <a href="{{$category_link_1}}" class="category_overview_style6-content-item">

            <div class="category_overview_style6-content-item-image">
                <img src="/bgs/category_overview/category_1.png" alt="Salsa">
            </div>

            <div class="category_overview_style6-content-item-text">
                <h3>{{$category_title_1}}</h3>
                <p>{{$category_description_1}}</p>
            </div>
        </a>

        <a href="{{$category_link_2}}" class="category_overview_style6-content-item">

            <div class="category_overview_style6-content-item-image">
                <img src="/bgs/category_overview/category_2.png" alt="Salsa">
            </div>

            <div class="category_overview_style6-content-item-text">
                <h3>{{$category_title_2}}</h3>
                <p>{{$category_description_2}}</p>
            </div>
        </a>
        
        <a href="{{$category_link_3}}" class="category_overview_style6-content-item">

            <div class="category_overview_style6-content-item-image">
                <img src="/bgs/category_overview/category_3.png" alt="Salsa">
            </div>

            <div class="category_overview_style6-content-item-text">
                <h3>{{$category_title_3}}</h3>
                <p>{{$category_description_3}}</p>
            </div>
        </a>
        
        <a href="{{$category_link_4}}" class="category_overview_style6-content-item">

            <div class="category_overview_style6-content-item-image">
                <img src="/bgs/category_overview/category_4.png" alt="Salsa">
            </div>

            <div class="category_overview_style6-content-item-text">
                <h3>{{$category_title_4}}</h3>
                <p>{{$category_description_4}}</p>
            </div>
        </a>


    </div>
</section>