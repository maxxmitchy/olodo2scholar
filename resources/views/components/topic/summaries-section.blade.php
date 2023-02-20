<section>
    <section class="bg-white p-4 rounded-md">
        <div class="filters flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-6">
            <div class="w-full md:w-2/3 relative">
                <label class="font-medium text-xs lg:text-sm" for="sort_by">Search</label>
                <input wire:model="sort_summary_search" type="search" placeholder="search summaries here"
                    class="text-sm w-full rounded bg-gray-100 border-none placeholder-gray-900 px-4 py-2 pl-8">
                <div class="absolute top-3 flex items-center h-full ml-2">
                    <svg class="w-4 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </section>

    {{-- load when searching or page navigation --}}
    <div wire:loading.grid wire:target="sort_summary_search">
        <x-topic.loading-component/>
    </div>
    {{-- results --}}
    <section wire:loading.remove wire:target="sort_summary_search" class="mt-7 relative bg-gray-background">
        <div class="grid gap-5 md:grid-cols-3">
            @forelse ($summaries as $summary)
                <a href="{{ route('summary-slides', ['summary' => $summary->key]) }}"
                    class="group bg-white rounded border shadow-sm hover:shadow-xl p-4 flex gap-4 border-t-2 border-t-indigo-600">
                    <div class="w-20 h-20 ring-1 ring-purple-500 ring-offset-2 flex-shrink-0 rounded-full bg-gradient-to-b from-indigo-500 to-purple-200 p-4">
                        <x-application-logo-white logo-style="light" />
                    </div>
                    <div class="tracking-wider grow block">
                        <span class="group-hover:underline inline-block">{!! $summary->title !!}</span>
                        <span class="bg-gray-100 whitespace-nowrap text-indigo-600 italic text-xs p-1 px-2 rounded">
                            {{ getWordCountAndReadingTime($summary->body) }} min. read
                        </span>
                    </div>
                </a>
            @empty
                <article
                    class="col-span-4 space-x-4 flex justify-center shadow shadow-red items-center bg-red text-white p-5 rounded">
                    <x-Icons.caution class="h-10 w-10 flex-shrink-0" />
                    <p class="tracking-wider text-sm">
                        Sorry, summaries are still in developement. Check back later.
                    </p>
                </article>
            @endforelse
        </div>
        @if ($summaries->count() !== 0)
            <section class="py-6">
                {{ $summaries->links() }}
            </section>
        @endif
    </section>
</section>
