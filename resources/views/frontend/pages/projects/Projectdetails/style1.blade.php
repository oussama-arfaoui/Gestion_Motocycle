<x-page-head />

<body class="website antialiased">

    @include('frontend.layouts.header')

    <main class="project_details_style1 global_container">

        <h1>{{ $project->projects_title }}</h1>

        <section class="project_details_style1-overview">
            <div class="project_details_style1-overview-image">
                <img src="{{ asset('storage/Images/general/' . json_decode($project->images)[0]) }}"
                    alt="Main Project image">
            </div>

            <div class="project_details_style1-overview-text">
                <h2>{{ $project->projects_subtitle }}</h2>
                <p>{{ $project->projects_description }}</p>

                <ul>
                    @if ($project->points)
                    @foreach(json_decode($project->points) as $point)
                    <li>
                        <x-check-icon /><span>{{ $point }}</span>
                    </li>
                    @endforeach
                    @else
                    <li>No points available</li>
                    @endif
                </ul>



                <p class="project_details_style1-overview-text-characteristics">
                    {{ $project->characteristics }}
                </p>

                <div class="project_details_style1-overview-text-table-container">
                    <table class="project_details_style1-overview-text-table-container-table">
                        <thead>
                            <td>Caractéristique</td>
                            <td>Données</td>
                        </thead>
                        @if(!is_null($project->attributes))
                        @foreach(json_decode($project->attributes, true) as $name => $value)
                        <tr>
                            <td>{{ $name }}</td>
                            <td>{{ $value }}</td>
                        </tr>
                        @endforeach
                        @endif
                    </table>
                </div>


            </div>
        </section>

        {{-- <section class="project_details_style1-banner">

            <div class="project_details_style1-banner-logo">
                <img src="./logos/primary-logo.svg" alt="">
            </div>

            <h2>{{ $project->project_name }}</h2>
            <p>
                <a href="{{ route('projects-categories.show', $project->projectscategory->id) }}">
                    {{ $project->projectscategory->category_name }}
                </a>
            </p>
        </section>

        <section class="project_details_style1-hero">
            <div class="project_details_style1-hero-image-container">
                <div id="zoom-container">
                    <img id="zoom-image" src="{{ asset('storage/Images/general/' . json_decode($project->images)[0]) }}"
                        alt="Thumbnail 1" class="project_details_style1-hero-image-container-image">
                </div>

                <div class="project_details_style1-hero-thumbnails">
                    <button class="project_details_style1-hero-prev-btn">
                        <svg class="with-icon_icon__MHUeb" data-testid="geist-icon" fill="none" height="24"
                            shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"
                            style="color:var(--geist-foreground);width:24px;height:24px">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                    </button>

                    @foreach(json_decode($project->images) as $image)
                    <img src="{{ asset('storage/Images/general/' . $image) }}" alt="Thumbnail"
                        class="project_details_style1-hero-thumbnails-item">
                    @endforeach

                    <button class="project_details_style1-hero-next-btn">
                        <svg class="with-icon_icon__MHUeb" data-testid="geist-icon" fill="none" height="24"
                            shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"
                            style="color:var(--geist-foreground);width:24px;height:24px">
                            <path d="M9 18l6-6-6-6" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="project_details_style1-hero-details-container">
                <div class="project_details_style1-hero-details-container-detail">
                    <h2>Description de project:</h2>
                    <p>{{ $project->project_description }}</p>
                    <ul>
                        @if ($project->points)
                        @foreach(json_decode($project->points) as $point)
                        <li>
                            <x-check-icon /><span>{{ $point }}</span>
                        </li>
                        @endforeach
                        @else
                        <li>No points available</li>
                        @endif
                    </ul>
                    <x-sell_button text='Demandez Un Devis' path="tel: {{$contact_number}}"></x-sell_button>
                </div>
            </div>
        </section>


        <section class="project_details_style1-technicals">

            <div class="project_details_style1-technicals-text">
                <h3 class="project_details_style1-technicals-text-title">Charactéristiques techniques:</h3>

                <p class="project_details_style1-technicals-text-description">
                    {{ $project->characteristics }}
                </p>
            </div>

            <div class="project_details_style1-technicals-table-container">
                <table class="project_details_style1-technicals-table-container-table">
                    <thead>
                        <td>Caractéristique</td>
                        <td>Données</td>
                    </thead>
                    @if(!is_null($project->attributes))
                    @foreach(json_decode($project->attributes, true) as $name => $value)
                    <tr>
                        <td>{{ $name }}</td>
                        <td>{{ $value }}</td>
                    </tr>
                    @endforeach
                    @endif
                </table>
            </div>
        </section> --}}
    </main>

    @include('frontend.layouts.footer')

    <x-floating-actions />
</body>

</html>