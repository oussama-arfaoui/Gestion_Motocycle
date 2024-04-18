<section class="category_overview_style2 global_container">

    <div class="category_overview_style2-text">
        <div class="category_overview_style2-text-tag">
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m16.2 19 4.8-7-4.8-7H3l4.8 7L3 19h13.2Z" />
            </svg>
            <p>{{$section_tag}}</p>
        </div>
        <h2 class="category_overview_style2-text-title">{{$title}}</h2>
        <p class="category_overview_style2-text-description">{{$description}}</p>
        <x-primary_button path="{{$primary_button_link}}" text="{{$primary_button_label}}"></x-primary_button>
    </div>

    <div class="category_overview_style2-categories">
        <a href="{{$category_link_1}}" class="category_overview_style2-categories-category">
            <div class="category_overview_style2-categories-category-image">
                <img src="./bgs/category_overview/category_1.png" alt="">
            </div>
            <div class="category_overview_style2-categories-category-text">
                <h3>{{$category_title_1}}</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path
                        d="M19.221 10.803 12 10V4a2 2 0 0 0-4 0v12l-3.031-1.212a2 2 0 0 0-2.64 1.225l-.113.34a.998.998 0 0 0 .309 1.084l5.197 4.332c.179.149.406.231.64.231H19a2 2 0 0 0 2-2v-7.21a2 2 0 0 0-1.779-1.987z">
                    </path>
                </svg>
            </div>
        </a>
        <a href="{{$category_link_2}}" class="category_overview_style2-categories-category">
            <div class="category_overview_style2-categories-category-image">
                <img src="./bgs/category_overview/category_2.png" alt="">
            </div>
            <div class="category_overview_style2-categories-category-text">
                <h3>{{$category_title_2}}</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path
                        d="M19.221 10.803 12 10V4a2 2 0 0 0-4 0v12l-3.031-1.212a2 2 0 0 0-2.64 1.225l-.113.34a.998.998 0 0 0 .309 1.084l5.197 4.332c.179.149.406.231.64.231H19a2 2 0 0 0 2-2v-7.21a2 2 0 0 0-1.779-1.987z">
                    </path>
                </svg>
            </div>
        </a>
        <a href="{{$category_link_3}}" class="category_overview_style2-categories-category">
            <div class="category_overview_style2-categories-category-image">
                <img src="./bgs/category_overview/category_3.png" alt="">
            </div>
            <div class="category_overview_style2-categories-category-text">
                <h3>{{$category_title_3}}</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path
                        d="M19.221 10.803 12 10V4a2 2 0 0 0-4 0v12l-3.031-1.212a2 2 0 0 0-2.64 1.225l-.113.34a.998.998 0 0 0 .309 1.084l5.197 4.332c.179.149.406.231.64.231H19a2 2 0 0 0 2-2v-7.21a2 2 0 0 0-1.779-1.987z">
                    </path>
                </svg>
            </div>
        </a>

    </div>
</section>