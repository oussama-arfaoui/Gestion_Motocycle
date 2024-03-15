<x-page-head />

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

{{-- <script src="{{asset('/build/assets/app-BpNRfwSz.js')}}"></script>--}}

</html>