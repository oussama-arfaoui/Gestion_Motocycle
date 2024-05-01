<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/svg+xml" href="/favicon/favicon.svg">
    <link rel="icon" type="image/png" href="/favicon/favicon.png">
    <title>{{ $page_title }}</title>

    @vite(['resources/css/app.css', 'resources/scss/style.scss', 'resources/js/app.js', 'resources/js/swiper.js'])

    {{-- Swiper JS --}}
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

</head>

<body class="dashboard antialiased">

    {{-- Sidebar --}}
    <div>
        @include('backend.layouts.dashboard-sidebar')
    </div>

    <div>
        {{-- Header --}}
        @include('backend.layouts.dashboard-header')

        {{-- Main --}}
        @yield('content')
    </div>

    <div id="dashboard_notification" class="dashboard_notification remove_notif">
        <p id="dashboard_notification_text" class="dashboard_notification-text">This is a Notification</p>
        <button id="closeDbNotification"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M12 4L4 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M4 4L12 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg></button>
    </div>
</body>

{{-- <script src="{{asset('/build/assets/app-BpNRfwSz.js')}}"></script>--}}

</html>