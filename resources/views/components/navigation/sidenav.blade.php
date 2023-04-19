<div>
    <div x-cloak @click="open = !open" x-show="open" class="fixed h-screen inset-0 z-30 duration-500 bg-gray-800 opacity-40"></div>

    <nav :class="{
        'translate-x-0 ease-in opacity-100 w-56': open === true,
        'w-56 -translate-x-full ease-out opacity-0': open === false
    }"
        class="fixed inset-0 z-40 h-screen overflow-y-scroll duration-200 transform bg-white shadow">
        <div class="flex flex-col p-3 bg-black">
            <h4 class="text-base tracking-wider text-white">Olodo2Scholar</h4>
        </div>

        <div class="pb-3 space-y-1">
            <x-responsive-nav-link :href="route('landing')" :active="request()->routeIs('landing')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            @if (auth()->check())
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                        this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-responsive-nav-link>
                </form>
            @else
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    {{ __('Login') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('premium')" :active="request()->routeIs('premium')">
                    {{ __('Register') }}
                </x-responsive-nav-link>
            @endif
        </div>
    </nav>

</div>
