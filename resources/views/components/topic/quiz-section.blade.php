<section>
    {{-- sorting panel --}}
    <section class="bg-white p-4 rounded-md">
    <div class="filters flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-6">
        <div class="w-full md:w-2/3 relative">
            <label class="font-medium text-xs lg:text-sm" for="sort_by">Search</label>
            <input wire:model="sort_quiz_search" type="search" placeholder="search quizzes here"
                class="text-sm w-full rounded bg-gray-100 border-none placeholder-gray-900 px-4 py-2 pl-8">
            <div class="absolute top-3 flex items-center h-full ml-2">
                <svg class="w-4 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
        {{-- sorting by difficulty --}}
        <div class="w-full md:w-1/3">
            <label class="font-medium text-xs lg:text-sm" for="sort_by">Sort by difficulty</label>
            <select wire:model="sort_quiz_difficulty" name="category" id="sort_by"
                class="text-sm w-full rounded border-none px-4 py-2 bg-gray-100">
                <option value="">All</option>
                @foreach (App\Models\Difficulty::all() as $difficulty)
                    <option value="{{ $difficulty->id }}">{{ $difficulty->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    </section>
    {{-- sorting panel end --}}

    <article class="mt-7 grid grid-cols-1 mb-5 gap-5 lg:grid-cols-3">
        @forelse ($quizzes as $quiz)
            <div class="bg-white p-4 border rounded shadow-sm hover:shadow-xl shadow-black/20 flex flex-col gap-y-2">
                <div>
                    <h6 class="text-base font-bold tracking-wider inline-flex">
                        {{ $quiz->name.' ' }}
                    </h6>
                    <span class="bg-gray-100 whitespace-nowrap text-indigo-600 italic text-xs p-1 px-2 rounded inline-flex">
                        {{ $quiz->difficulty->name ?? 'Easy' }}
                    </span>
                </div>
                <p class="text-sm mb-2"> {{$quiz->questions->count() . ' questions'}} </p>
                <a href="{{ route('quiz.start', ['quiz' => $quiz]) }}"
                    class="block w-full py-2 mt-3 text-sm font-semibold text-center text-white bg-indigo-600 rounded shadow hover:bg-indigo-700 focus:outline-none focus:ring active:bg-indigo-500 sm:w-auto">
                    Take quiz
                </a>
            </div>
        @empty
            <article
                class="col-span-4 space-x-4 flex justify-center items-center bg-indigo-100 text-indigo-500 border border-indigo-500 p-5 rounded">
                <x-Icons.caution class="h-10 w-10 flex-shrink-0" />
                <p class="tracking-wider text-sm">
                    Sorry, quizzes are still in developement. Check back later.
                </p>
            </article>
        @endforelse
    </article>

</section>
