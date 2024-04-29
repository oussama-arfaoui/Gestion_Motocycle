<x-page-head />



<body class="website antialiased">

    @include('frontend.layouts.header')
    <main class="project_details_style1 global_container">

        <h1>{{$blog->title }}</h1>

        <section class="project_details_style1-overview">
            <div class="project_details_style1-overview-image">
                <img src="{{ asset('storage/Images/general/' . json_decode($blog->image)[0]) }}"
                    alt="Main Project image">
            </div>

            <div class="project_details_style1-overview-text">
                <h2>
                     @php
                    $category = \App\Models\BlogsCategories::find($blog->category_id);
                    if($category) {
                        echo $category->name;
                    } else {
                        echo 'N/A';
                    }
                    @endphp
                </h2>
                <p>{{$blog->content }}</p>
              
            </div>
        </section>
    </main>


    @include('frontend.layouts.footer')
</body>


</html>