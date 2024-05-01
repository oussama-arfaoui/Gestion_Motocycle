<x-page-head />



<body class="website antialiased">

    @include('frontend.layouts.header')
    
    <section class="featured_article_style1 global_container">
        <div class="featured_article_style1-title">
            <x-blog-icon></x-blog-icon>
            <h2 class="featured_article_style1-title-h2">{{ $blogcategories->name }}</h2>
        </div>
    
    
        <div class="featured_article_style1-featured">
    
            <div class="project_details_style1-overview-image">
                @if ($blogcategories && $blogcategories->image && json_decode($blogcategories->image))
                    <img src="{{ asset('storage/Images/general/' . json_decode($blogcategories->image)[0]) }}"
                        alt="Main Project image">
                @else
                    <p>No image available</p>
                @endif
            </div>
            
    
            <div class="featured_article_style1-featured-text">
                <h3>{{  $blogcategories->name }}</h3>
                <p>{{ $blogcategories->description }}</p>
                <x-primary_button path='/actualites' text=''></x-primary_button>
            </div>
    
        </div>
    
        <div class="products_categories_list_style1-items">
            @foreach($blogs as $blog)   <!-- hadi loop dyal all blog dyal had category  -->
            <div class="products_categories_list_style1-items-item">
                <div class="products_categories_list_style1-items-item-tag">
                    <p>{{ $blog->title }}</p>
                </div>
                <!-- Check if images exist for the product -->
                @if($blog->image)
                @php
                $imageArray = json_decode($blog->image, true);
                $firstImage = isset($imageArray[0]) ? $imageArray[0] : null;
                @endphp
                <!-- Check if the first image exists -->
                @if($firstImage)
                <!-- Display the first image -->
                <img src="{{ asset('storage/Images/general/' . $firstImage) }}" alt="Product Image">
                @else
                <p>No image available</p>
                @endif
                @else
                <p>No image available</p>
                @endif
                <!-- Check if images exist for the product -->
                <h3>{{ $blog->title }}</h3>
                <x-primary_button path="{{ route('blogs.show', $blog->id) }}" text="Découvrir Plus"></x-primary_button>
            </div>
            @endforeach <!-- hadi loop dyal all blog dyal had category  -->
            
        </div>

    </section>

    @include('frontend.layouts.footer')
</body>


</html>