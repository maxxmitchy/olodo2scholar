@php
    const READING_SPEED = 180;

    function getWordCountAndReadingTime($richText)
    {
        $plainText = preg_replace('/<[^>]+>/', ' ', $richText);
        $plainText = preg_replace('/[^a-zA-Z\s]/', '', $plainText);

        $wordCount = str_word_count($plainText);

        $readingTime = ceil($wordCount / READING_SPEED);

        return $readingTime;
    }
@endphp

<section class="pt-10 h-screen">
{{-- .h-screen --}}
    <x-navigation.header>
        <div class="flex items-center justify-center text-2xl font-bold text-indigo-600">
            <strong class="text-black">olodo</strong>2Scholar
        </div>
    </x-navigation.header>

    <header class="mt-10 mb-4 lg:mt-16 mx-4 lg:px-20 space-y-6 lg:space-y-8">
        <a href="{{ route('course.course_details', ['course' => $this->course->key]) }}"
            class="bg-gray-100 text-indigo-500 p-2 px-3 rounded text-xs"> ← Back to course</a>
        <h6 class="text-base font-bold tracking-wider lg:text-xl lg:font-semibold">
            {{ $this->coursetopic->title }}
        </h6>

        <nav x-data="{
            tabs: ['Summaries', 'Quizzes', 'Discussions'],
            activeTab: @entangle('activeTab')
        }"
            class="rounded bg-gray-200 text-indigo-600 grid grid-cols-3 text-xs justify-between border-indigo-400 md:w-2/3 lg:w-1/4">
            <template x-for="tab in tabs">
                <button
                    :class="{
                        'py-2 px-3 bg-white font-bold shadow border-x rounded': activeTab == tab,

                    }"
                    @click.prevent="activeTab = tab" x-text="tab"></button>
            </template>
        </nav>
    </header>

    {{-- main body --}}
    {{-- livewire components for summary, quizzes and discussions  [.h-max-full.overflow-auto]--}}
    <div class="py-3 lg:px-24 px-5">
        @if ($activeTab === 'Summaries')
            <section class="relative bg-gray-background">
                <div class="grid gap-5 md:grid-cols-3">
                    @forelse ($summaries as $summary)
                        <div class="rounded-lg border shadow hover:shadow-xl p-5 flex flex-col justify-between">
                            <div class="tracking-wider">
                                {!! $summary->title !!}
                                <span class="bg-gray-100 whitespace-nowrap text-indigo-600 italic text-xs p-1 px-2 rounded ml-2">
                                    {{ getWordCountAndReadingTime($summary->body) }} min. read
                                </span>
                            </div>
                            <div class="block mt-3">
                                <a href="{{ route('course.viewsummary', ['summary' => $summary->key, 'topic' => $this->coursetopic->key]) }}"
                                    class="capitalize block w-full py-2 mt-3 text-sm font-semibold text-center text-white bg-indigo-600 rounded-lg shadow hover:bg-indigo-700 focus:outline-none focus:ring active:bg-indigo-500 sm:w-auto">
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
                @if($summaries->count() !== 0)
                    <section class="py-6">
                        {{ $summaries->links() }}
                    </section>
                @endif
            </section>
        @endif

        {{-- quiz --}}

        @if ($activeTab === 'Quizzes')
            <article class="grid grid-cols-1 gap-5 mt-5 lg:grid-cols-3">
                @forelse ($this->coursetopic->quizzes as $quiz)
                    <div class="p-5 border rounded-lg shadow lg:shadow-xl shadow-black/20">
                        <div class="flex flex-col justify-center space-y-2">
                            <h6 class="text-sm font-semibold tracking-wider">
                                {{ $quiz->name }}
                            </h6>
                        </div>
                        <a href="{{ route('course.start_quiz', ['topic' => $this->topic, 'quiz' => $quiz]) }}"
                            class="block w-full py-2 mt-3 text-sm font-semibold text-center text-white bg-indigo-600 rounded-lg shadow hover:bg-indigo-700 focus:outline-none focus:ring active:bg-indigo-500 sm:w-auto">
                            Start quiz
                        </a>
                    </div>
                @empty
                    <article
                        class="col-span-4 space-x-4 flex justify-center shadow shadow-red items-center bg-red text-white p-5 rounded">
                        <x-Icons.caution class="h-10 w-10 flex-shrink-0" />
                        <p class="tracking-wider text-sm">
                            Sorry, quizzes are still in developement. Check back later.
                        </p>
                    </article>
                @endforelse
            </article>
        @endif
    </div>
</section>
