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
        <x-topic.loading-component />
    </div>
    {{-- results --}}
    <section wire:loading.remove wire:target="sort_summary_search" class="mt-7 relative bg-gray-background">
        <div class="grid gap-5 md:grid-cols-3">
            @forelse ($summaries as $summary)
                <a href="{{ route('summary-slides', ['summary' => $summary->key]) }}"
                    class="group bg-white rounded border shadow-sm hover:shadow-xl p-4 flex gap-4 border-t-2 border-t-indigo-600">
                    <div
                        class="w-12 h-12 ring-1 ring-violet-500 ring-offset-2 flex flex-shrink-0 rounded-full 
                            bg-gradient-to-b from-indigo-500 to-violet-200 p-2 justify-center items-center">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="flex-shrink-0 h-full text-white w-full">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>

                    </div>
                    <div class="tracking-wider grow block">
                        <span class="group-hover:underline tracking-wider font-semibold inline-block text-base">{!! $summary->title !!}</span>
                        <span class="bg-gray-100 whitespace-nowrap text-indigo-600 italic text-xs p-1 px-2 rounded">
                            @php
                                $time = getReadingTime($summary->slides->count());
                            @endphp

                            @if ($time == 0)
                                {{ '< 1' }}
                            @else
                                {{ $time }}
                            @endif

                            min. read

                        </span>
                    </div>
                </a>
            @empty
                <article
                    class="col-span-4 space-x-4 flex justify-center items-center bg-indigo-100 text-indigo-500 border border-indigo-500 p-5 rounded">
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
