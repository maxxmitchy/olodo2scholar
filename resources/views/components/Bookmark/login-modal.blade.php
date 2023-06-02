<x-dynamic-modal name="login-modal" x-cloak>
    <x-slot name="body">
        <h4 class="mb-6 tracking-wider text-lg font-bold">
            Sign in to continue
        </h4>
        <div class="flex flex-col space-y-2">
            <a href="{{ route('login') }}"
                class="bg-indigo-500 text-white rounded-lg font-bold text-sm lg:text-base text-center w-full p-2">
                Log in
            </a>
            <a href="{{ route('premium') }}"
                class="text-indigo-500 bg-indigo-200/30 rounded-lg font-bold text-sm lg:text-base text-center w-full p-2">
                Register
            </a>
        </div>
    </x-slot>
</x-dynamic-modal>
