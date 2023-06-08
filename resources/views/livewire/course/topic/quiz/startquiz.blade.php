<section class="relative" x-init="$nextTick(() => { resetQuiz() });
$watch('time_left', value => {
    if (value == 0) {
        calculateScore();
        $modals.show('timeup-modal');
    }
});" x-data="{

    correctOptionId(answer) {
            const question = this.questions.find(question => question.id === answer.actualQuestion);
            if (question) {
                const correctOption = question.options.find(option => option.correct_option === true);
                if (correctOption) {
                    return correctOption.id;
                }
            }
            return null;
        },

        calculateScore() {
            this.score = 0;
            if (this.answers.length) {
                this.answers.forEach(answer => {
                    const question = this.questions.find(question => question.id === answer.actualQuestion);
                    if (question) {
                        const correctOptionId = this.correctOptionId(answer);

                        console.log(answer.option, correctOptionId);
                        if (answer.option == correctOptionId) {
                            this.score += 1;
                        }
                    }
                });
            }
        },

        startQuiz: false,

        endQuiz: false,

        quiz_mode: 'Free',

        timer_speed: 1,

        {{-- time_left is -1 in 'Free' mode  --}}
    time_left: -1,

        interval: null,

        timerDuration: function() {
            {{--  --}}
            return this.questions.length * @js($this->quiz->difficulty->timer ?? 10) / this.timer_speed;
        },

        formatTimerSpeed: function() {
            const minutes = (this.timerDuration() / 60 < 1) ? 0 : Math.floor(this.timerDuration() / 60);

            const extra_secs = Math.floor(this.timerDuration() % 60);

            return {
                seconds: extra_secs,
                minutes: minutes,
                text: (minutes && `${minutes} min `) + (extra_secs && `${extra_secs} sec`),
            };
        },

        submit() {
            if (this.quiz_mode == 'Free') {
                this.endQuiz = true;
            } else if (this.quiz_mode == 'Timer' && this.time_left == 0) {
                this.endQuiz = true;
            } else {
                this.time_left = 0;
                this.currentQuestion = 0;
            }
        },

        formatTimer() {
            return new Date(this.time_left * 1000).toISOString().slice(14, 19);
        },

        startTimer: function() {
            this.time_left = Math.floor(this.timerDuration());
            let interval = setInterval(() => {
                if (this.time_left > 0) {
                    this.time_left -= 1;
                } else {
                    clearInterval(interval);
                }
            }, 1000);
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
            {{-- findIndex of current questions answer and if it doesnt exist, push to the answers array --}}
            const index = this.answers.findIndex(answer => answer.question === this.currentQuestion);
            if (index === -1) {
                {{-- if it doesn exists and in Free mode --}}
                this.answers.push(value);
                {{-- this.answers[index] = value; --}}
            } else if (this.quiz_mode === 'Timer') {
                {{-- in timed mode update answer --}}
                this.answers.splice(index, 1, value);
            }
        },

        percentile: function() {
            return (this.score / this.questions.length * 100).toFixed(1) + '%';
        },

        takeQuiz: function() {
            if (this.quiz_mode === 'Timer') {
                this.startTimer();
            }
            this.startQuiz = true;
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
        },

        isAnswered(questionId) {
            return this.answers.some(answer => answer.actualQuestion === questionId);
        },
}">
    <x-navigation.header>
        <div class="flex items-center justify-center text-2xl font-bold text-indigo-600">
            <strong class="text-black">olodo</strong>2Scholar
        </div>
    </x-navigation.header>

    @section('title', config('app.name') . ' | Take Quiz')

    <section wire:ignore class="pt-4 max-w-3xl mx-auto">
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
                    <section wire:target="toggleBookmark" wire:loading.remove
                        :class="{
                            'blur': !startQuiz
                        }">

                        <header class="my-5 lg:mb-8">
                            <a href="{{ route('course.course_details', ['course' => $this->quiz->topic->course->key]) }}"
                                class="hover:underline text-base uppercase tracking-wider lg:text-lg">
                                <strong class="text-indigo-600">
                                    quiz: {{ $this->quiz->name }}
                                </strong>
                            </a>
                        </header>

                        {{-- questions control --}}
                        <x-quiz.partials.question-control />

                        {{--  --}}
                        <template x-for="(question, index) in questions">
                            <div wire:ignore x-data="{
                                correct_id: function() {
                                    return question.options.find(e => {
                                        return e.correct_option === true
                                    }).id
                                },
                            }" class="" x-show="currentQuestion === index"
                                :key="question.id">

                                <p class="mb-6 prose-base prose prose:drop-shadow-md prose-headings:font-bold
                                    prose-slate prose-blockquote:font-semibold prose-a:font-bold prose-a:text-white prose-a:underline"
                                    x-html="question.content">
                                </p>

                                <x-quiz.mcq />
                            </div>
                        </template>

                        <div x-cloak class="h-24">
                            <div
                                class="fixed inset-x-0 bottom-0 w-full p-5 flex  bg-white shadow-lg border-t border-gray-200 ">
                                <div class="lg:w-3/5 space-x-4 lg:mx-auto lg:px-8 flex justify-between">
                                    <div class="space-x-4">
                                        <button @click.debounce.50="prev" :disabled="currentQuestion == 0"
                                            :class="{
                                                'inline-flex items-center px-5 py-3 text-xs font-semibold tracking-widest border-gray-200 text-gray-400 uppercase transition duration-150 ease-in-out border rounded-lg  focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 ': currentQuestion ==
                                                    0,
                                                'inline-flex items-center px-5 py-3 text-xs font-semibold tracking-widest text-indigo-600 uppercase transition duration-150 ease-in-out border rounded-lg  focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2': currentQuestion >
                                                    0
                                            }">
                                            prev
                                        </button>
                                        <button @click.debounce.50="next"
                                            :disabled="currentQuestion == questions.length"
                                            :class="{
                                                'inline-flex items-center px-5 py-3 text-xs font-semibold tracking-widest border-gray-200 text-gray-400 uppercase transition duration-150 ease-in-out border rounded-lg  focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 ': currentQuestion +
                                                    1 ==
                                                    questions.length,
                                                'inline-flex items-center px-5 py-3 text-xs font-semibold tracking-widest text-indigo-600 uppercase transition duration-150 ease-in-out border rounded-lg  focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2': currentQuestion +
                                                    1 < questions.length
                                            }">
                                            next
                                        </button>
                                    </div>
                                    <button @click.debounce.100="submit"
                                        x-text="(quiz_mode == 'Timer' && time_left > 0 ) ? 'end' : 'finish'"
                                        class=" items-center px-5 py-3 text-xs font-semibold tracking-widest text-white bg-indigo-600 uppercase transition duration-150 ease-in-out border rounded-lg  focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 ml-auto">

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
            {{-- quiz type --}}
            <div class="flex flex-col gap-3 text-sm">
                <span class="flex gap-2">
                    <input id="free" type="radio" name="quiz_mode" x-model="quiz_mode" value="Free"
                        class="text-indigo-600">
                    <label for="free">Free mode - <small class="italic">Answer Questions Freely</small></label>
                </span>
                {{--  --}}
                <span class="flex gap-2">
                    <input id="timer" type="radio" name="quiz_mode" x-model="quiz_mode" value="Timer"
                        class="text-indigo-600">
                    <label for="timer">Timed mode - <small class="italic">Answer Questions Before
                            Timeout</small></label>
                </span>
                {{-- timed mode options --}}
                <div x-transition.show x-cloak x-show="quiz_mode == `Timer`" class="flex gap-4 flex-wrap text-xs">
                    <button class="p-3 border  rounded-lg  " x-on:click="timer_speed = 1"
                        x-bind:class="{
                            'bg-gray-300/40 text-gray-600 border-gray-500': (timer_speed != 1),
                            'bg-indigo-300/40 text-indigo-600 border-indigo-500': (timer_speed == 1),
                        }">Normal
                        speed</button>
                    <button x-on:click="timer_speed = 1.5"
                        class="p-3 border border-gray-500 rounded-lg bg-gray-300/40 text-gray-600"
                        x-bind:class="{
                            'bg-gray-300/40 text-gray-600 border-gray-500': (timer_speed != 1.5),
                            'bg-indigo-300/40 text-indigo-600 border-indigo-500': (timer_speed == 1.5),
                        }">Lightning
                        speed (1.5x faster)</button>
                </div>
                {{-- show time --}}
                <div x-cloak x-show="quiz_mode == `Timer`" class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75"
                        stroke="currentColor" class="w-6 h-6 text-indigo-400/60">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-lg font-bold text-indigo-500" x-text="formatTimerSpeed().text"></span>
                </div>
            </div>
            <div class="flex space-x-4 pt-4 font-bold">
                <button x-on:click="takeQuiz"
                    class="inline-flex px-4 p-2 tracking-wider text-white uppercase bg-indigo-600 rounded-lg">start</button>
                <button x-on:click="cancelQuiz"
                    class="px-4 p-2 tracking-wider text-indigo-600 uppercase bg-white border border-indigo-600 rounded-lg">
                    back</button>
            </div>
            <hr>
            @if (auth()->check())
                <button wire:click="toggleBookmark"
                    x-text="@js($this->bookmarks)
                ? 'Remove quiz from bookmark'
                : (@js(auth()->check()) ? 'Add quiz to bookmark' : 'Login to bookmark')"
                    x-bind:class="{
                        'bg-green text-white focus:ring-2': @js($this->bookmarks),
                        'text-indigo-600 bg-indigo-200/30': @js(!$this->bookmarks),
                    }"
                    wire:loading.class="outline outline-offset-2"
                    class="w-full font-semibold px-4 p-2 tracking-wider rounded flex justify-center"></button>
            @else
                <button @click="$modals.show('login-modal')"
                    class="w-full font-semibold px-4 p-2 tracking-wider text-indigo-600 bg-indigo-200/30 rounded flex justify-center">Sign
                    in to bookmark quiz</button>
            @endif
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

    {{-- login modal --}}
    <x-Bookmark.login-modal />

    {{-- time up modal --}}
    <x-quiz.partials.timeup-modal />
</section>

@push('scripts')
    <!-- <script>
        window.onbeforeunload = function() {
            return "Are you sure you want to refresh the page?";
        }
    </script> -->
@endpush
