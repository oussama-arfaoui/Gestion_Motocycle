<x-page-head />

<body class="website antialiased">

    @include('frontend.layouts.header')

    <main class="project_categories_list_style1 global_container">

        {{--
        <!-- Category Filter -->
        <select id="category-filter">
            <option value="all">Tous Les Categories</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
            @endforeach
        </select> --}}

        <div class="project_categories_list_style1-filter" id="category-buttons">
            <button class="category-button project-category-activated" data-category="all">Tous Les Categories</button>
            @foreach($categories as $category)
            <button class="category-button" data-category="{{ $category->id }}">{{ $category->category_name }}</button>
            @endforeach
        </div>


        <!-- Projects List -->
        <div class="project_categories_list_style1-categories">
            @foreach($categories as $category)
            <div class="project_categories_list_style1-categories-category" id="category-{{ $category->id }}">
                <a href="/projects-categories/{{ $category->id }}"
                    class="project_categories_list_style1-categories-category-title">{{ $category->category_name }}</a>
                <p class="project_categories_list_style1-categories-category-description">{{ $category->description }}
                </p>
                <ul class="project_categories_list_style1-categories-category-items">
                    @foreach($category->projects as $project)
                    <a href="projects/{{$project->id}}"
                        class="project_categories_list_style1-categories-category-items-item">
                        <!-- Check if images exist for the project -->
                        @if($project->images)
                        @php
                        $imageArray = json_decode($project->images, true);
                        $firstImage = isset($imageArray[0]) ? $imageArray[0] : null;
                        @endphp
                        <!-- Check if the first image exists -->
                        @if($firstImage)
                        <!-- Display the first image -->
                        <img src="{{ asset('storage/Images/general/' . $firstImage) }}" alt="project Image">
                        @else
                        <p>No image available</p>
                        @endif
                        @else
                        <p>No image available</p>
                        @endif
                        <h3>{{ $project->projects_title }}</h3> <!-- Corrected property name -->
                    </a>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </main>


    @include('frontend.layouts.footer')

    <x-floating-actions />
</body>

<!-- frontend/pages/projects_categories_list.blade.php -->





<script>
    // // Filter projects by category
    // document.getElementById('category-filter').addEventListener('change', function() {
    //     var categoryId = this.value;
    //     var allCategories = document.querySelectorAll('.category-projects');
        
    //     allCategories.forEach(function(category) {
    //         if (categoryId === 'all' || category.id === 'category-' + categoryId) {
    //             category.style.display = 'block';
    //         } else {
    //             category.style.display = 'none';
    //         }
    //     });
    // });


    document.querySelectorAll('.category-button').forEach(function(button) {
    button.addEventListener('click', function() {

    var categoryId = this.getAttribute('data-category');
    
    var allCategories = document.querySelectorAll('.project_categories_list_style1-categories-category');
    var allButtons = document.querySelectorAll('.category-button');
    
    allButtons.forEach(function(btn) {
    if (btn === button) {
    btn.classList.add('project-category-activated');
    } else {
    btn.classList.remove('project-category-activated');
    }
    });
    
    allCategories.forEach(function(category) {
    
        if (categoryId === 'all' || category.id === 'category-' + categoryId) {
            category.style.display = 'block';
            } else {
            category.style.display = 'none';
            }
        
        }); 
    });
    
    });
</script>

</html>