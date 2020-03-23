<!doctype html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <meta name="referrer" content="no-referrer">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="author" content="{{ config('app.author') }}">
    <meta name="description" content="{{ config('app.description') }}">

    <meta property="og:title" content="{{ config('app.name') }}">
    <meta property="og:description" content="{{ config('app.description') }}">

    {{-- TODO (fgic): import images--}}
    <link rel="icon" type="image/png" href="">
    <link rel="apple-touch-icon" href="">

    <title>@yield('title') | {{ config('app.name') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<div id="app" class="h-screen">
    @yield('master')
</div>

@yield('script')
<script defer src="{{ asset('js/app.js') }}"></script>
</body>
</html>
