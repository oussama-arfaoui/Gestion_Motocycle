@extends('storefront.layout.theme10')

@php
    $brand_logo_url = \App\Models\Utility::get_file('uploads/brand_image/');
    $category_img_url = \App\Models\Utility::get_file('uploads/product_image/');
    $variant_img_url = \App\Models\Utility::get_file('uploads/family_image/');
    $product_img_url = \App\Models\Utility::get_file('uploads/product/');

    // ── Website Builder settings (saved from /website-settings) ──
    $ws        = $wsSettings ?? [];
    $wsHero    = $ws['hero']     ?? [];
    $wsBrands  = $ws['brands']   ?? [];
    $wsVideo   = $ws['video']    ?? [];
    $wsCta     = $ws['cta']      ?? [];

    $heroEnabled   = !array_key_exists('hero', $ws) || !empty($wsHero['enabled']);
    $brandsEnabled = !array_key_exists('brands', $ws) || !empty($wsBrands['enabled']);
    $videoEnabled  = !empty($wsVideo['enabled']) && !empty($wsVideo['url']);
    $ctaEnabled    = !empty($wsCta['enabled']);

    $heroTitle    = !empty($wsHero['title'])    ? $wsHero['title']    : $store->name;
    $heroSubtitle = !empty($wsHero['subtitle']) ? $wsHero['subtitle'] : ($store->tagline ?? 'Découvrez notre collection de motos premium');
    $brandsTitle  = !empty($wsBrands['title'])  ? $wsBrands['title']  : 'Nos Marques';

    // Convert a YouTube/Vimeo URL into an embeddable URL
    $videoEmbed = '';
    if ($videoEnabled) {
        $u = $wsVideo['url'];
        if (preg_match('~(?:youtube\.com/watch\?v=|youtu\.be/|youtube\.com/embed/)([\w-]+)~', $u, $m)) {
            $videoEmbed = 'https://www.youtube.com/embed/' . $m[1] . (!empty($wsVideo['autoplay']) ? '?autoplay=1&mute=1' : '');
        } elseif (preg_match('~vimeo\.com/(\d+)~', $u, $m)) {
            $videoEmbed = 'https://player.vimeo.com/video/' . $m[1] . (!empty($wsVideo['autoplay']) ? '?autoplay=1&muted=1' : '');
        } else {
            $videoEmbed = $u;
        }
    }
@endphp

