<div class="">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Let us tailor things to your needs ') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="p-5 lg:mt-8 bg-white shadow-sm sm:rounded-lg">
            {{ $this->form }}

            <button wire:click="update"
                class="mt-6 rounded-lg bg-indigo-500 py-3 text-sm font-medium text-white
                flex rounde justify-center w-full hover:bg-indigo-700 active:bg-indigo-900
                focus:outline-none focus:border-indigo-900 shadow focus:ring ring-indigo-300">
                {{ __('Update Profile') }}
            </button>
        </div>

    </div>
</div>
