<section x-trap="openSearch" x-show="openSearch" class="bg-gray-900 px-5 py-12 fixed inset-0">
    <input autofocus type="search" wire:model.debounce.750="search"
        class="lg:hidden w-full rounded-md bg-white shadow-sm border focus:border-indigo-500 focus:ring
            focus:ring-indigo-200 focus:ring-opacity-50">

    <article class="bg-white rounded shadow mt-16 w-full h-24">

    </article>

    <a @click="openSearch = !openSearch" class="text-white underline mt-4">close</a>

</section>
