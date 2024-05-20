<div class="logos">
    <div class="logos-slide">

        @foreach(explode(',', $Carrers) as $CarrersId)
            @foreach($Carrerss as $Carrery)

            {{$Carrery->title}}

            
            @endforeach
        @endforeach


    </div>
</div>

<script>
    if(document.querySelector(".logos-slide")){
        var copy = document.querySelector(".logos-slide").cloneNode(true);
        document.querySelector(".logos").appendChild(copy);
    }
</script>