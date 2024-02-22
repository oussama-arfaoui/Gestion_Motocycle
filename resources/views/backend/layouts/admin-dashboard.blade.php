<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Carbon - Admin Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/scss/style.scss', 'resources/js/app.js'])
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
</body>

</html>