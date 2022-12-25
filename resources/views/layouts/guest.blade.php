<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <style>
            [x-cloak] { display: none !important; }

            * {
                scroll-behavior: smooth;
            }

            .wrapper {
                display: flex;
                overflow-x: auto;
                scroll-snap-type: x mandatory;
            }

            .hide-scroll-bar::-webkit-scrollbar {
                display: none;
            }

            /* Hide scrollbar for IE, Edge and Firefox */
            .hide-scroll-bar {
                -ms-overflow-style: none;  /* IE and Edge */
                scrollbar-width: none;  /* Firefox */
            }

            .wrapper::-webkit-scrollbar {
                width: 0;
            }

            .wrapper .item {
                min-width: 12rem;
                min-height: 10rem;
                margin-right: 1rem;
                scroll-snap-align: center;
            }
        </style>

        @livewireStyles

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>

        @livewireScripts
    </body>
</html>
