<div x-cloak class="fixed z-40 w-full" x-data="{ open: false }">
    <x-navigation.sidenav/>

    <div class="flex items-center justify-between w-full px-5 lg:py-5 py-3 lg:px-24 space-x-3 bg-gray-50">
        <x-application-logo class="lg:hidden flex-shrink-0 w-6 h-6 fill-current text-gray-500" />

        {{-- search box desktop --}}

        <input type="search" wire:model.debounce.750="search"
            class="lg:hidden w-full rounded-md shadow-sm border-0 focus:border-indigo-300 focus:ring
                focus:ring-indigo-200 focus:ring-opacity-50"
        >

        <input type="search" placeholder="Search for a course, topic..."
        class="hidden w-1/2 bg-white border border-neutral-300 rounded-md focus:ring-2 focus:ring-neutral-400 lg:block px-5 placeholder:text-sm">

        {{-- desktop links --}}
        <div class="lg:flex space-x-8 hidden items-center">
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
