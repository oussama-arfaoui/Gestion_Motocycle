<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TITLE - A Carbon Developed Website</title>

    @vite(['resources/css/app.css', 'resources/scss/style.scss', 'resources/js/app.js'])
</head>



<body class="website antialiased">

    @include('frontend.layouts.header')

    <main class="product_details_style1 global_container">

        <section class="product_details_style1-banner">

            <div class="product_details_style1-banner-logo">
                <img src="./logos/primary-logo.svg" alt="">
            </div>

            <h2>Filler Title</h2>
            <p>Filler Description</p>
        </section>

        <section class="product_details_style1-hero">
            <div class="product_details_style1-hero-image-container">

                <div id="zoom-container">
                    <img id="zoom-image" src="/doors/interior_doors/door-1.png" alt="Thumbnail 1"
                        class="product_details_style1-hero-image-container-image">
                </div>

                <div class="product_details_style1-hero-thumbnails">
                    <button class="product_details_style1-hero-prev-btn"><svg class="with-icon_icon__MHUeb"
                            data-testid="geist-icon" fill="none" height="24" shape-rendering="geometricPrecision"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            viewBox="0 0 24 24" width="24" style="color:var(--geist-foreground);width:24px;height:24px">
                            <path d="M15 18l-6-6 6-6" />
                        </svg></button>

                    <img src="/doors/interior_doors/door-1.png" alt="Thumbnail 1"
                        class="product_details_style1-hero-thumbnails-item">
                    <img src="/doors/interior_doors/door-2.png" alt="Thumbnail 2"
                        class="product_details_style1-hero-thumbnails-item">
                    <img src="/doors/interior_doors/door-3.png" alt="Thumbnail 3"
                        class="product_details_style1-hero-thumbnails-item">
                    <img src="/doors/interior_doors/door-2.png" alt="Thumbnail 4"
                        class="product_details_style1-hero-thumbnails-item">
                    <img src="/doors/interior_doors/door-1.png" alt="Thumbnail 5"
                        class="product_details_style1-hero-thumbnails-item">

                    <button class="product_details_style1-hero-next-btn"><svg class="with-icon_icon__MHUeb"
                            data-testid="geist-icon" fill="none" height="24" shape-rendering="geometricPrecision"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            viewBox="0 0 24 24" width="24" style="color:var(--geist-foreground);width:24px;height:24px">
                            <path d="M9 18l6-6-6-6" />
                        </svg></button>
                </div>
            </div>
            <div class="product_details_style1-hero-details-container">
                <div class="product_details_style1-hero-details-container-detail">
                    <h2>Description de Produit:</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquam mi sit amet nisi ultricies,
                        at
                        ultricies nisi sagittis.
                        Vivamus ultrices est id neque iaculis, sit amet consectetur nunc vehicula. Integer sollicitudin
                        diam non
                        nunc cursus, at gravida ipsum consequat.
                        Fusce sit amet tortor in neque dapibus dapibus. Sed auctor nulla et tellus interdum, quis
                        ullamcorper quam
                        malesuada.
                        Duis gravida lacus in magna euismod, id condimentum libero pretium.
                    </p>

                    <ul>
                        <li>
                            <x-check-icon /><span>Design contemporain</span>
                        </li>

                        <li>
                            <x-check-icon /><span>Disponible en plusieurs coloris</span>
                        </li>

                        <li>
                            <x-check-icon /><span>Vitrage double isolant</span>
                        </li>

                        <li>
                            <x-check-icon /><span>Haute résistance aux intempéries</span>
                        </li>

                        <li>
                            <x-check-icon /><span>Sécurité renforcée</span>
                        </li>

                        <li>
                            <x-check-icon /><span>Fabrication Solide</span>
                        </li>
                    </ul>
                    <x-sell_button text='Demandez Un Devis' path="tel: 06 XX XX XX XX"></x-sell_button>
                </div>
            </div>
        </section>


        <section class="product_details_style1-technicals">

            <div class="product_details_style1-technicals-text">
                <h3 class="product_details_style1-technicals-text-title">Charactéristiques techniques:</h3>

                <p class="product_details_style1-technicals-text-description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquam mi sit amet nisi ultricies,
                    at
                    ultricies nisi sagittis.
                    Vivamus ultrices est id neque iaculis, sit amet consectetur nunc vehicula. Integer sollicitudin
                    diam non
                </p>
            </div>

            <div class="product_details_style1-technicals-table-container">
                <table class="product_details_style1-technicals-table-container-table">
                    <thead>
                        <td>Caractéristique</td>
                        <td>Données</td>
                    </thead>

                    <tr>
                        <td>Matériau</td>
                        <td>PVC haute densité</td>
                    </tr>

                    <tr>
                        <td>Épaisseur de la porte</td>
                        <td>70 mm</td>
                    </tr>

                    <tr>
                        <td>Coefficient d'isolation thermique (Uw)</td>
                        <td>1,0 W/m².K</td>
                    </tr>

                    <tr>
                        <td>Indice d'affaiblissement acoustique (Rw)</td>
                        <td>37 dB</td>
                    </tr>

                    <tr>
                        <td>Dimensions standard</td>
                        <td>80x215 cm (autres dimensions disponibles sur demande)</td>
                    </tr>
                </table>
            </div>
        </section>
    </main>

    @include('frontend.layouts.footer')
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