<div class="">
    <div x-cloak @click="open = !open" x-show="open" class="fixed inset-0 z-30 duration-500 bg-gray-800 opacity-40"></div>

    <nav :class="{
                'translate-x-0 ease-in opacity-100 w-56' : open === true,
                'w-56 -translate-x-full ease-out opacity-0' : open === false
            }"

            class="fixed inset-0 z-40 h-screen overflow-y-scroll duration-200 transform bg-white shadow">

        <div class="flex flex-col p-3 bg-black">
            <h4 class="text-base tracking-wider text-white">StudyBetta</h4>
        </div>

        <ul class="p-3 space-y-3">
            <li>
                <a href="{{ route('landing') }}" class="text-sm font-semibold cursor-pointer traking-wider"
                >
                    Home
                </a>
            </li>

            <li>
                <a href="" class="text-sm font-semibold cursor-pointer traking-wider"
                >
                    About us
                </a>
            </li>

            @if (auth()->check())
                <li>
                    <a href="{{ route('dashboard') }}" class="text-sm font-semibold cursor-pointer traking-wider"
                    >
                        My Account
                    </a>
                </li>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="route('logout')"
                        class="text-sm tracking-wider"
                        onclick="event.preventDefault();
                        this.closest('form').submit();">
                        Logout
                    </a>
                </form>
            @else
                <div class="space-y-2">
                    <li>
                        <a href="{{route('login')}}" class="font-semibold text-sm cursor-pointer traking-wider"
                        >
                            Login
                        </a>
                    </li>
                </div>
            @endif
        </ul>

        <ul class="p-3 space-y-2">
            <a href="{{route('premium')}}"
                class="font-semibold text-white bg-purple-600 py-2 px-3 rounded shadow-lg">
                Join Premium
            </a>
        </ul>

    </nav>
</div>
