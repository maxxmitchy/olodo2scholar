<div>
    <div 
        x-cloak @click="open = !open" 
        x-show="open"
        class="fixed h-screen inset-0 z-30 duration-500 bg-gray-800 opacity-40"></div>
    <nav :class="{
        'translate-x-0 ease-in opacity-100 w-56': open === true,
        'w-56 -translate-x-full ease-out opacity-0': open === false
    }"
        x-cloak
        x-show="true"
        {{--  --}}
        class="fixed inset-0 z-40 h-screen overflow-y-scroll duration-200 transformtransform bg-white shadow">
        <div class="flex flex-col p-3 bg-indigo-500 justify-center h-20 mb-5">
            <h4 class="text-2xl tracking-wider text-white">Olodo2Scholar</h4>
        </div>

        <div class="pb-3 p-2 space-y-3 capitalize">
            <x-responsive-nav-link class="mb-5" :href="route('landing')" :active="request()->routeIs('landing')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            
            <hr class="block">
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
                <a href="{{route('login')}}" class="p-3 py-2 bg-gradient-to-b rounded text-center text-black from-gray-200 to-gray-300 mx-2 block">Login</a>
                <a href="{{route('premium')}}" class="text-white p-3 py-2 bg-gradient-to-b rounded text-center from-indigo-400 to-indigo-600 mx-2 block">Register</a>
            @endif
        </div>
    </nav>
</div>
