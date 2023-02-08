<section class="relative" x-data="{
    init() {
        if (localStorage.getItem('_x_answers') !== null) {
            localStorage.clear()
        }
    },
}">
    <x-navigation.header>
        <div class="flex items-center justify-center text-2xl font-bold text-indigo-600">
            <strong class="text-black">olodo</strong>2Scholar
        </div>
    </x-navigation.header>

    <section class="pt-20 lg:grid lg:grid-cols-2">
        <article class="py-5 lg:py-0 lg:h-screen">
            <div class="px-5 lg:pl-28 lg:pr-16 lg:overflow-y-scroll lg:fixed lg:w-1/2">

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
                        if (index === -1) {
                            this.answers.push(value);
                        }
                    }
                }">
                    <section class="">
                        <a href="" class="items-center hidden space-x-2 lg:flex">
                            <x-Icons.chevLeft class="w-3 h-3" />
                            <h4 class="text-sm font-bold tracking-wider text-purple-600 underline">Go back</h4>
                        </a>

                        <header class="mb-5 lg:mb-8">
                            <a href="{{ route('course.course_details', ['course' => $this->currenttopic->course->key]) }}"
                                class="text-base font-bold tracking-wider lg:hidden lg:text-lg">
                                {{ $this->currenttopic->course->title }}
                                <strong class="underline ">
                                    ({{ $this->currenttopic->title }})
                                </strong>
                            </a>
                        </header>

                        <article class="mb-5 lg:mb-8">
                            <div class="flex items-end text-sm font-bold tracking-wider text-gray-400 sm:text-base">
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

                        <div class="fixed inset-x-0 bottom-0 w-full p-5 space-x-4 bg-white shadow lg:hidden">
                            <button @click.debounce.100="prev"
                                class="inline-flex items-center px-5 py-3 text-xs font-semibold tracking-widest text-gray-800 uppercase transition duration-150 ease-in-out border rounded-lg dark:text-gray-800 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                prev
                            </button>
                            <button @click.debounce.100="next"
                                class="inline-flex items-center px-5 py-3 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-lg dark:bg-gray-200 dark:text-gray-800 hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                next
                            </button>
                        </div>

                        <div class="hidden space-x-4 lg:flex">
                            <button @click.debounce.100="prev"
                                class="inline-flex items-center px-5 py-3 text-xs font-semibold tracking-widest text-gray-800 uppercase transition duration-150 ease-in-out border rounded-lg dark:text-gray-800 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                prev
                            </button>
                            <button @click.debounce.100="next"
                                class="inline-flex items-center px-5 py-3 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-lg dark:bg-gray-200 dark:text-gray-800 hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                next
                            </button>
                        </div>
                    </section>
            </div>
        </article>

        <article class="hidden px-5 py-8 border-t lg:px-24 lg:py-12 lg:border-b-0 lg:border-l">
            <h4 class="text-lg font-semibold tracking-wider text-center">
                Tap each summary for break down
            </h4>
            <article class="grid-cols-1 mt-12 lg:grid lg:grid-cols-2 lg:gap-5">
                @foreach ([1, 2, 3, 4, 5, 3, 5] as $i)
                    <div class="mb-8 rounded h-36 bg-gray-50"></div>
                @endforeach
            </article>
        </article>
    </section>
</section>

@push('scripts')
    <script>
        window.onbeforeunload = function() {
            return "Are you sure you want to refresh the page?";
        }
    </script>
@endpush
