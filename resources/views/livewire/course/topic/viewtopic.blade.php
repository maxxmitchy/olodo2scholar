<section class="relative" x-data="{
    init() {
            if (localStorage.getItem('_x_answers') !== null) {
                localStorage.clear()
            }
        },
        topicId: $persist(@entangle('topicId')),
}">
    <x-navigation.header>
        <div class="flex items-center justify-center text-2xl font-bold text-indigo-600">
            <strong class="text-black">olodo</strong>2Scholar
        </div>
    </x-navigation.header>

    <section class="relative bg-gray-background pb-10 lg:pt-24 pt-10">
        <article class="grid lg:grid-cols-3 grid-cols-1 border-gray-300 px-5 lg:px-24">
            <article class="relative">
                <article class="z-10 lg:fixed w-full">
                    <div
                        class="bg-gray-800 rounded lg:rounded-none shadow-xl lg:shadow-none lg:h-screen lg:w-[24rem] overflow-hidden lg:mr-24 p-3 lg:mt-0 mt-12 lg:p-12">
                        <div class="rounded-lg bg-gray-700 text-gray-50 shadow p-3">
                            <a href="{{ route('course.course_details', ['course' => $this->course->key]) }}"
                                class="hover:underline focus:underline tracking-wide text-sm lg:text-lg font-semibold">
                                {{ $this->course->title }}, {{ $this->course->code }}, {{ $this->course->level->name }}
                            </a>
                        </div>

                        <div class="mt-4 flex justify-between items-center text-gray-300">
                            <div class="flex items-center font-bold text-sm tracking-wider">
                                <p class="">Topics List ({{ $this->course->topics->count() }})</p>
                            </div>
                        </div>
                        <div class="max-h-44 overflow-y-scroll space-y-2 mt-5">
                            @foreach ($this->course->topics as $topic)
                                <div class="bg-gray-700 rounded-lg p-2 flex justify-between">
                                    <div class="text-sm flex items-center space-x-3">
                                        <div
                                            class="bg-gray-500 p-3 flex-shrink-0 h-5 w-5 rounded-full flex justify-center items-center">
                                            @if ($topic->key == $this->coursetopic->key)
                                                <x-Icons.check class="h-4 w-4 flex-shrink-0 text-green/95" />
                                            @else
                                                <x-Icons.document class="h-4 w-4 flex-shrink-0 text-white" />
                                            @endif
                                        </div>
                                        <p class="text-gray-200">{{ $loop->index + 1 }}</p>
                                        @if ($topic->key == $this->coursetopic->key)
                                            <p class="text-white text-sm">{{ $topic->title }}</p>
                                        @else
                                            <a class="text-white text-sm hover:underline focus:underline"
                                                href="{{ route('course.topic', ['course' => $this->course->key, 'topic' => $topic->key]) }}">
                                                {{ $topic->title }}
                                            </a>
                                        @endif

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </article>
            </article>

            <article class="lg:z-30 lg:px-5 pt-12 lg:pt-0 lg:col-span-2" x-data="{ open: false }">
                <div class="space-y-4">
                    <h6 class="tracking-wider font-bold text-xl lg:text-2xl lg:font-semibold">
                        {{ $this->coursetopic->title }}
                    </h6>
                    <div id="topicstart"
                        :class="{
                            ' max-h-10 overflow-hidden': open === false,
                            'h-full': open === true
                        }"
                        class="prose prose-sm lg:prose-base prose-slate prose-blockquote:font-semibold
                            prose-a:text-blue prose-a:font-bold hover:prose-a:text-blue-500 prose-a:underline tracking-wider">
                        {!! $this->coursetopic->overview !!}

                        {!! $this->coursetopic->body !!}
                    </div>

                    <br />
                    <a href="#topicstart" x-show="open === false" @click="open = !open"
                        class="cursor-pointer text-sm tracking-wider
                        text-blue underline font-medium">
                        continue reading
                    </a>
                    <p x-show="open === true" @click="open = !open"
                        class="cursor-pointer text-sm font-medium tracking-wider
                        text-blue underline">
                        read
                        less</p>

                </div>
                <div class="bg-white my-8 p-2 border-l-4 border-gray-700">
                    <p class="tracking-wider mb-4 text-sm">
                        Before you participate in a topic discussion, we recommend taking the quizzes first to ensure a
                        strong foundation of understanding.
                    </p>
                    <a href="{{ route('idea.index', ['topic' => $this->coursetopic->key]) }}"
                        class="text-blue font-medium underline tracking-wider text-sm">
                        discussions
                    </a>
                </div>

                <div class="">
                    <h6 class="tracking-wider text-base lg:text-lg font-bold">
                        Quizzes
                    </h6>

                    <article class="grid lg:grid-cols-3 grid-cols-1 gap-5 mt-5">
                        @foreach ($this->coursetopic->quizzes as $quiz)
                            <div class="border rounded-lg p-5 shadow-xl shadow-black/20">
                                <div class="flex flex-col justify-center space-y-2">
                                    <h6 class="tracking-wider text-sm font-semibold">
                                        {{ $quiz->name }}
                                    </h6>
                                </div>
                                <a href="{{ route('course.start_quiz', ['topic' => $this->topic, 'quiz' => $quiz]) }}"
                                    class="mt-3 text-center block w-full rounded-lg bg-indigo-600 py-4 text-sm
                                    font-semibold text-white shadow hover:bg-indigo-700 focus:outline-none focus:ring
                                    active:bg-indigo-500 sm:w-auto">
                                    Start quiz
                                </a>
                            </div>
                        @endforeach
                    </article>
                </div>

                <div class="">
                    <br>
                    <br>
                    <h6 class="tracking-wider text-base lg:text-lg font-bold">
                        Flashcards
                    </h6>

                    <article class="grid lg:grid-cols-3 grid-cols-1 gap-5 mt-5">
                        @forelse ($this->coursetopic->flashcards as $flashcard)
                            <div class="cursor-pointer group relative block" x-data="{open: false}">
                                <span
                                    :class="{
                                            '' : open === true,
                                            'hidden' : open === false
                                        }"
                                    class="absolute inset-0 border-2 border-dashed border-indigo-400 rounded-lg"></span>
                                <div
                                    class="relative flex h-full transform items-end rounded-lg  border-2 bg-white transition-transform group-hover:-translate-x-2 group-hover:-translate-y-2">
                                    <div
                                        @click="open = !open"
                                        :class="{
                                            'absolute opacity-0' : open === true,
                                            '' : open === false
                                        }"
                                        class="p-5 transition-opacity">
                                        <h3 class="text-base font-bold">Question</h3>
                                        <p class="mt-4 text-sm tracking-wider">
                                            {{ $flashcard->concept }}
                                        </p>
                                    </div>

                                    <div
                                        @click="open = !open"
                                        :class="{
                                            'relative opacity-100' : open === true,
                                            '' : open === false
                                        }"
                                        class="h-44 overflow-y-scroll absolute p-5 rounded-lg opacity-0 transition-opacity">
                                        <h3 class="mt-4 text-base font-bold">Answer To Question</h3>

                                        <p class="mt-4 text-sm tracking-wider">
                                            {{ $flashcard->definition }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <article class="space-x-2 flex justify-center items-center text-red bg-white p-3 rouned">
                                <x-Icons.caution class="h-7 w-7 flex-shrink-0" />
                                <p class="tracking-wider">
                                    Sorry, this topic does not have flashcards at the moment.
                                </p>
                            </article>
                        @endforelse
                    </article>
                </div>
            </article>
        </article>
    </section>
</section>
