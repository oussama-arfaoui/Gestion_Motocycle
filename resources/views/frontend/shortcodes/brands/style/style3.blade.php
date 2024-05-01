<div class="brands_style3">
    <div class="brands_style3-content">

        <h2>DES ENTREPRISES À CROISSANCE RAPIDE DE PLUS DE 125 PAYS NOUS FONT CONFIANCE</h2>

        <div class="brands_style3-content-cards">

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
