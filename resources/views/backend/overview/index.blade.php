@extends('backend.layouts.admin-dashboard')


@section('content')

<div class="dashboard-main-container">

    <div class="overview__title">
        <h1>Welcome Home, Username</h1>
    </div>

    <div class="overview__section">
        <h2 class="overview__section-title">Get back into the process:</h2>

        <div class="overview__section-cards">
            <div class="overview__section-cards-card">
                <a href="#">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                        d="M9.75 1.5H4.5C4.10218 1.5 3.72064 1.65804 3.43934 1.93934C3.15804 2.22064 3 2.60218 3 3V15C3 15.3978 3.15804 15.7794 3.43934 16.0607C3.72064 16.342 4.10218 16.5 4.5 16.5H13.5C13.8978 16.5 14.2794 16.342 14.5607 16.0607C14.842 15.7794 15 15.3978 15 15V6.75L9.75 1.5Z"
                        stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.75 1.5V6.75H15" stroke-opacity="0.75" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    </svg>
                    <span>Pages</span>
                </a>
            </div>
        </div>
    </div>

</div>

@endsection