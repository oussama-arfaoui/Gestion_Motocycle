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
        <h2>{{ $servicescategories->category_name }}</h2>
        <p>{{ $servicescategories->description }}</p>
    </section>


    <main class="projects_list_style1 global_container">
        <div class="projects_list_style1-items">
            @foreach($services as $service)
            <div class="projects_list_style1-items-item">
                <div class="projects_list_style1-items-item-tag">
                    <p>{{ $service->status }}</p>
                </div>
                <!-- Check if images exist for the service -->
                @if($service->images)
                    @php
                    $imageArray = json_decode($service->images, true);
                    $firstImage = isset($imageArray[0]) ? $imageArray[0] : null;
                    @endphp
                    <!-- Check if the first image exists -->
                    @if($firstImage)
                        <!-- Display the first image -->
                        <img src="{{ asset('storage/Images/general/' . $firstImage) }}" alt="Service Image">
                    @else
                        <p>No image available</p>
                    @endif
                @else
                    <p>No image available</p>
                @endif
                <h3>{{ $service->service_title }}</h3>
                <x-primary_button path="{{ route('services.show', $service->id) }}" text="Découvrir Plus">
                </x-primary_button>
            </div>
            @endforeach
        </div>
    </main>

    
    @include('frontend.layouts.footer')
</body>
</html>
