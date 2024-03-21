<x-page-head />


<body class="website antialiased">

    @include('frontend.layouts.header')

    <main class="product_details_style1 global_container">

        <section class="product_details_style1-banner">

            <div class="product_details_style1-banner-logo">
                <img src="./logos/primary-logo.svg" alt="">
            </div>

            <h2>{{ $product->product_name }} style2</h2>
            <p>
                <a href="{{ route('product-categories.show', $product->category->id) }}">
                    {{ $product->category->category_name }}
                </a>
            </p>
        </section>

        <section class="product_details_style1-hero">
            <div class="product_details_style1-hero-image-container">
                <div id="zoom-container">
                    <img id="zoom-image" src="{{ asset('storage/Images/general/' . json_decode($product->images)[0]) }}"
                        alt="Thumbnail 1" class="product_details_style1-hero-image-container-image">
                </div>

                <div class="product_details_style1-hero-thumbnails">
                    <button class="product_details_style1-hero-prev-btn">
                        <svg class="with-icon_icon__MHUeb" data-testid="geist-icon" fill="none" height="24"
                            shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"
                            style="color:var(--geist-foreground);width:24px;height:24px">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                    </button>

                    @foreach(json_decode($product->images) as $image)
                    <img src="{{ asset('storage/Images/general/' . $image) }}" alt="Thumbnail"
                        class="product_details_style1-hero-thumbnails-item">
                    @endforeach

                    <button class="product_details_style1-hero-next-btn">
                        <svg class="with-icon_icon__MHUeb" data-testid="geist-icon" fill="none" height="24"
                            shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"
                            style="color:var(--geist-foreground);width:24px;height:24px">
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
                        <li>
                            <x-check-icon /><span>{{ $point }}</span>
                        </li>
                        @endforeach
                        @else
                        <li>No points available</li>
                        @endif
                    </ul>
                    <x-sell_button text='Demandez Un Devis' path="tel: {{$contact_number}}"></x-sell_button>
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

    <x-floating-actions />
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