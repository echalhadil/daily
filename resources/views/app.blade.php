<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/animation.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/materialdesignicons.min.css') }}">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/uikit.css') }}"> --}}


        <!-- Scripts -->
        @routes
        <l src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></l>
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="{{ asset('js/uikit.min.js') }}"></script>
        <script src="{{ asset('js/uikit-icons.js') }}"></script>
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
