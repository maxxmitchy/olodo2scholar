<section class="bg-white p-4 rounded-md">
    <div class="filters flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-6">
        <div class="w-full md:w-2/3 relative">
            <label class="font-medium text-xs lg:text-sm" for="sort_by">Search</label>
            <input wire:model="search" type="search" placeholder="search discussions here"
                class="text-sm w-full rounded bg-gray-100 border-none placeholder-gray-900 px-4 py-2 pl-8">
            <div class="absolute top-3 flex items-center h-full ml-2">
                <svg class="w-4 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>

        <div class="w-full md:w-1/3">
            <label class="font-medium text-xs lg:text-sm" for="sort_by">Sort by</label>
            <select wire:model="category" name="category" id="sort_by"
                class="text-sm w-full rounded border-none px-4 py-2 bg-gray-100">
                <option value="All Categories">All Categories</option>
                @foreach (['asdfg'] as $category)
                    <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </select>
        </div>

        <div class="w-full md:w-1/3">
            <label class="font-medium text-xs lg:text-sm" for="post_status">Post Status</label>
            <select wire:model="filter" name="other_filters" id="post_status"
                class="text-sm w-full rounded border-none px-4 py-2 bg-gray-100">
                <option value="No Filter">No Filter</option>
                <option value="Top Voted">Most Comments</option>
            </select>
        </div>
    </div>



</section>
