<x-page-head />

<body class="website antialiased">

    @include('frontend.layouts.header')

    <main class="project_details_style1 global_container">

        <h1>{{ $service->service_title }}</h1>

        <section class="project_details_style1-overview">
            <div class="project_details_style1-overview-image">
                <img src="{{ asset('storage/Images/general/' . json_decode($service->images)[0]) }}"
                    alt="Main Project image">
            </div>

            <div class="project_details_style1-overview-text">
                <h2>{{ $service->service_subtitle }}</h2>
                <p>{{ $service->service_description }}</p>

                <ul>
                    @if ($service->points)
                    @foreach(json_decode($service->points) as $point)
                    <li>
                        <x-check-icon /><span>{{ $point }}</span>
                    </li>
                    @endforeach
                    @else
                    <li>No points available</li>
                    @endif
                </ul>



                <p class="project_details_style1-overview-text-characteristics">
                    {{ $service->characteristics }}
                </p>

                <div class="project_details_style1-overview-text-table-container">
                    <table class="project_details_style1-overview-text-table-container-table">
                        <thead>
                            <td>Caractéristique</td>
                            <td>Données</td>
                        </thead>
                        @if(!is_null($service->attributes))
                        @foreach(json_decode($service->attributes, true) as $name => $value)
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

    </main>

    @include('frontend.layouts.footer')

    <x-floating-actions />
</body>

</html>