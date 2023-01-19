<section>

    <x-navigation.header>
        <div class="flex items-center justify-center text-2xl font-bold text-indigo-600">
            <strong class="text-black">olodo</strong>2Scholar
        </div>
    </x-navigation.header>

    <div class="mx-auto max-w-3xl" x-data="{
            questions: @js($this->currentquestionbank->questions),
            currentQuestion: $persist(0),
            answers: $persist([]),

            minutes: @entangle('minutes'),
            seconds: @entangle('seconds'),
            interval: null,

            startTimer() {
                this.interval = setInterval(() => {

                    if (this.seconds === 0) {
                        if (this.minutes === 0) {
                            this.stopTimer();
                        } else {
                            this.seconds = 59;
                            this.minutes--;
                        }
                    }else{
                        this.seconds--;
                    }
                }, 1000);
            },

            stopTimer() {
                clearInterval(this.interval);
                @this.call('timeElapsed')
            },

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

        <div class="bg-indigo-600 mt-[58px] py-3 px-5 inset-x-0 fixed w-full flex justify-between">
            <div class="flex space-x-1 items-center text-sm sm:text-base font-bold tracking-wider text-white">
                <strong>Item:</strong>
                <p x-text="currentQuestion + 1 "></p>
                <p>of</p>
                <p x-text="questions.length"></p>
            </div>
            <div class="space-x-10 flex items-center">
                <div class="flex flex-col justify-center items-center space-y-1 text-white">
                    <svg @click.debounce.100="prev" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                    <small class="font-bold text-xs">Prev</small>
                </div>

                <div class="hover:text-indigo-200 flex flex-col space-y-1 justify-center items-center text-white">
                    <x-Icons.chevRight @click.debounce.100="next"
                        class="h-5 w-5"
                    />
                    <small class="font-bold text-xs">Next</small>
                </div>
            </div>
        </div>

        <section class="pt-[155px] px-5 overflow-y-scroll h-screen"
            :class="{'blur-sm': interval == null}"
        >
            <template x-for="(question, index) in questions">
                <div class="" x-show="currentQuestion === index" :key="question.id">

                    <p class="mb-6 text-sm tracking-wider text-gray-900" x-text="question.content">
                    </p>

                    <x-quiz.mcq />
                </div>
            </template>
        </section>

        <div class="bg-indigo-600 py-3 px-5 fixed inset-x-0 bottom-0 w-full flex items-center justify-between">
            <div class="flex space-y-1 flex-col">
                <h6 class="tracking-wider text-white text-sm font-bold">Time Left:</h6>
                <p class="tracking-wider text-sm font-bold text-white underline">00:{{ $minutes }}:{{ $seconds }}</p>
            </div>
            <button @click="startTimer"
                class="cursor-pointer ml-3 inline-block rounded flex-shrink-0 bg-white px-5 py-2 text-sm font-bold text-indigo-600">
                Start
            </button>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        window.onbeforeunload = function() {
            return "Are you sure you want to refresh the page?";
        }
    </script>
@endpush
