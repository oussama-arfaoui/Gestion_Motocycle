{{-- Style 2 File --}}


<section class="products_categories_list_style2 global_container">

    <div class="products_categories_list_style2-nodes">

        @foreach(explode(',', $categories) as $categoryId)
        @foreach($categorys as $category)
        @if($category->id == $categoryId)

        <div class="products_categories_list_style2-nodes-node">
            <div class="products_categories_list_style2-nodes-node-image">
                <img src="./blanks/500x500.png" alt="category_image">
            </div>
            <x-primary_button path='/product-categories/{{ $category->id }}' text='{{ $category->category_name }}'>
            </x-primary_button>
        </div>

        @endif
        @endforeach
        @endforeach
    </div>

</section>





{{-- <div class="product_categories_list_style2-items">

    <div class="product_categories_list_style2-items">
        @php $products = $category->products->take(3); @endphp
        @foreach($products as $product)
        <div class="product_categories_list_style2-items-item">
            <div class="product_categories_list_style2-items-item-tag">
                <p>{{ $product->status }}</p>
            </div>
            <!-- Check if images exist for the product -->
            @if($product->images)
            @php
            $imageArray = json_decode($product->images, true);
            $firstImage = isset($imageArray[0]) ? $imageArray[0] : null;
            @endphp
            <!-- Check if the first image exists -->
            @if($firstImage)
            <!-- Display the first image -->
            <img src="{{ asset('storage/Images/general/' . $firstImage) }}" alt="Product Image">
            @else
            <p>No image available</p>
            @endif
            @else
            <p>No image available</p>
            @endif
            <!-- Check if images exist for the product -->
            <h3>{{ $product->product_name }}</h3>
            <x-primary_button path="{{ route('products.show', $product->id) }}" text="Découvrir Plus">
            </x-primary_button>
        </div>
        @endforeach

        <div class="product_categories_list_style2-items-item product_categories_list_style2-items-more">
            <a href="{{ route('product-categories.show', $category->id) }}">
                <h3>Découvrez Plus...</h3>
                <svg class="with-icon_icon__MHUeb" data-testid="geist-icon" fill="none" height="24"
                    shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"
                    style="color:var(--geist-foreground);width:24px;height:24px">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M12 8v8" />
                    <path d="M8 12h8" />
                </svg>
            </a>
        </div>
    </div>

</div> --}}