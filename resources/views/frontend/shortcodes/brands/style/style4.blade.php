<div class="brands_style4">
    <div class="brands_style4-content global_container">

        <h2>Nos Partenaires et Marques de Confiance</h2>

        <p>La puissance des meilleures équipes du monde, des startups de nouvelle génération aux entreprises établies.</p>

        <div class="brands_style4-content-cards">

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
