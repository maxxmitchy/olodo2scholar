@props(['name'])

<div class="fixed grid place-items-center inset-0" x-show="show" id="{{ $name }}"
    x-on:modal.window="show=($event.detail === name)" @keydown.escape.window="show = false" x-data="{ show: false, name: '{{ $name }}' }"
    {{ $attributes }}>
    <div @click="show=false" class="z-30 inset-0 bg-gray-800 opacity-60 fixed"></div>
    <div x-show.transition="show"
        class="bg-white p-5 mt-3 text-center sm:mt-0 shadow-md mx-5 max-w-xs z-50 sm:text-left">

        <div class="mt-5 text-left h-24 overflow-y-auto ">
            {{ $body }}
        </div>
    </div>
</div>
