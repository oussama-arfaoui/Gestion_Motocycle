{{-- Style 1 File --}}

<section class="featured_article_style1 global_container">

    <div class="featured_article_style1-title">
        <x-blog-icon></x-blog-icon>
        <h2 class="featured_article_style1-title-h2">{{ $title }}</h2>
    </div>


    <div class="featured_article_style1-featured">
        <div class="featured_article_style1-featured-image">
            <img src="./blogs/blog-1.jpg" alt="project-image">
        </div>

        <div class="featured_article_style1-featured-text">
            <h3>{{ $article_title }}</h3>
            <p>{{ $article_description }}</p>
            <x-primary_button path='/actualites' text='{{$article_button}}'></x-primary_button>
        </div>

    </div>


</section>