@php
    const READING_SPEED = 850;

    const CHARS_PER_SLIDE = 255;

    function getReadingTime($slides)
    {
        $total_chars = $slides * CHARS_PER_SLIDE;

        $readingTime = ceil($total_chars / READING_SPEED);

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

    <header class="mt-6 mb-4 lg:mt-16 mx-4 lg:px-20 space-y-6 lg:space-y-8">
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

    <x-loading-spinner wire:target="activeTab" />

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
