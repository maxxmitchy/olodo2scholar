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

@section('title', config('app.name') . ' | ' . $this->topic->title)

<section class="">
    <x-navigation.header>
        <div class="flex items-center justify-center text-2xl font-bold text-indigo-600">
            <strong class="text-black">olodo</strong>2Scholar
        </div>
    </x-navigation.header>

    <header class="mt-10 mb-4 lg:mt-16 mx-4 lg:px-20 space-y-6 lg:space-y-8">
        <a href="{{ route('course.course_details', ['course' => $this->topic->course->key]) }}"
            class="bg-gray-100 text-indigo-500 p-2 px-3 rounded text-xs"> ← Back to course</a>
        <h6 class="text-base font-bold tracking-wider lg:text-xl lg:font-semibold">
            {{ $this->topic->title }}
        </h6>

        <nav x-init="
                activeTab = @js($this->activeTab)
            "
            x-data="{
                tabs: ['Summaries', 'Quizzes', 'Discussions'],
                activeTab: 'Summaries',
                changeTab: function(tab){
                    this.$dispatch('input' , tab);
                    this.activeTab = tab;
                }
            }"
            wire:model="activeTab"
            class="rounded bg-gray-200 text-indigo-600 grid grid-cols-3 text-xs justify-between border-indigo-400 md:w-2/3 lg:w-1/4">
            <template x-for="tab in tabs">
                <button
                    :key="''+tab"
                    wire:loading.class="underline"
                    :class="{
                        'p-3 bg-white font-bold shadow border-x rounded': activeTab == tab,
                    }"
                    class="tracking-wider"
                    @click.prevent="changeTab(tab)" x-text="tab"></button>
            </template>
        </nav>
    </header>

    {{-- main body --}}
    {{-- livewire components for summary, quizzes and discussions --}}
    {{-- show when active tab is loading --}}
    <div wire:loading.flex wire:target="activeTab">
        <div class="flex h-56 justify-center items-center w-full">
            <svg class="w-24 h-24 m-auto animate-spin" viewBox="0 0 91 91" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
                <defs>
                <path d="M0 45.5C0 20.371 20.371 0 45.5 0C59.4019 0 71.8476 6.23466 80.1936 16.0604C86.9337 23.9956 91 34.2729 91 45.5C91 70.629 70.629 91 45.5 91" id="path_1" />
                <clipPath id="clip_1">
                    <use xlink:href="#path_1" />
                </clipPath>
                </defs>
                <g id="Oval">
                <g clip-path="url(#clip_1)">
                    <use xlink:href="#path_1" fill="none" stroke="#0A50C1" stroke-width="8" />
                </g>
                </g>
            </svg>
        </div>
    </div>
    {{-- <div wire:target="activeTab" wire:loading.grid>
        <x-topic.loading-component/>
    </div> --}}

    {{-- remove when active tab is loading --}}
    <div wire:target="activeTab" wire:loading.remove>
        <div class="py-3 lg:px-24 px-5">

            @if ($activeTab === 'Summaries')
                <x-topic.summaries-section :summaries="$this->summaries" />
            @endif

            {{-- quiz --}}
            @if ($activeTab === 'Quizzes')
                <x-topic.quiz-section :quizzes="$this->quizzes" />
            @endif

            @if ($activeTab === 'Discussions')
                {{-- sorting panel --}}
                <x-topic.discussion-section/>
            @endif

        </div>
    </div>
</section>
