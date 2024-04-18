{{-- Style 2 File --}}

<section class="articles_list_style2 global_container">

    <div class="articles_list_style2-title">
        <x-blog-icon></x-blog-icon>
        <h2 class="articles_list_style2-title-h2">{{ $title }}</h2>
    </div>

    <div class="articles_list_style2-items">

        <div class="articles_list_style2-items-item">
            <div class="articles_list_style2-items-item-image">
                <img src="./blogs/post1.jpg" alt="project-image">
            </div>

            <div class="articles_list_style2-items-item-text">
                <h3>{{ $article_title }}</h3>
                <p>{{ $article_description }}</p>
                <x-primary_button path='#' text='{{$article_button}}'></x-primary_button>
            </div>
        </div>

    </div>


</section>