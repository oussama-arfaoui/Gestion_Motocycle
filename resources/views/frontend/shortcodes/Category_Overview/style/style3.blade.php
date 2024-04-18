<section class="category_overview_style3">

    <div class="category_overview_style3-content">
        <div class="category_overview_style3-content-text global_container">
            <div class="category_overview_style3-content-text-tag">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m16.2 19 4.8-7-4.8-7H3l4.8 7L3 19h13.2Z" />
                </svg>
                <p>{{$section_tag}}</p>
            </div>

            <h2 class="category_overview_style3-content-text-title">{{$title}}</h2>
            <p class="category_overview_style3-content-text-description">{{$description}}</p>

            <x-primary_button path='{{$primary_button_link}}' text="{{$primary_button_label}}"></x-primary_button>
        </div>

        <div class="category_overview_style3-content-categories">
            <a href="{{$category_link_1}}" class="category_overview_style3-content-categories-category">
                <div class="category_overview_style3-content-categories-category-text">
                    <h3>{{ $category_title_1 }}</h3>
                    <p>{{ $category_description_1 }}</p>
                </div>
            </a>

            <a href="{{$category_link_2}}" class="category_overview_style3-content-categories-category">
                <div class="category_overview_style3-content-categories-category-text">
                    <h3>{{ $category_title_2 }}</h3>
                    <p>{{ $category_description_2 }}</p>
                </div>
            </a>

            <a href="{{$category_link_3}}" class="category_overview_style3-content-categories-category">
                <div class="category_overview_style3-content-categories-category-text">
                    <h3>{{ $category_title_3 }}</h3>
                    <p>{{ $category_description_3 }}</p>
                </div>
            </a>

            <a href="{{$category_link_4}}" class="category_overview_style3-content-categories-category">
                <div class="category_overview_style3-content-categories-category-text">
                    <h3>{{ $category_title_4 }}</h3>
                    <p>{{ $category_description_4 }}</p>
                </div>
            </a>

        </div>

    </div>

</section>