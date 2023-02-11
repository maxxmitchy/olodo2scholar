<article class="grid grid-cols-1 gap-5 mt-5 lg:grid-cols-3">
    @forelse ($quizzes as $quiz)
        <div class="p-4 border rounded shadow hover:shadow-xl shadow-black/20 flex flex-col gap-y-2">
            <div>
                <h6 class="text-base font-bold tracking-wider inline-flex">
                    {{ $quiz->name.' ' }}
                </h6>
                <span class="bg-gray-100 whitespace-nowrap text-indigo-600 italic text-xs p-1 px-2 rounded inline-flex">
                    {{ $quiz->difficulty->name ?? 'Easy' }}
                </span>
            </div>
            <p class="text-sm mb-2"> {{$quiz->questions->count() . ' questions'}} </p>
            <a href="{{ route('course.start_quiz', ['topic' => $this->topic, 'quiz' => $quiz]) }}"
                class="block w-full py-2 mt-3 text-sm font-semibold text-center text-white bg-indigo-600 rounded shadow hover:bg-indigo-700 focus:outline-none focus:ring active:bg-indigo-500 sm:w-auto">
                Take quiz
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
