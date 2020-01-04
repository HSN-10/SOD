<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }} | @yield('title')</title>
        <!-- Bootstrap core CSS -->
            <link href="{{ asset('css/bootstrap.min.css?v=0.04b') }}" rel="stylesheet">
            <script src="https://kit.fontawesome.com/26f8a9351c.js"></script>
        <style>
            .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            }

            @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
            }
        </style>
        <!-- Custom styles for this template -->
            <link href="{{ asset('css/floating-labels.css') }}" rel="stylesheet">
            @yield('customCss')
    </head>
    <body>
        @yield('content')

        <script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        @yield('customJs')
    </body>
</html>
