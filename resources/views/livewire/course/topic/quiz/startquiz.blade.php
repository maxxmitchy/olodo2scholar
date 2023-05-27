<section class="relative" x-init="$nextTick(() => { resetQuiz() });" x-data="{
    startQuiz: false,
    endQuiz: false,
    submit() {
        this.endQuiz = true;
    },

    questions: @js($this->quiz->questions),
    currentQuestion: $persist(0),
    answers: $persist([]),
    score: $persist(0),

    next() {
        this.currentQuestion = Math.min(this.currentQuestion + 1, this.questions.length - 1);
    },

    prev() {
        this.currentQuestion = Math.max(this.currentQuestion - 1, 0);
    },

    get answer() {
        const answer = this.answers.find(e => e.question === this.currentQuestion);
        return answer ? answer.option : '';
    },

    set answer(value) {
        const index = this.answers.findIndex(answer => answer.question === this.currentQuestion);
        if (index === -1) {
            this.answers.push(value);
        }
    },

    percentile: function() {
        return (this.score / this.questions.length * 100).toFixed(1) + '%';
    },

    resetQuiz: function() {
        this.currentQuestion = 0
        this.answers = [];
        this.score = 0;
    },

    retakeQuiz: function() {
        this.endQuiz = !this.endQuiz;
        this.startQuiz = !this.startQuiz;
        this.resetQuiz();
    },

    cancelQuiz: function() {
        this.$refs.cancelForm.submit();
    }
}">
    <x-navigation.header>
        <div class="flex items-center justify-center text-2xl font-bold text-indigo-600">
            <strong class="text-black">olodo</strong>2Scholar
        </div>
    </x-navigation.header>

    @section('title', config('app.name') . ' | Take Quiz')

    <section class="pt-4 max-w-3xl mx-auto">

        <article class="py-5 lg:py-0">
            <div class="px-5">

                <form x-ref="form" action="{{ route('topic.topic', ['topic' => $this->quiz->topic->key]) }}">
                    <input name="navTab" value="Quizzes" hidden>
                </form>

                <button x-on:click="$refs.form.submit()"
                    class="bg-gray-100 focus:ring-indigo-500 focus:ring-2 text-indigo-500 p-2 px-3 rounded text-xs">
                    ← Back to quizzes
                </button>

                <section class="lg:pt-8">

                    <section :class="{
                        'blur': !startQuiz
                    }">

                        <header class="my-5 lg:mb-8">
                            <a href="{{ route('course.course_details', ['course' => $this->quiz->topic->course->key]) }}"
                                class="hover:underline text-base tracking-wider lg:text-lg">
                                <strong class="text-indigo-600">
                                    {{ $this->quiz->name }}
                                </strong>
                            </a>
                        </header>
                        <article class="mb-5 lg:mb-8">
                            <div class="flex items-center text-sm font-bold tracking-wider text-gray-600 sm:text-base">
                                <p class="mr-2">Question</p>
                                <p class="text-base" x-text="currentQuestion + 1 "></p>
                                <p class="text-xs mx-2">of</p>
                                <p class="text-base" x-text="questions.length"></p>
                            </div>
                        </article>
                        {{--  --}}
                        <template x-for="(question, index) in questions">
                            <div x-data="{
                                    correct_id: function(){
                                        return question.options.find(e => {
                                            return e.correct_option === true
                                        }).id
                                    },
                                }" class="" x-show="currentQuestion === index" :key="question.id">

                                <p class="mb-6 text-sm tracking-wider font-semibold" x-text="question.content">
                                </p>

                                <x-quiz.mcq />
                            </div>
                        </template>
                        <div class="h-24">

                            <div class="fixed inset-x-0 bottom-0 w-full p-5 flex   bg-white shadow ">
                                <div class="lg:w-3/5 space-x-4 lg:mx-auto lg:px-8 flex justify-between">
                                    <div class="space-x-4">
                                        <button @click.debounce.100="prev" :disabled="this.currentQuestion == 0"
                                            :class="{
                                                'inline-flex items-center px-5 py-3 text-xs font-semibold tracking-widest border-gray-200 text-gray-400 uppercase transition duration-150 ease-in-out border rounded-lg  focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 ': currentQuestion ==
                                                    0,
                                                'inline-flex items-center px-5 py-3 text-xs font-semibold tracking-widest text-indigo-600 uppercase transition duration-150 ease-in-out border rounded-lg  focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2': currentQuestion >
                                                    0
                                            }">
                                            prev
                                        </button>
                                        <button @click.debounce.100="next"
                                            :class="{
                                                'inline-flex items-center px-5 py-3 text-xs font-semibold tracking-widest text-gray-700 bg-gray-300 uppercase transition duration-150 ease-in-out border rounded-lg  focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 ': currentQuestion +
                                                    1 ==
                                                    questions.length,
                                                'inline-flex items-center px-5 py-3 text-xs font-semibold tracking-widest text-indigo-600 uppercase transition duration-150 ease-in-out border rounded-lg  focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2': currentQuestion +
                                                    1 < questions.length
                                            }">
                                            next
                                        </button>
                                    </div>
                                    <button @click.debounce.100="submit"
                                        class=" items-center px-5 py-3 text-xs font-semibold tracking-widest text-white bg-indigo-600 uppercase transition duration-150 ease-in-out border rounded-lg  focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 ml-auto">
                                        finish
                                    </button>
                                </div>
                            </div>
                            <div class="h-8"></div>
                    </section>
                </section>
            </div>
        </article>

    </section>
    {{-- before quiz starts --}}
    <div x-cloak x-show="!startQuiz" class="bg-gray-800/[0.8] inset-0 fixed flex p-4 lg:p-12">
        <div class="p-4 bg-white lg:w-1/3 m-auto rounded space-y-4">
            <p class="text-lg font-extrabold">Study Quiz: {{ $this->quiz->name }}</p>
            <span class="p-1 px-2 text-xs text-indigo-800 bg-indigo-200 rounded">{{ $this->quiz->questions->count() }}
                questions</span>
            <div class="flex space-x-4 pt-4 font-bold">
                <button x-on:click="startQuiz = true"
                    class="inline-flex px-4 p-2 tracking-wider text-white uppercase bg-indigo-600 rounded">start</button>
                <button x-on:click="cancelQuiz"
                    class="px-4 p-2 tracking-wider text-indigo-600 uppercase bg-white border border-indigo-600 rounded">
                    back</button>
            </div>
        </div>
    </div>
    {{-- quiz is finished --}}

    {{-- endquiz --}}
    <div x-cloak x-show="endQuiz" class="bg-gray-800/[0.8] inset-0 fixed flex p-4 lg:p-12">
        <div class="p-4 bg-white lg:w-1/3 m-auto rounded space-y-4 border-t-4 border-indigo-600">
            <div class="p-6 space-y-2 w-full text-center">
                <p class="text-3xl font-bold">Quiz Finished</p>
                <p class="text-gray-500">Your score is <span class="font-bold text-black"
                        x-text="(score)+'/'+'{{ $this->quiz->questions->count() }}'"></span> </p>
            </div>
            <div class="w-full flex">
                <div
                    class="rounded-full border-4 h-40 w-40 border-indigo-600 bg-white shadow shadow-indigo-100 p-3 mx-auto flex">
                    <p class="text-4xl font-extrabold text-indigo-600 m-auto" x-text="percentile"></p>
                </div>
            </div>
            {{-- back to topic form --}}
            <form x-ref="cancelForm" hidden method="GET"
                action="{{ route('topic.topic', ['topic' => $this->quiz->topic->key]) }}">
                <input hidden name="navTab" value="Quizzes">
            </form>
            <div class="grid grid-cols-2 gap-4 pt-4 font-bold text-center">
                <button type="button" x-on:click="retakeQuiz"
                    class="px-4 p-2 tracking-wider text-white uppercase bg-indigo-600 rounded">retake quiz</button>
                <button x-on:click="cancelQuiz"
                    class="px-4 p-2 tracking-wider text-indigo-600 uppercase bg-white border border-indigo-600 rounded">back</button>
            </div>
        </div>
    </div>
    {{-- endquiz --}}
</section>

@push('scripts')
    <!-- <script>
        window.onbeforeunload = function() {
            return "Are you sure you want to refresh the page?";
        }
    </script> -->
@endpush
