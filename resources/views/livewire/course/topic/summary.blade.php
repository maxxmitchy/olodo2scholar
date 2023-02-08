<section class="relative">
    <x-navigation.header>
        <div class="flex items-center justify-center text-2xl font-bold text-indigo-600">
            <strong class="text-black">olodo</strong>2Scholar
        </div>
    </x-navigation.header>

    <section class="relative pt-10 pb-10 bg-gray-background lg:pt-24 lg:px-24">
        <div class="flex justify-center items-center p-5">
            <h2 class="tracking-wider text-xl text-center mt-12 font-bold">
                Summaries for {{ $this->topic->title }}
            </h2>
        </div>
        <div class="p-5 grid gap-5 md:grid-cols-4 lg:mt-12">
            @forelse ($summaries as $summary)
                <div class="space-y-2 rounded-lg border shadow-xl p-5">
                    <div class="max-h-20 overflow-hidden tracking-wider prose-sm prose lg:prose-base prose-slate prose-blockquote:font-semibold
                        prose-a:text-blue prose-a:font-bold hover:prose-a:text-blue-500 prose-a:underline">
                        {!! $summary->body !!}
                    </div>
                    <br>
                    <a href="{{ route('course.viewsummary', ['summary' => $summary->key, 'topic' => $this->topic->key]) }}" class="text-xs tracking-wider text-blue font-semibold underline">
                        view full summary
                    </a>
                </div>
            @empty
                <div class="text-red flex justify-center items-center">
                    <p>No summaries found</p>
                </div>
            @endforelse
        </div>
    </section>
</section>
