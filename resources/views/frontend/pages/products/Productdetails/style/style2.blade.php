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

    <main class="product_details_style1 global_container">

        <section class="product_details_style1-banner">

            <div class="product_details_style1-banner-logo">
                <img src="./logos/primary-logo.svg" alt="">
            </div>

            <h2>{{ $product->product_name }}  style2</h2>
            <p>
                <a href="{{ route('product-categories.show', $product->category->id) }}">
                    {{ $product->category->category_name }}
                </a>
            </p>            
        </section>

        <section class="product_details_style1-hero">
            <div class="product_details_style1-hero-image-container">
                <div id="zoom-container">
                    <img id="zoom-image" src="{{ asset('storage/Images/general/' . json_decode($product->images)[0]) }}" alt="Thumbnail 1" class="product_details_style1-hero-image-container-image">
                </div>
            
                <div class="product_details_style1-hero-thumbnails">
                    <button class="product_details_style1-hero-prev-btn">
                        <svg class="with-icon_icon__MHUeb" data-testid="geist-icon" fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24" style="color:var(--geist-foreground);width:24px;height:24px">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                    </button>
            
                    @foreach(json_decode($product->images) as $image)
                        <img src="{{ asset('storage/Images/general/' . $image) }}" alt="Thumbnail" class="product_details_style1-hero-thumbnails-item">
                    @endforeach
            
                    <button class="product_details_style1-hero-next-btn">
                        <svg class="with-icon_icon__MHUeb" data-testid="geist-icon" fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24" style="color:var(--geist-foreground);width:24px;height:24px">
                            <path d="M9 18l6-6-6-6" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <div class="product_details_style1-hero-details-container">
                <div class="product_details_style1-hero-details-container-detail">
                    <h2>Description de Produit:</h2>
                    <p>{{ $product->product_description }}</p>
                    <ul>
                        @if ($product->points)
                            @foreach(json_decode($product->points) as $point)
                                <li><x-check-icon /><span>{{ $point }}</span></li>
                            @endforeach
                        @else
                            <li>No points available</li>
                        @endif
                    </ul>
                    <x-sell_button text='Demandez Un Devis' path="tel: 06 XX XX XX XX"></x-sell_button>
                </div>
            </div>
        </section>


        <section class="product_details_style1-technicals">

            <div class="product_details_style1-technicals-text">
                <h3 class="product_details_style1-technicals-text-title">Charactéristiques techniques:</h3>

                <p class="product_details_style1-technicals-text-description">
                    {{ $product->characteristics }}
                </p>
            </div>

            <div class="product_details_style1-technicals-table-container">
                <table class="product_details_style1-technicals-table-container-table">
                    <thead>
                        <td>Caractéristique</td>
                        <td>Données</td>
                    </thead>
                    @if(!is_null($product->attributes))
                    @foreach(json_decode($product->attributes, true) as $name => $value)
                    <tr>
                        <td>{{ $name }}</td>
                        <td>{{ $value }}</td>
                    </tr>
                @endforeach
                @endif
                </table>
            </div>
        </section>
    </main>

    @include('frontend.layouts.footer')

    <div id="whatsapp-button" class="whatsapp-button">
        <svg class="whatsapp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
            style="fill: rgba(255, 255, 255, 1);">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M18.403 5.633A8.919 8.919 0 0 0 12.053 3c-4.948 0-8.976 4.027-8.978 8.977 0 1.582.413 3.126 1.198 4.488L3 21.116l4.759-1.249a8.981 8.981 0 0 0 4.29 1.093h.004c4.947 0 8.975-4.027 8.977-8.977a8.926 8.926 0 0 0-2.627-6.35m-6.35 13.812h-.003a7.446 7.446 0 0 1-3.798-1.041l-.272-.162-2.824.741.753-2.753-.177-.282a7.448 7.448 0 0 1-1.141-3.971c.002-4.114 3.349-7.461 7.465-7.461a7.413 7.413 0 0 1 5.275 2.188 7.42 7.42 0 0 1 2.183 5.279c-.002 4.114-3.349 7.462-7.461 7.462m4.093-5.589c-.225-.113-1.327-.655-1.533-.73-.205-.075-.354-.112-.504.112s-.58.729-.711.879-.262.168-.486.056-.947-.349-1.804-1.113c-.667-.595-1.117-1.329-1.248-1.554s-.014-.346.099-.458c.101-.1.224-.262.336-.393.112-.131.149-.224.224-.374s.038-.281-.019-.393c-.056-.113-.505-1.217-.692-1.666-.181-.435-.366-.377-.504-.383a9.65 9.65 0 0 0-.429-.008.826.826 0 0 0-.599.28c-.206.225-.785.767-.785 1.871s.804 2.171.916 2.321c.112.15 1.582 2.415 3.832 3.387.536.231.954.369 1.279.473.537.171 1.026.146 1.413.089.431-.064 1.327-.542 1.514-1.066.187-.524.187-.973.131-1.067-.056-.094-.207-.151-.43-.263">
            </path>
        </svg>
    </div>
</body>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        const largeImage = document.querySelector('.product_details_style1-hero-image-container-image');
        const thumbnails = document.querySelectorAll('.product_details_style1-hero-thumbnails-item');

        const prevBtn = document.querySelector('.product_details_style1-hero-prev-btn');
        const nextBtn = document.querySelector('.product_details_style1-hero-next-btn');

let currentIndex = 0;

function showImage(index) {
currentIndex = index;
const selectedImage = thumbnails[index].getAttribute('src');
largeImage.setAttribute('src', selectedImage);
}

thumbnails.forEach((thumbnail, index) => {
thumbnail.addEventListener('click', () => {
showImage(index);
});
});

prevBtn.addEventListener('click', () => {
currentIndex = (currentIndex - 1 + thumbnails.length) % thumbnails.length;
showImage(currentIndex);
});

nextBtn.addEventListener('click', () => {
currentIndex = (currentIndex + 1) % thumbnails.length;
showImage(currentIndex);
});

showImage(0);
    });

    document.getElementById('zoom-container').addEventListener('mousemove', function(e) {
    const img = document.getElementById('zoom-image');
    const rect = e.target.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    const scale = 2; // Adjust the zoom scale as needed
    const transformOriginX = (x / rect.width) * 100;
    const transformOriginY = (y / rect.height) * 100;
    
    img.style.transformOrigin = `${transformOriginX}% ${transformOriginY}%`;
    img.style.transform = `scale(${scale})`;
    });
    
    document.getElementById('zoom-container').addEventListener('mouseleave', function() {
    const img = document.getElementById('zoom-image');
    img.style.transform = 'scale(1)';
    });
</script>

</html>