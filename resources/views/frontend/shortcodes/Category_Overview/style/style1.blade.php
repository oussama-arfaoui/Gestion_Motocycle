<section class="category_overview_style1 global_container">
    <div class="category_overview_style1-text">
        <div class="category_overview_style1-text-tag">
        <svg width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M3 21H21M18 21V6.2C18 5.0799 18 4.51984 17.782 4.09202C17.5903 3.71569 17.2843 3.40973 16.908 3.21799C16.4802 3 15.9201 3 14.8 3H9.2C8.0799 3 7.51984 3 7.09202 3.21799C6.71569 3.40973 6.40973 3.71569 6.21799 4.09202C6 4.51984 6 5.0799 6 6.2V21M15 12H15.01"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <p>{{$section_tag}}</p>
    </div>
        <h2 class="category_overview_style1-text-title">{{$title}}</h2>
        <p class="category_overview_style1-text-description">{{$description}}</p>
        <x-primary_button path='/catalogue' text="{{$primary_button_label}}"></x-primary_button>
    </div>

    <div class="category_overview_style1-content">
        <div class="category_overview_style1-content-item">

            <div class="category_overview_style1-content-item-image">
                <img src="./doors/door-1.png" alt="Interior door Image">
            </div>

            <div class="category_overview_style1-content-item-text">
                <h3>{{$category_title_1}}</h3>
                <p>{{$category_description_1}}</p>
                <button class="option-btn">
                    <a href="/categorie_interieur">
                        {{$category_button_1}}
                        <x-chevron-icon></x-chevron-icon>
                    </a>
                </button>
            </div>
        </div>

        <div class="category_overview_style1-content-item">

            <div class="category_overview_style1-content-item-image">
                <img src="./doors/door-2.png" alt="Exterior door Image">
            </div>

            <div class="category_overview_style1-content-item-text">
                <h3>{{$category_title_2}}</h3>
                <p>{{$category_description_2}}</p>
                <button class="option-btn">
                    <a href="/categorie_exterieur">
                        <span>
                            {{$category_button_2}}
                        </span>
                        <x-chevron-icon></x-chevron-icon>
                    </a>
                </button>
            </div>
        </div>
    </div>
</section>