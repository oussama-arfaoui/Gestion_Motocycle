@extends('storefront.layout.theme10')
@section('page-title', __('Products'))

@section('content')
<main>
    {{-- Brands Horizontal Scroll --}}
    <section class="brands-section py-5 text-center">
        <h2>{{ __('Brands') }}</h2>
        <div class="scroll-container">
            <button class="scroll-btn left" onclick="scrollBrandsLeft()">&#9664;</button>
            <div class="container" id="brands-container">
                @foreach($brands as $brand)
                    <div class="card brand-card" onclick="filterByBrand({{ $brand->id }})">
                        <img src="{{ $brand->brand_img ? $brand_logo . $brand->brand_img : asset('images/default-brand.png') }}" width="100">
                        <p>{{ $brand->name }}</p>
                    </div>
                @endforeach
            </div>
            <button class="scroll-btn right" onclick="scrollBrandsRight()">&#9654;</button>
        </div>
    </section>

    {{-- Categories Horizontal Scroll --}}
    <section class="categories-section py-5 text-center" id="categories-section">
        <h2>{{ __('Categories') }}</h2>
        <div class="scroll-container">
            <button class="scroll-btn left" onclick="scrollCategoriesLeft()">&#9664;</button>
            <div class="container" id="categories-container">
                {{-- Filled dynamically by JS --}}
            </div>
            <button class="scroll-btn right" onclick="scrollCategoriesRight()">&#9654;</button>
        </div>
    </section>
    
<section class="product-variants py-5 text-center">
    <h2>{{ __('Variants') }}</h2>
    <div class="container">
        <div class="row g-4">
            @foreach($variants as $variant)
                <div class="col-12 col-md-4"> {{-- 3 per row on md+ --}}
                    <div class="variant-card d-flex flex-column h-100">
                        <img class="variant-img mb-3" 
                             src="{{ $variant->image ? $product_variant_logo . $variant->image : 'https://via.placeholder.com/320x320' }}" 
                             alt="{{ $variant->name }}">
                        <h5 class="variant-name mb-2">{{ $variant->name }}</h5>
                        <p class="variant-price text-muted mb-3">{{ number_format($variant->price, 2) }} DH</p>
                        <button class="btn btn-primary btn-variant mt-auto" data-variant-id="{{ $variant->id }}">
                            Commander
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

   
</main>

<script>
const brandsData = @json($brands); // contains categories and variants
let allVariants = @json($variants);

function renderCategories(categories) {
    const container = document.getElementById('categories-container');
    container.innerHTML = '';
    categories.forEach(cat => {
        const div = document.createElement('div');
        div.className = 'card category-card';
        div.innerHTML = `
            <img src="{{ $store_logo }}${cat.categorie_img ?? 'default-cat.png'}" width="100">
            <p style="cursor:pointer;" onclick="filterByCategory(${cat.id})">${cat.name}</p>
        `;
        container.appendChild(div);
    });
}

function renderVariants(variants) {
    const container = document.querySelector('.product-variants .row');
    container.innerHTML = '';
    variants.forEach(variant => {
        const div = document.createElement('div');
        div.className = 'col-12 col-md-4';
        div.innerHTML = `
            <div class="variant-card d-flex flex-column h-100">
                <img class="variant-img mb-3" src="{{ $product_variant_logo }}${variant.image ?? ''}" alt="${variant.name}">
                <h5 class="variant-name mb-2">${variant.name}</h5>
                <p class="variant-price text-muted mb-3">${parseFloat(variant.price).toFixed(2)} DH</p>
                <button class="btn btn-primary btn-variant mt-auto" data-variant-id="${variant.id}">
                    Commander
                </button>
            </div>
        `;
        container.appendChild(div);
    });
}

// Filter by Brand
function filterByBrand(brandId) {
    const brand = brandsData.find(b => b.id === brandId);
    if (!brand) return;

    // Render brand categories and variants
    renderCategories(brand.categories);
    let brandVariants = [];
    brand.categories.forEach(cat => {
        brandVariants = brandVariants.concat(cat.variants);
    });
    renderVariants(brandVariants);
}

// Filter by Category
function filterByCategory(categoryId) {
    const filteredVariants = allVariants.filter(v => v.category_id == categoryId);
    renderVariants(filteredVariants);
}
</script>



<style>
/* Scrollable Sections */
.scroll-container {
    display: flex;
    align-items: center;
    position: relative;
    margin-bottom: 20px;
}

.scroll-container .container {
    display: flex;
    overflow-x: auto;
    scroll-behavior: smooth;
    white-space: nowrap;
    padding: 20px 0;
    border-radius: 10px;
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    scrollbar-width: none;
    -ms-overflow-style: none;
}
.scroll-container .container::-webkit-scrollbar {
    display: none;
}

/* Card inside scroll */
.card {
    flex: 0 0 auto;
    width: 100px;
    margin-right: 15px;
    padding: 10px;
    background-color: #fafafa;
    border: 1px solid #ddd;
    border-radius: 15px;
    text-align: center;
    cursor: pointer;
    transition: transform 0.2s;
}
.card img {
    margin-bottom: 10px;
    border-radius: 8px;
}
.card:hover {
    transform: scale(1.05);
}

/* Scroll Buttons */
.scroll-btn {
    background-color: rgba(255, 255, 255, 0.9);
    border: none;
    font-size: 28px;
    cursor: pointer;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Align buttons with container */
.scroll-btn.left {
    left: calc((100% - 1200px)/2);
}
.scroll-btn.right {
    right: calc((100% - 1200px)/2);
}

/* Product Variants Section */
.product-variants h2 {
    margin-bottom: 2rem;
    font-weight: 700;
    font-size: 2rem;
}

/* Variant Card */
.variant-card {
    width: 100%;
    max-width: 350px;
    background-color: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 16px;
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    transition: transform 0.3s, box-shadow 0.3s;
    margin: 0 auto;
}

.variant-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
}

.variant-img {
    width: 100%;
    height: auto;
    max-height: 300px;
    border-radius: 14px;
    object-fit: cover;
    margin-bottom: 1rem;
}

.variant-name {
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.variant-price {
    font-size: 1.2rem;
    color: #555;
    margin-bottom: 1rem;
}

.btn-variant {
    border-radius: 50px;
    padding: 0.75rem 2rem;
    font-weight: 700;
    font-size: 1.1rem;
}

/* Responsive Grid for Variants */
@media (max-width: 991px) {
    .variant-card {
        max-width: 300px;
    }
    .scroll-btn.left,
    .scroll-btn.right {
        left: 10px;
        right: 10px;
    }
}

@media (max-width: 767px) {
    .variant-card {
        max-width: 100%;
        padding: 1rem;
    }
    .variant-img {
        max-height: 200px;
    }
    .variant-name {
        font-size: 1.2rem;
    }
    .variant-price {
        font-size: 1rem;
    }
    .btn-variant {
        padding: 0.5rem 1.5rem;
        font-size: 1rem;
    }
    .scroll-btn {
        width: 35px;
        height: 35px;
        font-size: 24px;
    }
}

/* Mobile smaller screens */
@media (max-width: 480px) {
    .scroll-btn.left,
    .scroll-btn.right {
        left: 5px;
        right: 5px;
    }
    .card {
        width: 80px;
        padding: 5px;
    }
}

</style>
@endsection
