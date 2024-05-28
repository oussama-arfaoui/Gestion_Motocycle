<x-page-head />


<body class="website antialiased">

    @include('frontend.layouts.header')

    <main>
        {!! processShortcodes($page->content) !!}
    </main>

    @include('frontend.layouts.footer')

    <x-floating-actions /> 
    {{-- <x-floating-sections /> --}}
    <x-floating-whatsapp />
</body>

</html>