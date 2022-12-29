<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="application-name" content="{{ config('app.name') }}">

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">

        <title>{{ $title ?? config('app.name') }}</title>

        <style>[x-cloak] { display: none !important; }</style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        @livewireScripts
        @stack('scripts')
    </head>
    <body class="font-sans bg-gray-background text-gray-900 text-sm">
        <x-navigation.header/>

        {{--<header class="flex flex-col md:flex-row items-center justify-between px-8 py-4">
            <a href="/"><img src="{{ asset('img/logo.svg') }}" alt="logo"></a>
            <div class="flex items-center mt-2 md:mt-0">
                @if (Route::has('login'))
                    <div class="px-6 py-4">
                        @auth
                            <div class="flex items-center space-x-4">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log out') }}
                                    </a>
                                </form>

                                <livewire:comment-notifications />
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                            @if (Route::has('premium'))
                                <a href="{{ route('premium') }}" class="ml-4 text-sm text-gray-700 underline">Premium</a>
                            @endif
                        @endauth
                    </div>
                @endif
                @auth
                    <a href="#">
                        <img src="{{ auth()->user()->getAvatar() }}" alt="avatar" class="w-10 h-10 rounded-full">
                    </a>
                @endauth
            </div>
        </header>--}}

        <main class="relative">
            <section class="pt-16 lg:pt-32 container mx-auto lg:max-w-custom grid lg:grid-cols-3 grid-cols-1 lg:gap-10">
                <div class="lg:w-70 mx-5">
                    <div
                        class="bg-white md:sticky md:top-8 border-2 border-purplee rounded lg:mt-16 mt-8"
                        style="
                            border-image-source: linear-gradient(to bottom, rgba(50, 138, 241, 0.22), rgba(99, 123, 255, 0));
                                border-image-slice: 1;
                                background-image: linear-gradient(to bottom, #ffffff, #ffffff), linear-gradient(to bottom, rgba(50, 138, 241, 0.22), rgba(99, 123, 255, 0));
                                background-origin: border-box;
                                background-clip: content-box, border-box;
                        "
                    >
                        <div class="text-center px-6 py-2 pt-6">
                            <h3 class="font-semibold text-base">Add an idea</h3>
                            <p class="text-xs mt-4">
                                @auth
                                    Let us know what you would like and we'll take a look over!
                                @else
                                    Please login to create an idea.
                                @endauth
                            </p>
                        </div>

                        <livewire:create-idea />
                    </div>
                </div>
                <div class="col-span-2 w-full px-5 md:px-0 md:w-175">
                    <livewire:status-filters />

                    <div class="mt-8">
                        {{ $slot }}
                    </div>
                </div>
            </section>
        </main>

        @if (session('success_message'))
            <x-notification-success
                :redirect="true"
                message-to-display="{{ (session('success_message')) }}"
            />
        @endif

        @if (session('error_message'))
            <x-notification-success
                type="error"
                :redirect="true"
                message-to-display="{{ (session('error_message')) }}"
            />
        @endif

        @livewire('notifications')
    </body>
</html>
