{{-- Style 1 File --}}

<section class="products_list_style1 global_container">

    <h2 class="products_list_style1-title">{{$title}}</h2>
    
    <div class="products_list_style1-items">
        @foreach(explode(',', $Projects) as $ProjectsId)
            @foreach($Projectss as $Projecty)
                @if($Projecty->id == $ProjectsId)

                        <div class="products_list_style1-items-item">
                            <div class="products_list_style1-items-item-tag">
                                <p>{{ optional($Projecty->projectscategory)->category_name ?? 'null' }}</p>
                            </div>
                    
                            @php
                            $imageArray = json_decode($Projecty->images, true);
                            $firstImage = isset($imageArray[0]) ? $imageArray[0] : null;
                            @endphp
                                    @if($firstImage)
                                    <img src="{{ asset('storage/Images/general/' . $firstImage) }}" alt="Brand Image">
                                    @else
                                    No image available
                                    @endif
                    
                            <h3>{{ $Projecty->projects_title }}</h3>
                           
                            <x-primary_button path="{{ route('projects.show', $Projecty->id) }}" text="Filler text"></x-primary_button>
                        </div>
            
                @endif
            @endforeach
        @endforeach
    </div>


</section>
<script>
    if(document.querySelector(".logos-slide")){
        var copy = document.querySelector(".logos-slide").cloneNode(true);
        document.querySelector(".logos").appendChild(copy);
    }
</script>