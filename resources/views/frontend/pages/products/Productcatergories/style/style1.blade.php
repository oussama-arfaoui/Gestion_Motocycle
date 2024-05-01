<x-page-head />



<body class="website antialiased">

    @include('frontend.layouts.header')
    
    <section class="page_banner_style1 ">
        <div class="page_banner_style1-content global_container">
    
            <div class="page_banner_style1-content-logo">
                <img src="./logos/primary-logo.svg" alt="">
            </div>
    
            <h2>{{ $categories->category_name }}</h2>
            <p>{{ $categories->description}}</p>
        </div>
    
        <svg class="editorial" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 24 150 28 " preserveAspectRatio="none">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 
                58-18 88-18s
                58 18 88 18 
                58-18 88-18 
                58 18 88 18
                v44h-352z" />
            </defs>
            <g class="parallax1">
                <use xlink:href="#gentle-wave" x="50" y="3" fill="#fff" />
            </g>
            <g class="parallax2">
                <use xlink:href="#gentle-wave" x="50" y="0" fill="var(--primary-color)" />
            </g>
            <g class="parallax3">
                <use xlink:href="#gentle-wave" x="50" y="9" fill="var(--accent-color)" />
            </g>
            <g class="parallax4">
                <use xlink:href="#gentle-wave" x="50" y="6" fill="#fff" />
            </g>
        </svg>
    </section>

    <main class="products_list_style1 global_container">
        <div class="products_list_style1-items">
            @foreach($categories->products as $product)
            <div class="products_list_style1-items-item">
                <div class="products_list_style1-items-item-tag">
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
                <img src="{{ asset(json_decode($product->images)[0]) }}" alt="Product Image">
                @else
                <p>No image available</p>
                @endif
                @else
                <p>No image available</p>
                @endif

                <h3>{{ $product->product_name }}</h3>


                <x-primary_button path="{{ route('products.show', $product->id) }}" text="Découvrir Plus">
                </x-primary_button>
            </div>
            @endforeach
        </div>
    </main>

    @include('frontend.layouts.footer')
</body>


</html>