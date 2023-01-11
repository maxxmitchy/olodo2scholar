<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="application-name" content="{{ config('app.name') }}">

    <!-- Meta tags -->
    <meta name="description"
        content="Online platform for university students to participate in discussions and quizzes on a variety of topics">
    <meta name="keywords" content="university, online, discussions, quizzes, education">
    <meta name="author" content="Olodo2Scholar co.">

    <!-- Open Graph tags -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.Olodo2Scholar.com/">
    <meta property="og:title" content="{{ $title ?? config('app.name') }}">
    <meta property="og:description"
        content="Online platform for university students to participate in discussions and quizzes on a variety of topics">
    <meta property="og:image" content="/path/to/image.jpg">

    <!-- Twitter Card tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://www.Olodo2Scholar.com/">
    <meta name="twitter:title" content="{{ $title ?? config('app.name') }}">
    <meta name="twitter:description"
        content="Online platform for university students to participate in discussions and quizzes on a variety of topics">
    <meta name="twitter:image" content="/path/to/image.jpg">

    <!-- Robots meta tag -->
    <meta name="robots" content="index, follow">

    <!-- Canonical link -->
    <link rel="canonical" href="https://www.your-website.com/">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <title>
        @yield('title' ?? config('app.name'))
    </title>

    <style>
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
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .wrapper::-webkit-scrollbar {
            width: 0;
        }

        .wrapper .item {
            min-width: 14rem;
            min-height: 10rem;
            margin-right: 1rem;
            scroll-snap-align: center;
        }
    </style>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    @livewireStyles

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="font-sans antialiased text-gray-900">
        {{ $slot }}
    </div>

    @livewireScripts

    @stack('scripts')

    @livewire('notifications')

    @livewire('livewire-ui-modal')

</body>

</html>
