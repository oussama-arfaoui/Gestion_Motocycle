{{-- Style 1 File --}}

<section class="articles_list_style1 global_container">

    <div class="articles_list_style1-title">
        <x-blog-icon></x-blog-icon>
        <h2 class="articles_list_style1-title-h2">{{ $title }}</h2>
    </div>


    <div class="articles_list_style1-item">
        <div class="articles_list_style1-item-image">
            <img src="./blogs/blog-1.jpg" alt="project-image">
        </div>

        <div class="articles_list_style1-item-text">
            <h3>{{ $article_title }}</h3>
            <p>{{ $article_description }}</p>
            <x-primary_button path='#' text='{{$article_button}}'></x-primary_button>
        </div>

    </div>
    
    <div class="articles_list_style1-item">
        <div class="articles_list_style1-item-image">
            <img src="./blogs/blog-1.jpg" alt="project-image">
        </div>

        <div class="articles_list_style1-item-text">
            <h3>{{ $article_title }}</h3>
            <p>{{ $article_description }}</p>
            <x-primary_button path='#' text='{{$article_button}}'></x-primary_button>
        </div>

    </div>

    <div class="articles_list_style1-item">
        <div class="articles_list_style1-item-image">
            <img src="./blogs/blog-1.jpg" alt="project-image">
        </div>

        <div class="articles_list_style1-item-text">
            <h3>{{ $article_title }}</h3>
            <p>{{ $article_description }}</p>
            <x-primary_button path='#' text='{{$article_button}}'></x-primary_button>
        </div>

    </div>

    <div class="articles_list_style1-item">
        <div class="articles_list_style1-item-image">
            <img src="./blogs/blog-1.jpg" alt="project-image">
        </div>

        <div class="articles_list_style1-item-text">
            <h3>{{ $article_title }}</h3>
            <p>{{ $article_description }}</p>
            <x-primary_button path='#' text='{{$article_button}}'></x-primary_button>
        </div>

    </div>


</section>