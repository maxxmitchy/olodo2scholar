<section class="relative pt-10">
    <x-navigation.header>
        <div class="flex items-center justify-center text-2xl font-bold text-indigo-600">
            <strong class="text-black">olodo</strong>2Scholar
        </div>
    </x-navigation.header>

    <section class="relative pt-10 pb-10 bg-gray-background lg:pt-24">
        <article class="grid grid-cols-1 px-5 border-gray-300 lg:grid-cols-3 lg:px-24">

            {{-- new navigation tab --}}
            <nav x-data="{
                tabs: ['Summary', 'Quiz', 'Discussion'],
                activeTab: 0,
            }" class="flex bg-gray-400 text-indigo-600 divide-x border-gray-600 rounded w-full">
                <template x-for="tab in tabs">
                    <button
                        x-bind:class="{
                            'p-2 px-3',
                            'bg-white font-semibold': (activeTab == )
                        }"
                        x-text="tab"></button>
                </template>
            </nav>

            <!-- nav -->
            <article class="relative">
                <article class="z-10 w-full lg:fixed">
                    <div
                        class="bg-gray-800 rounded lg:rounded-none shadow-xl lg:shadow-none lg:h-screen lg:w-[24rem] overflow-hidden lg:mr-24 p-3 lg:mt-0 mt-12 lg:p-12">
                        <div class="p-3 bg-gray-700 rounded-lg shadow text-gray-50">

                            <a href="{{ route('course.course_details', ['course' => $this->course->key]) }}"
                                class="text-sm font-semibold tracking-wide hover:underline focus:underline lg:text-lg">
                                {{ $this->course->title }}, {{ $this->course->code }}, {{ $this->course->level->name }}
                            </a>
                        </div>

                        <div class="flex items-center justify-between mt-4 text-gray-300">
                            <div class="flex flex-col font-bold tracking-wider">
                                <p class="lg:text-sm text-xs">Topics ({{ $this->course->topics->count() }})</p>
                            </div>
                        </div>
                        <div class="mt-5 space-y-2 overflow-y-scroll max-h-56">
                            @foreach ($this->course->topics as $topic)
                                <div class="flex justify-between p-2 shadow shadow-gray-500 bg-gray-700 rounded-lg">
                                    <div class="flex items-center space-x-3 text-sm">
                                        <div
                                            class="flex items-center justify-center flex-shrink-0 w-5 h-5 p-3 bg-gray-500 rounded-full">
                                            @if ($topic->key == $this->coursetopic->key)
                                                <x-Icons.check class="flex-shrink-0 w-4 h-4 text-white" />
                                            @else
                                                <x-Icons.document class="flex-shrink-0 w-4 h-4 text-white" />
                                            @endif
                                        </div>
                                        <p class="text-gray-200">{{ $loop->index + 1 }}</p>
                                        @if ($topic->key == $this->coursetopic->key)
                                            <p class="text-sm text-white">{{ $topic->title }}</p>
                                        @else
                                            <a class="text-sm text-white underline focus:underline"
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
            <!-- end nav -->

            <article class="pt-12 lg:z-30 lg:px-5 lg:pt-0 lg:col-span-2" x-data="{
                open: false,
            }">
                <div class="space-y-4">
                    <h6 class="text-xl font-bold tracking-wider lg:text-2xl lg:font-semibold">
                        {{ $this->coursetopic->title }}
                    </h6>
                    <div id="topicstart"
                        :class="{
                            ' max-h-10 overflow-hidden': open === false,
                            'h-full': open === true
                        }"
                        class="tracking-wider prose-sm prose lg:prose-base prose-slate prose-blockquote:font-semibold
            prose-a:text-blue prose-a:font-bold hover:prose-a:text-blue-500 prose-a:underline">
                        {!! $this->coursetopic->overview !!}

                        @foreach ($this->coursetopic->summaries as $summary)
                            {!! $summary->body !!}
                        @endforeach

                    </div>

                    <br />
                    <a href="#topicstart" x-show="open === false" @click="open = !open"
                        class="text-sm font-semibold tracking-wider underline cursor-pointer text-blue">
                        continue reading
                    </a>
                </div>
                <div class="p-2 my-8 bg-white border-l-4 border-gray-700">
                    <p class="mb-4 text-sm tracking-wider">
                        Before you participate in a topic discussion, we recommend taking the quizzes first to ensure a
                        strong foundation of understanding.
                    </p>
                    <div class="flex space-x-4">
                        <a href="{{ route('idea.index', ['topic' => $this->coursetopic->key]) }}"
                            class="text-sm font-semibold tracking-wider underline text-blue">
                            discussions
                        </a>
                        <a href="{{ route('course.topicsummaries', ['topic' => $this->coursetopic->key]) }}"
                            class="text-sm font-semibold tracking-wider underline text-blue">
                            summaries
                        </a>
                    </div>
                </div>

                <div class="hidden">
                    <h6 class="text-base font-bold tracking-wider lg:text-lg">
                        Quizzes
                    </h6>

                    <article class="grid grid-cols-1 gap-5 mt-5 lg:grid-cols-3">
                        @foreach ($this->coursetopic->quizzes as $quiz)
                            <div class="p-5 border rounded-lg shadow-xl shadow-black/20">
                                <div class="flex flex-col justify-center space-y-2">
                                    <h6 class="text-sm font-semibold tracking-wider">
                                        {{ $quiz->name }}
                                    </h6>
                                </div>
                                <a href="{{ route('course.start_quiz', ['topic' => $this->topic, 'quiz' => $quiz]) }}"
                                    class="block w-full py-4 mt-3 text-sm font-semibold text-center text-white bg-indigo-600 rounded-lg shadow hover:bg-indigo-700 focus:outline-none focus:ring active:bg-indigo-500 sm:w-auto">
                                    Start quiz
                                </a>
                            </div>
                        @endforeach
                    </article>
                </div>

                <p x-show="open" @click="open = !open"
                    class="fixed bottom-0 left-0 right-0 p-2 text-xs font-bold tracking-wider text-center underline bg-gray-100 shadow cursor-pointer lg:text-sm text-blue/95">
                    read less
                </p>
            </article>
        </article>
    </section>
</section>
