{{-- Style 1 File --}}

<section class="category_with_examples_style1 global_container">

    <div class="category_with_examples_style1-button">
        <x-primary_button path='/{{ $category_link }}' text='{{$primary_button_link}}'></x-primary_button>
    </div>

    <div class="category_with_examples_style1-items">

        <div class="category_with_examples_style1-items-item">
            <div class="category_with_examples_style1-items-item-tag">
                <p>{{$tag_1}}</p>
            </div>

            <img src="./doors/interior_doors/door-1.png" alt="product-1">

            <h3>{{$product_name_1}}</h3>

            <x-primary_button path="/{{ $category_link }}/1" text="{{$sell_button}}"></x-primary_button>
        </div>

        <div class="category_with_examples_style1-items-item">
            <div class="category_with_examples_style1-items-item-tag">
                <p>{{$tag_1}}</p>
            </div>

            <img src="./doors/interior_doors/door-2.png" alt="product-2">

            <h3>{{$product_name_2}}</h3>


            <x-primary_button path="/{{ $category_link }}/2" text="{{$sell_button}}"></x-primary_button>
        </div>

        <div class="category_with_examples_style1-items-item">
            <div class="category_with_examples_style1-items-item-tag">
                <p>{{$tag_2}}</p>
            </div>

            <img src="./doors/interior_doors/door-3.png" alt="product-3">

            <h3>{{$product_name_3}}</h3>

            <x-primary_button path="/{{ $category_link }}/3" text="{{$sell_button}}"></x-primary_button>
        </div>
        
        <div class="category_with_examples_style1-items-more">
            <a href="/{{ $category_link }}">
                <h3>Découvrez Plus...</h3>
                <svg class="with-icon_icon__MHUeb" data-testid="geist-icon" fill="none" height="24" shape-rendering="geometricPrecision"
                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24"
                width="24" style="color:var(--geist-foreground);width:24px;height:24px">
                <circle cx="12" cy="12" r="10" />
                <path d="M12 8v8" />
                <path d="M8 12h8" />
            </svg>
        </a>
        </div>


    </div>
</section>