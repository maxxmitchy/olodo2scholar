<section class="relative">
    <x-navigation.header>
        <div class="flex items-center justify-center text-2xl font-bold text-indigo-600">
            <strong class="text-black">olodo</strong>2Scholar
        </div>
    </x-navigation.header>

    <section class="lg:grid lg:grid-cols-2 pt-20">
        <article class="lg:py-0 py-5 lg:h-screen">
            <div class="lg:pl-28 lg:pr-16 lg:overflow-y-scroll lg:fixed lg:w-1/2 px-5">

                <section class="lg:pt-8" x-data="{
                    questions: @js($this->currentquiz->questions),
                    currentQuestion: $persist(0),
                    answers: $persist([]),

                    next() {
                        this.currentQuestion = Math.min(this.currentQuestion + 1, this.questions.length - 1);
                    },

                    prev() {
                        this.currentQuestion = Math.max(this.currentQuestion - 1, 0);
                    },

                    get answer() {
                        const answer = this.answers.find(e => e.question === this.currentQuestion);
                        return answer ? answer.answer : '';
                    },

                    set answer(value) {
                        const index = this.answers.findIndex(answer => answer.question === this.currentQuestion);
                        if (index !== -1) {
                            this.answers.splice(index, 1, value);
                        } else {
                            this.answers.push(value);
                        }
                    }
                }">
                    <section class="">
                        <a href="" class="hidden lg:flex space-x-2 items-center">
                            <x-Icons.chevLeft class="h-3 w-3" />
                            <h4 class="underline tracking-wider text-purple-600 text-sm font-bold">Go back</h4>
                        </a>

                        <header class="lg:mb-8 mb-5">
                            <a href="{{ route('course.course_details', ['course' => $this->currenttopic->course->key]) }}"
                                class="text-base lg:hidden underline lg:text-lg font-bold tracking-wider">
                                {{ $this->currenttopic->course->title }} ({{ $this->currenttopic->title }})
                            </a>
                        </header>

                        <article class="mb-5 lg:mb-8">
                            <div class="flex items-end text-sm sm:text-base font-bold tracking-wider text-gray-400">
                                <strong class="mr-2 text-black">Question</strong>
                                <p class="text-xs" x-text="currentQuestion + 1 "></p>
                                <p class="text-xs">/</p>
                                <p class="text-xs" x-text="questions.length"></p>
                            </div>
                        </article>

                        <section class="mb-24">
                            <template x-for="(question, index) in questions">
                                <div class="" x-show="currentQuestion === index" :key="question.id">

                                    <p class="mb-6 text-sm tracking-wider text-gray-900" x-text="question.content">
                                    </p>

                                    <x-quiz.mcq />
                                </div>
                            </template>
                        </section>

                        <div class="fixed p-5 bg-white bottom-0 inset-x-0 w-full shadow lg:hidden space-x-4">
                            <button @click.debounce.100="prev"
                                class="inline-flex items-center px-5 py-3 border
                                rounded-lg font-semibold text-xs text-gray-800 dark:text-gray-800 uppercase tracking-widest
                                transition ease-in-out duration-150 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2
                                dark:focus:ring-offset-gray-800">
                                prev
                            </button>
                            <button @click.debounce.100="next"
                                class="inline-flex items-center px-5 py-3 bg-gray-800 dark:bg-gray-200 border border-transparent
                                rounded-lg font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest
                                hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900
                                dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2
                                dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                next
                            </button>
                        </div>

                        <div class="hidden lg:flex space-x-4">
                            <button @click.debounce.100="prev"
                                class="inline-flex items-center p-3 border
                                rounded-lg font-semibold text-xs text-gray-800 dark:text-gray-800 uppercase tracking-widest
                                transition ease-in-out duration-150 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2
                                dark:focus:ring-offset-gray-800">
                                prev
                            </button>
                            <button @click.debounce.100="next"
                                class="inline-flex items-center p-3 bg-gray-800 dark:bg-gray-200 border border-transparent
                                rounded-lg font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest
                                hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900
                                dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2
                                dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                next
                            </button>
                        </div>
                    </section>
            </div>
        </article>

        <article class="hidden lg:px-24 lg:py-12 py-8 px-5 border-t lg:border-b-0 lg:border-l">
            <h4 class="text-center tracking-wider text-lg font-semibold">
                Tap each summary for break down
            </h4>
            <article class="mt-12 lg:grid lg:grid-cols-2 grid-cols-1 lg:gap-5">
                @foreach ([1, 2, 3, 4, 5, 3, 5] as $i)
                    <div class="h-36 bg-gray-50 mb-8 rounded"></div>
                @endforeach
            </article>
        </article>
    </section>
</section>
