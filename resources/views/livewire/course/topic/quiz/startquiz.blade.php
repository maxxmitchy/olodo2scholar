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

    <section class="pt-20 max-w-3xl mx-auto">
        <article class="py-5 lg:py-0">
            <div class="px-5">

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
                        <a href="{{ route('course.topic', ['course' => $this->currenttopic->course->key , 'topic' => $this->currenttopic->key]) }}" class="bg-gray-100 text-indigo-500 p-2 px-3 rounded text-xs whitespace-nowrap ">
                            ← Go back
                        </a>

                        <header class="my-5 lg:mb-8">
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
                                class="inline-flex items-center px-5 py-3 text-xs font-semibold tracking-widest text-indigo-600 uppercase transition duration-150 ease-in-out border rounded-lg dark:text-gray-800 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                prev
                            </button>
                            <button @click.debounce.100="next"
                                class="inline-flex items-center px-5 py-3 text-xs font-semibold tracking-widest text-indigo-600 uppercase transition duration-150 ease-in-out border rounded-lg dark:text-gray-800 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                next
                            </button>

                        </div>

                        <div class="bg-white hidden fixed inset-x-0 py-5 shadow-xl w-full bottom-0 lg:flex ">
                            <div class="space-x-4 mx-auto lg:w-3/5 lg:px-10">
                                <button @click.debounce.100="prev"
                                    class="inline-flex items-center px-5 py-3 text-xs font-semibold tracking-widest text-indigo-600 uppercase transition duration-150 ease-in-out border rounded-lg  focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                    prev
                                </button>

                                <button @click.debounce.100="next"
                                    class="inline-flex items-center px-5 py-3 text-xs font-semibold tracking-widest text-indigo-600 uppercase transition duration-150 ease-in-out border rounded-lg  focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                    next
                                </button>
                            </div>
                        </div>
                    </section>
            </div>
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
