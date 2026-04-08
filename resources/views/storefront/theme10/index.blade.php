@extends('storefront.layout.theme10')

@section('content')
<main class="text-center">

    {{-- List of Brands --}}
    <section class="brands-section py-5">
        <h2>Brands</h2>
        <div class="d-flex justify-center flex-wrap gap-4">
            @foreach($brands as $brand)
                <div class="brand-card" onclick="showCategories({{ $brand->id }})" style="cursor:pointer;">
                    <img src="{{ $brand->logo ? asset('uploads/brand/' . $brand->logo) : asset('images/default-brand.png') }}" alt="{{ $brand->name }}" width="150">
                    <p>{{ $brand->name }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Categories (hidden initially) --}}
    <section class="categories-section py-5" id="categories-section" style="display:none;">
        <h2>Categories</h2>
        <div id="categories-container" class="d-flex justify-center flex-wrap gap-4">
            {{-- JS will fill this --}}
        </div>
    </section>

    {{-- Variants (hidden initially) --}}
    <section class="variants-section py-5" id="variants-section" style="display:none;">
        <h2>Variants</h2>
        <div id="variants-container" class="d-flex justify-center flex-wrap gap-4">
            {{-- JS will fill this --}}
        </div>
    </section>

</main>

<script>
    const brands = @json($brands);

    function showCategories(brandId) {
        const brand = brands.find(b => b.id === brandId);
        const categoriesContainer = document.getElementById('categories-container');
        categoriesContainer.innerHTML = '';
        brand.categories.forEach(cat => {
            const catBtn = document.createElement('button');
            catBtn.innerText = cat.name;
            catBtn.className = 'btn btn-primary m-2';
            catBtn.onclick = () => showVariants(cat);
            categoriesContainer.appendChild(catBtn);
        });
        document.getElementById('categories-section').style.display = 'block';
        document.getElementById('variants-section').style.display = 'none';
    }

    function showVariants(category) {
        const variantsContainer = document.getElementById('variants-container');
        variantsContainer.innerHTML = '';
        category.variants.forEach(variant => {
            const varCard = document.createElement('div');
            varCard.className = 'card m-2 p-3 border';
            let html = `<h5>${variant.name} (Price: ${variant.price} DH, Qty: ${variant.products.length})</h5>`;
            variant.products.forEach(prod => {
                html += `<p>SKU: ${prod.SKU}</p>`;
            });
            html += `<button class="btn btn-success mt-2">Command</button>`;
            varCard.innerHTML = html;
            variantsContainer.appendChild(varCard);
        });
        document.getElementById('variants-section').style.display = 'block';
    }
</script>
@endsection
