<section class="relative bg-gray-background">
    <div class="grid gap-5 md:grid-cols-3">
        @forelse ($summaries as $summary)
            <div class="rounded border shadow hover:shadow-xl p-5 flex flex-col justify-between">
                <div class="tracking-wider">
                    {!! $summary->title !!}
                    <span class="bg-gray-100 whitespace-nowrap text-indigo-600 italic text-xs p-1 px-2 rounded ml-2">
                        {{ getWordCountAndReadingTime($summary->body) }} min. read
                    </span>
                </div>
                <div class="block mt-3">
                    <a href="{{ route('course.viewsummary', ['summary' => $summary->key, 'topic' => $this->coursetopic->key]) }}"
                        class="capitalize block w-full py-2 mt-3 text-sm font-semibold text-center text-white bg-indigo-600 rounded shadow hover:bg-indigo-700 focus:outline-none focus:ring active:bg-indigo-500 sm:w-auto">
                        read summary
                    </a>
                </div>
            </div>
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
