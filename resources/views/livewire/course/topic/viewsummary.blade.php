<section class="relative">
    <x-navigation.header>
        <div class="flex items-center justify-center text-2xl font-bold text-indigo-600">
            <strong class="text-black">olodo</strong>2Scholar
        </div>
    </x-navigation.header>

    <section
        class="relative pt-24 px-5 flex flex-col lg:w-3/4 md:w-3/4 mx-auto lg:gap-10 bg-gray-background lg:pt-28 lg:px-24">
        <span>
            <a href="{{ route('topic.topic', ['topic' => $this->summary->topic->key]) }}"
                class="bg-gray-100 text-indigo-500 p-2 px-3 rounded text-xs">
                ← Back to topic
            </a>
        </span>
        <br class="lg:hidden">
        <div
            class="tracking-wider prose-sm prose-headings:font-bold prose-headings:text-indigo-600 prose lg:prose-base prose-slate prose-blockquote:font-semibold
            prose-a:text-blue prose-a:font-bold hover:prose-a:text-blue-500 prose-a:underline">
            {!! $summary->body !!}
        </div>
    </section>
</section>
