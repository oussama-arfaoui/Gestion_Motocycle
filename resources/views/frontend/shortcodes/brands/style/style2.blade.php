<div class="brands_style2 global_container">
    <div class="brands_style2-content">

        <h2>Nos Partenaires et Marques de Confiance</h2>

        <div class="brands_style2-content-cards">

            @foreach(explode(',', $Brands) as $BrandsId)
            @foreach($Brandss as $Brandy)
            @if($Brandy->id == $BrandsId)

            @php
            $imageArray = json_decode($Brandy->image, true);
            $firstImage = isset($imageArray[0]) ? $imageArray[0] : null;
            @endphp

            @if($firstImage)
            <img src="{{ asset('storage/Images/general/' . $firstImage) }}" alt="Brand Image">
            @else
            No image available
            @endif

            @endif

            @endforeach
            @endforeach
        </div>

    </div>
</div>
