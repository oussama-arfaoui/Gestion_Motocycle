<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $page_title }}</title>

    @vite(['resources/css/app.css', 'resources/scss/style.scss', 'resources/js/app.js'])
</head>



<body class="website antialiased">

    @include('frontend.layouts.header')

    <section class="page_banner_style1 global_container">

        <div class="page_banner_style1-logo">
            <img src="./logos/primary-logo.svg" alt="">
        </div>

   
        <p>{{ $categories->description}} </p>
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
                <img src="{{ asset('storage/Images/general/' . $firstImage) }}" alt="Product Image">
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