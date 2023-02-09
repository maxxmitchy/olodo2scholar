<section class="relative">
    <x-navigation.header>
        <div class="flex items-center justify-center text-2xl font-bold text-indigo-600">
            <strong class="text-black">olodo</strong>2Scholar
        </div>
    </x-navigation.header>

    <section
        class="relative pt-24 px-5 flex flex-col lg:w-3/4 md:w-3/4 mx-auto lg:gap-10 bg-gray-background lg:pt-28 lg:px-24">
        <span>
            <a href="{{ route('course.topic', ['course' => $this->course->key, 'topic' => $this->topic->key]) }}"
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
