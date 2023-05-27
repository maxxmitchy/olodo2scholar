@php
use Illuminate\Http\Request;

function hasCategoriesQueryString()
{
    $request = Request::capture();

    return collect([
            'exists' => $request->has('categories'), 
            'value' => $request->input('categories') 
        ]);
}
@endphp

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
            
            {{-- departments drop down --}}
            <div x-data="{
                openDepartments: @js(hasCategoriesQueryString()['exists']),
                queryString: @js(hasCategoriesQueryString()['value']),
                }"
            >
                <div class="flex justify-between items-center capitalize text-gray-600 px-2 mb-5">
                    <span class="flex-1">departments</span>
                    {{-- svg button --}}
                    <button x-on:click="openDepartments = !openDepartments" class="p-2 rounded-sm bg-gray-200"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"
                            :class="{
                                'rotate-180': openDepartments == true
                            }"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                </div>
    
                <div class="pl-4" x-show="openDepartments">
                    <form action="" method="GET">
                        <div class="flex flex-col space-y-2 text-gray-600 text-left text-sm">
                            <input hidden x-ref="category" value="" >
                            <button type="button" value="Food"
                                @class([
                                    'text-left p-2',
                                    'bg-indigo-50 font-extrabold' => (hasCategoriesQueryString()['value'] == "Food")
                                ])
                            >Food</button>
                        </div>
                    </form>
                </div>
            </div>
            
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
                <a href="{{route('premium')}}" class="text-white p-3 py-2 bg-gradient-to-b rounded text-center from-indigo-400 to-indigo-600 mx-2 block">premium</a>
            @endif
        </div>
    </nav>
</div>
