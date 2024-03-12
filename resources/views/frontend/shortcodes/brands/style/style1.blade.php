<p>qsdqs</p>
<p>qsdqs</p>


@foreach(explode(',', $Brands) as $BrandsId)
    @foreach($Brandss as $Brandy)
        @if($Brandy->id == $BrandsId)



            <div class="logos">
                <div class="logos-slide">
                    @php
                        $imageArray = json_decode($Brandy->image, true);
                        $firstImage = isset($imageArray[0]) ? $imageArray[0] : null;
                    @endphp

                    @if($firstImage)
                        <img src="{{ asset('storage/Images/general/' . $firstImage) }}" alt="Brand Image">
                    @else
                        No image available
                    @endif 
                </div>
            </div>
            <script>
                var copy = document.querySelector(".logos-slide").cloneNode(true);
                document.querySelector(".logos").appendChild(copy);
            </script>


        @endif
    @endforeach
@endforeach

