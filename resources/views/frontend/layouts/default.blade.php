<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TITLE - A Carbon Developed Website</title>

    @vite(['resources/css/app.css', 'resources/scss/style.scss', 'resources/js/app.js'])
</head>



<body class="website antialiased">

    @include('frontend.layouts.header')

    <main>
        {!! processShortcodes($page->content) !!}
    </main>

    @include('frontend.layouts.footer')
</body>

</html>