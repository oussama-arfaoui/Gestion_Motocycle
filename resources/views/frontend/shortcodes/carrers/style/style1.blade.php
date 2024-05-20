@php
    $jobcategories = App\Models\JobCategories::all();
    $carriercategories = App\Models\CarrierCategories::all();
@endphp

<section class="featured_article_style1 global_container">

    <div class="featured_article_style1-title">
        <x-blog-icon></x-blog-icon>
        <h2 class="featured_article_style1-title-h2">{{ $title }}</h2>
    </div>
                {{--filter of shit
                    <!-- Dropdown for filtering by Job Category -->
                    <div class="node-input">
                        <label for="job_category_filter" class="form-label">Filter by Job Category</label>
                        <select name="job_category_filter" id="job_category_filter" class="form-control">
                            <option value="">All Categories</option>
                            @foreach($jobcategories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Dropdown for filtering by Carrier Category -->
                    <div class="node-input">
                        <label for="carrier_category_filter" class="form-label">Filter by Carrier Category</label>
                        <select name="carrier_category_filter" id="carrier_category_filter" class="form-control">
                            <option value="">All Categories</option>
                            @foreach($carriercategories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                --}}

    <div id="filtered_data">
        @foreach($Carrerss as $carrier)
        <div class="featured_article_style1-featured">          
            <div class="featured_article_style1-featured-text">
                <h3>{{ $carrier->title }}</h3>
                <p>description: {{ $carrier->description }}</p>
                <p>requirements: {{ $carrier->requirements }}</p>
                <p>location: {{ $carrier->location }}</p>
                <p>time: {{ $carrier->time }}</p>
                <p>jobCategory: {{ $carrier->jobCategory->name }}</p>
                <p>carrierCategory: {{ $carrier->carrierCategory->name }}</p>

                @if($carrier->is_job_offer)
                <x-primary_button path='/' text='I am applying'></x-primary_button>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    
</section>


