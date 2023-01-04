<div x-cloak class="top-0 fixed z-40 w-full" x-data="{ openSearch: false, open:false }">
    <x-navigation.sidenav/>

    <div class="flex items-center justify-between w-full px-5 lg:py-5 py-3 lg:px-24 space-x-3 bg-gray-background">

        <div class="shrink-0 flex items-center">
            <a href="{{ route('landing') }}">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            </a>
        </div>

        <input type="search" placeholder="Search for a particular course"
            class="lg:hidden w-full rounded-md shadow-sm border-0 focus:border-indigo-300 focus:ring
                focus:ring-indigo-200 focus:ring-opacity-50"
        >

        {{-- search box desktop --}}

        <input type="search" placeholder="Search for a particular course" wire:model="search"
        class="hidden w-1/2 bg-white border border-neutral-300 rounded-md focus:ring-2
        focus:ring-neutral-400 lg:block px-5 placeholder:text-sm">

        {{-- desktop links --}}
        <div class="lg:flex space-x-8 hidden items-center">
            <livewire:comment-notifications />

            <a href="{{route('dashboard')}}" class="font-semibold">Start Learning</a>

            <a href="{{route('login')}}" class="font-semibold">Sign in</a>

            <a href="{{route('premium')}}"
                class="font-semibold text-white bg-purple-600 py-2 px-3 rounded shadow-lg">
                Join Premium
            </a>
        </div>

        {{-- mobile hamburger toggle --}}
        <x-Icons.hamburger @click="open = !open" class="flex-shrink-0 w-6 h-6 lg:hidden"/>

    </div>
</div>
