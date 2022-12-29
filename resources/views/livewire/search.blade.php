<section x-show="openSearch" class="px-5 py-12 fixed inset-0 bg-gray-800 opacity-90 z-50">
    <input autofocus type="search" wire:model.debounce.750="search"
        class="lg:hidden w-full rounded-md bg-white shadow-sm border-0 focus:border-indigo-300 focus:ring
            focus:ring-indigo-200 focus:ring-opacity-50"
    >

    <article class="absolute top-6 inset-x-4 bg-red-50">

    </article>

</section>
