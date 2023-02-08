<section class="relative">
    <x-navigation.header>
        <div class="flex items-center justify-center text-2xl font-bold text-indigo-600">
            <strong class="text-black">olodo</strong>2Scholar
        </div>
    </x-navigation.header>

    <section class="relative py-20 px-5 lg:grid lg:grid-cols-2 lg:gap-10 bg-gray-background lg:pt-24 lg:px-24">
        <div class="flex flex-wrap items-center space-x-2">
            <a href="{{ route('course.course_details', ['course' => $this->course->key]) }}"
                class="hover:underline text-sm hover:text-blue">course</a>
            <span>></span>
            <a href="{{ route('course.topic', ['course' => $this->course->key, 'topic' => $this->topic->key]) }}"
                class="hover:underline text-sm hover:text-blue">topic</a>
            <span>></span>
            <a href="{{ route('course.topicsummaries', ['topic' => $this->topic->key]) }}"
            class="hover:underline text-sm hover:text-blue">summaries</a>
            <span>></span>
            <a href="{{ route('course.viewsummary', ['summary' => $this->summary->key, 'topic' => $this->topic->key]) }}"
            class="hover:underline text-sm underline text-blue">{{ $this->summary->title }}</a>
        </div>
        <br>
        <div
            class="tracking-wider prose-sm prose lg:prose-base prose-slate prose-blockquote:font-semibold
            prose-a:text-blue prose-a:font-bold hover:prose-a:text-blue-500 prose-a:underline">
            {!! $summary->body !!}
        </div>
        <div class="mt-4 lg:mt-0">
            <h6 class="text-base font-bold tracking-wider lg:text-2xl lg:text-center">
                Quizzes
            </h6>

            <article class="grid grid-cols-1 gap-5 mt-5 lg:grid-cols-3">
                @foreach ($this->summary->quizzes as $quiz)
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
    </section>
</section>
