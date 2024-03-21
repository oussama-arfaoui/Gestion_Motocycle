<section class="category_overview_style1 global_container">
    <div class="category_overview_style1-text">
        <div class="category_overview_style1-text-tag">
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m16.2 19 4.8-7-4.8-7H3l4.8 7L3 19h13.2Z" />
            </svg>
            <p>{{$section_tag}}</p>
        </div>
        <h2 class="category_overview_style1-text-title">{{$title}}</h2>
        <p class="category_overview_style1-text-description">{{$description}}</p>
        <x-primary_button path='/spaces' text="{{$primary_button_label}}"></x-primary_button>
    </div>

    <div class="category_overview_style1-content">

        <div class="category_overview_style1-content-item">

            <div class="category_overview_style1-content-item-image">
                <img src="./blanks/400x500.png" alt="Salsa">
            </div>

            <div class="category_overview_style1-content-item-text">
                <h3>{{$category_title_2}}</h3>
                <p>{{$category_description_2}}</p>
                <button class="option-btn">
                    <a href="/spaces"> {{-- MUST BE REPLACED WITH THE CATEGORY DETAILS LINK: PORtes Exterieur--}}
                        <span>
                            {{$category_button_2}}
                        </span>
                        <x-chevron-icon></x-chevron-icon>
                    </a>
                </button>
            </div>
        </div>

        <div class="category_overview_style1-content-item">

            <div class="category_overview_style1-content-item-image">
                <img src="./blanks/400x500.png" alt="Salsa">
            </div>

            <div class="category_overview_style1-content-item-text">
                <h3>{{$category_title_1}}</h3>
                <p>{{$category_description_1}}</p>
                <button class="option-btn">
                    <a href="/spaces"> {{-- MUST BE REPLACED WITH THE CATEGORY DETAILS LINK: PORtes Exterieur--}}
                        {{$category_button_1}}
                        <x-chevron-icon></x-chevron-icon>
                    </a>
                </button>
            </div>
        </div>


    </div>
</section>