@push('css-page')
<style>
    :root {
        --primary-color: #FF7A00;
        --primary-dark: #E86D00;
        --secondary-color: #FF3A6E;
        --dark-color: #2c3e50;
        --light-bg: #fff8f3;
    }
    
    .hero-section {
        background: linear-gradient(135deg, #FF7A00 0%, #FF9A00 50%, #FFB300 100%);
        padding: 80px 0;
        color: white;
        text-align: center;
    }
    
    .hero-section h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }
    
    .hero-section p {
        font-size: 1.2rem;
        opacity: 0.9;
    }
    
    .section-title {
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .section-title h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
    }
    
    .section-title p {
        color: #6c757d;
        font-size: 1.1rem;
    }
    
    .brand-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        cursor: pointer;
        text-align: center;
        border: 2px solid transparent;
    }
    
    .brand-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(255,122,0,0.25);
        border-color: var(--primary-color);
    }
    
    .brand-card img {
        width: 120px;
        height: 120px;
        object-fit: contain;
        margin-bottom: 1rem;
    }
    
    .brand-card h3 {
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--dark-color);
        margin: 0;
    }
    
    .category-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    
    .category-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    
    .category-card-body {
        padding: 1.5rem;
    }
    
    .category-card h4 {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
    }
    
        
    .product-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    
    .product-image {
        position: relative;
        width: 100%;
        height: 250px;
        overflow: hidden;
        background: #f8f9fa;
    }
    
    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .product-card:hover .product-image img {
        transform: scale(1.1);
    }
    
    .product-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: var(--secondary-color);
        color: white;
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }
    
    .product-body {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .product-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
    }
    
        
    .product-price {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }
    
    .btn-primary-custom {
        background: linear-gradient(90deg, #FF7A00, #FF9A00);
        color: white;
        border: none;
        padding: 0.8rem 2rem;
        border-radius: 25px;
        font-weight: 700;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 4px 12px rgba(255,122,0,0.3);
    }
    
    .btn-primary-custom:hover {
        background: linear-gradient(90deg, #E86D00, #FF7A00);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 122, 0, 0.45);
        color: white;
    }
    
    .filter-tabs {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 3rem;
        flex-wrap: wrap;
    }
    
    .filter-tab {
        background: white;
        border: 2px solid #e9ecef;
        padding: 0.8rem 2rem;
        border-radius: 25px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
        color: var(--dark-color);
    }
    
    .filter-tab:hover,
    .filter-tab.active {
        background: linear-gradient(90deg, #FF7A00, #FF9A00);
        border-color: #FF7A00;
        color: white;
        box-shadow: 0 4px 12px rgba(255,122,0,0.3);
    }
    
    .back-btn {
        background: #6c757d;
        color: white;
        border: none;
        padding: 0.6rem 1.5rem;
        border-radius: 20px;
        font-weight: 600;
        cursor: pointer;
        margin-bottom: 2rem;
        transition: all 0.3s ease;
    }
    
    .back-btn:hover {
        background: #5a6268;
        transform: translateY(-2px);
    }
    
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }
    
    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -15px;
    }
    
    .col-md-3 {
        flex: 0 0 25%;
        max-width: 25%;
        padding: 0 15px;
        margin-bottom: 30px;
    }
    
    .col-md-4 {
        flex: 0 0 33.333%;
        max-width: 33.333%;
        padding: 0 15px;
        margin-bottom: 30px;
    }
    
    @media (max-width: 992px) {
        .col-md-3, .col-md-4 {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }
    
    @media (max-width: 576px) {
        .col-md-3, .col-md-4 {
            flex: 0 0 100%;
            max-width: 100%;
        }
        
        .hero-section h1 {
            font-size: 2rem;
        }
    }
</style>
@endpush

@section('content')
<main>
    <!-- Hero Section -->
    @if($heroEnabled)
    <section class="hero-section" style="position: relative; overflow: hidden;">
        <div style="position: absolute; inset: 0; background: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 20%22><path d=%22M0 20 Q25 0 50 10 Q75 20 100 5 L100 20Z%22 fill=%22rgba(255,255,255,0.08)%22/></svg>') bottom/cover no-repeat;"></div>
        <div class="container" style="position: relative; z-index: 1;">
            <img src="{{ asset('images/mobinardo-logo.png') }}" alt="MOBINARDO" style="max-height: 100px; max-width: 320px; object-fit: contain; margin-bottom: 1.5rem; filter: drop-shadow(0 4px 16px rgba(0,0,0,0.25)) brightness(0) invert(1);">
            <h1 style="text-shadow: 0 2px 8px rgba(0,0,0,0.2);">{{ $heroTitle }}</h1>
            <p style="opacity: 0.95;">{{ $heroSubtitle }}</p>
            @if(!empty($wsHero['cta_text']))
                <a href="{{ $wsHero['cta_link'] ?: '#brands-section' }}" class="btn-primary-custom" style="margin-top: 1.5rem; background: #fff; color: #FF7A00;">{{ $wsHero['cta_text'] }}</a>
            @endif
        </div>
    </section>
    @endif

    <!-- Brands Section -->
    <section class="brands-section" id="brands-section" style="padding: 60px 0; background: var(--light-bg); border-top: 4px solid #FF7A00;{{ $brandsEnabled ? '' : 'display:none;' }}">
        <div class="container">
            <div class="section-title">
                <h2 style="color: var(--dark-color);">{{ $brandsTitle }}</h2>
                <p>Choisissez parmi nos marques de motos premium</p>
                <div style="width: 60px; height: 4px; background: linear-gradient(90deg,#FF7A00,#FFB300); border-radius: 2px; margin: 1rem auto 0;"></div>
            </div>
            <div class="row">
                @forelse($brands as $brand)
                    <div class="col-md-3">
                        <div class="brand-card" onclick="showCategories({{ $brand->id }})">
                            @if($brand->brand_img)
                                <img src="{{ $brand_logo_url . $brand->brand_img }}" alt="{{ $brand->name }}">
                            @else
                                <img src="{{ asset('images/default-brand.png') }}" alt="{{ $brand->name }}">
                            @endif
                            <h3>{{ $brand->name }}</h3>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <p style="text-align: center; color: #6c757d;">No brands available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="categories-section" id="categories-section" style="padding: 60px 0; display: none;">
        <div class="container">
            <button class="back-btn" onclick="showBrands()" style="background: #FF7A00;">← Retour aux Marques</button>
            <div class="section-title">
                <h2 id="brand-name" style="color: var(--dark-color);">Catégories</h2>
                <p>Sélectionnez un modèle</p>
                <div style="width: 60px; height: 4px; background: linear-gradient(90deg,#FF7A00,#FFB300); border-radius: 2px; margin: 1rem auto 0;"></div>
            </div>
            <div class="row" id="categories-container">
                <!-- Categories will be loaded here -->
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="products-section" id="products-section" style="padding: 60px 0; background: var(--light-bg); display: none;">
        <div class="container">
            <button class="back-btn" onclick="showCategories(currentBrandId)" style="background: #FF7A00;">← Retour aux Catégories</button>
            <div class="section-title">
                <h2 id="category-name" style="color: var(--dark-color);">Motos disponibles</h2>
                <p id="category-description">Motos disponibles en stock</p>
                <div style="width: 60px; height: 4px; background: linear-gradient(90deg,#FF7A00,#FFB300); border-radius: 2px; margin: 1rem auto 0;"></div>
            </div>
            <div class="row" id="products-container">
                <!-- Products will be loaded here -->
            </div>
        </div>
    </section>

    <!-- Video Section -->
    @if($videoEnabled)
    <section class="video-section" style="padding: 60px 0;">
        <div class="container">
            <div style="position: relative; width: 100%; max-width: 900px; margin: 0 auto; padding-top: 0; border-radius: 16px; overflow: hidden; box-shadow: 0 12px 40px rgba(0,0,0,0.15);">
                <div style="position: relative; padding-top: 56.25%;">
                    <iframe src="{{ $videoEmbed }}" style="position: absolute; inset: 0; width: 100%; height: 100%; border: 0;" allow="autoplay; encrypted-media; fullscreen" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Call To Action Section -->
    @if($ctaEnabled)
    <section class="cta-section" style="padding: 70px 0; background: {{ $wsCta['bg_color'] ?? '#f8f9fa' }};">
        <div class="container" style="text-align: center;">
            <h2 style="font-size: 2.2rem; font-weight: 800; color: var(--dark-color); margin-bottom: 0.75rem;">{{ $wsCta['title'] ?? 'Ready to get started?' }}</h2>
            @if(!empty($wsCta['description']))
                <p style="color: #6c757d; font-size: 1.1rem; max-width: 640px; margin: 0 auto 1.75rem;">{{ $wsCta['description'] }}</p>
            @endif
            @if(!empty($wsCta['btn_text']))
                <a href="{{ $wsCta['btn_link'] ?: '#' }}" class="btn-primary-custom">{{ $wsCta['btn_text'] }}</a>
            @endif
        </div>
    </section>
    @endif
</main>

<script>
    const brands = @json($brands);
    let currentBrandId = null;
    let currentCategoryId = null;

    function showBrands() {
        document.getElementById('brands-section').style.display = 'block';
        document.getElementById('categories-section').style.display = 'none';
        document.getElementById('products-section').style.display = 'none';
        currentBrandId = null;
        currentCategoryId = null;
    }

    function showCategories(brandId) {
        currentBrandId = brandId;
        const brand = brands.find(b => b.id === brandId);
        
        if (!brand) return;
        
        document.getElementById('brand-name').textContent = brand.name + ' - Categories';
        
        const categoriesContainer = document.getElementById('categories-container');
        categoriesContainer.innerHTML = '';
        
        if (brand.categories && brand.categories.length > 0) {
            brand.categories.forEach(cat => {
                const colDiv = document.createElement('div');
                colDiv.className = 'col-md-4';
                
                const categoryCard = `
                    <div class="category-card" onclick="showProducts(${brandId}, ${cat.id})">
                        ${cat.categorie_img ? 
                            `<img src="{{ $category_img_url }}${cat.categorie_img}" alt="${cat.name}">` : 
                            `<img src="{{ asset('images/default-category.png') }}" alt="${cat.name}">`
                        }
                        <div class="category-card-body">
                            <h4>${cat.name}</h4>
                            <button class="btn-primary-custom" onclick="showProducts(${brandId}, ${cat.id})" style="margin-top: 1rem; font-size: 0.9rem; padding: 0.6rem 1.5rem;">Voir plus</button>
                        </div>
                    </div>
                `;
                
                colDiv.innerHTML = categoryCard;
                categoriesContainer.appendChild(colDiv);
            });
        } else {
            categoriesContainer.innerHTML = '<div class="col-md-12"><p style="text-align: center; color: #6c757d;">No categories available for this brand.</p></div>';
        }
        
        document.getElementById('brands-section').style.display = 'none';
        document.getElementById('categories-section').style.display = 'block';
        document.getElementById('products-section').style.display = 'none';
    }

    function showProducts(brandId, categoryId) {
        currentBrandId = brandId;
        currentCategoryId = categoryId;
        
        const brand = brands.find(b => b.id === brandId);
        if (!brand) return;
        
        const category = brand.categories.find(c => c.id === categoryId);
        if (!category) return;
        
        document.getElementById('category-name').textContent = category.name;
        document.getElementById('category-description').textContent = `Available ${category.name} motorcycles`;
        
        const productsContainer = document.getElementById('products-container');
        productsContainer.innerHTML = '';
        
        if (category.variants && category.variants.length > 0) {
            category.variants.forEach(variant => {
                if (variant.products && variant.products.length > 0) {
                    variant.products.forEach(product => {
                        const colDiv = document.createElement('div');
                        colDiv.className = 'col-md-4';
                        
                        const productCard = `
                            <div class="product-card" style="border-top: 3px solid #FF7A00;">
                                <div class="product-image">
                                    ${product.image ? 
                                        `<img src="{{ $product_img_url }}${product.image}" alt="${product.name}">` : 
                                        (variant.image ? 
                                            `<img src="{{ $variant_img_url }}${variant.image}" alt="${variant.name}">` :
                                            `<div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#fff3e0;"><svg width='80' height='80' viewBox='0 0 24 24' fill='#FF7A00'><path d='M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z'/></svg></div>`
                                        )
                                    }
                                    <span class="product-badge" style="background: linear-gradient(90deg,#FF7A00,#FF9A00);">Disponible</span>
                                </div>
                                <div class="product-body">
                                    <h3 class="product-title">${variant.name}</h3>
                                    <div class="product-price">${variant.price} ${product.currency || 'DH'}</div>
                                    <div style="display: flex; gap: 0.5rem; margin-top: 1rem;">
                                        <a href="#" class="btn-primary-custom" onclick="contactUs('${product.SKU}', '${variant.name}'); return false;" style="flex: 1; text-align: center; font-size: 0.85rem; padding: 0.6rem 1rem;">Contact Us</a>
                                        <a href="https://wa.me/212666666666?text=I'm%20interested%20in%20${encodeURIComponent(variant.name)}%20-%20SKU:%20${encodeURIComponent(product.SKU)}" target="_blank" class="btn-primary-custom" style="flex: 1; text-align: center; font-size: 0.85rem; padding: 0.6rem 1rem; background: linear-gradient(90deg, #25D366, #128C7E);">Contact Us on WhatsApp</a>
                                    </div>
                                </div>
                            </div>
                        `;
                        
                        colDiv.innerHTML = productCard;
                        productsContainer.appendChild(colDiv);
                    });
                }
            });
        }
        
        if (productsContainer.innerHTML === '') {
            productsContainer.innerHTML = '<div class="col-md-12"><p style="text-align: center; color: #6c757d;">No products available in this category.</p></div>';
        }
        
        document.getElementById('brands-section').style.display = 'none';
        document.getElementById('categories-section').style.display = 'none';
        document.getElementById('products-section').style.display = 'block';
    }

    function contactUs(sku, productName) {
        alert(`Merci pour votre intérêt pour ${productName}\nN° Châssis: ${sku}\n\nVeuillez nous contacter pour plus d'informations.`);
    }
</script>
@endsection
