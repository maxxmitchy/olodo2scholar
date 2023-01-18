<section class="p-5 lg:max-w-2xl lg:mx-auto" x-data="{
    options: @entangle('options').defer,
    answer: @entangle('answer').defer,

    addNewOption() {
        if (this.options.length < 4) {
            this.options.push('');
            this.$nextTick(() => this.$refs.option.focus());
        }
    },

    removeOption(index) {
        this.options.splice(index, 1);
    }
}">
    <h3 class="mb-4 tracking-wider text-lg font-bold">
        Create questions for
        <a class="underline"
        href="{{ route('auth.question_bank_questions',
            ['question_bank' => $this->currentquestionbank->key] ) }}">
                {{ $this->currentquestionbank->title }}
        </a>
    </h3>

    <form method="POST" wire:submit.prevent="store">
        @csrf
        <!-- Question Content -->
        <div class="mt-8">
            <!-- <x-input-label for="content" :value="__('Question Content')" /> -->
            <label for="content" class="text-sm tracking-wider r-only">Content</label>

            <x-text-input id="content" placeholder="enter question..."
                class="placeholder:text-gray-300 text-sm block mt-1 w-full" wire:model.defer="content" type="text"
                name="title" :value="old('content')" autocomplete="content" required />

            <x-input-error :messages="$errors->get('content')" class="mt-2" />
        </div>

        <!-- Question Explanation -->
        <div class="my-6">
            <label for="explanation" class="text-sm tracking-wider r-only">Explanation (optional)</label>

            <textarea
                class="shadow mt-1 form-control block w-full px-3 py-1.5 placeholder:text-gray-400 text-sm font-normal
                    bg-white border border-gray-200 transition rounded-lg ease-in-out m-0
                text-gray-700 focus:bg-white focus:outline-none
                focus:border-indigo-600
                "
                id="explanation" rows="5" placeholder="explain question and answer..." wire:model.defer="explanation"></textarea>
            <x-input-error :messages="$errors->get('explanation')" class="mt-2" />
        </div>

        <div class="">
            <label for="option" class="tracking-wider text-sm font-bold">Options</label>

            <div class="py-1"></div>

            <template x-for="(option, index) in options">
                <div class="flex space-x-4 w-full mb-3 items-center">
                    <input type="radio" @click="answer = index" name="option" :value="answer"
                        class="border checked:bg-indigo-500 focus:ring-indigo-500 text-indigo-500 w-3 h-3 flex-shrink-0 rounded-full"
                        id="" required>
                    <input x-ref="option"
                        class="text-sm w-full rounded-lg shadow-sm border-gray-200 focus:border-indigo-300 focus:ring
                            focus:ring-indigo-200 focus:ring-opacity-50 py-3"
                        type="text" x-model.defer="options[index]" id="option" required>

                    <button class="text-lg font-bold text-red" type="button"
                        @click="removeOption(index)">&times;</button>
                </div>
            </template>
        </div>

        <div class="mt-12 flex space-x-3 justify-center items-center">
            <a @click="addNewOption"
                class="flex-shrink-0 rounded-lg p-3 flex justify-center items-center text-sm border font-medium tracking-wider
                    focus:border-indigo-300 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                &plus; option
            </a>

            <button type="submit"
                class="bg-indigo-500 p-3 text-base font-semibold text-white
                flex rounded-lg justify-center w-full hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 shadow focus:ring ring-indigo-300">
                {{ __('Save Question') }}
            </button>
        </div>
    </form>

    {{--<template>
        <div x-show="false" x-data="{
            minutes: @entangle('time.minutes').defer,
            seconds: @entangle('time.seconds').defer,
            interval: null,

            startTimer() {
                this.interval = setInterval(() => {
                    this.seconds--;
                    if (this.seconds === 0) {
                        if (this.minutes === 0) {
                            this.stopTimer();
                        } else {
                            this.seconds = 59;
                            this.minutes--;
                        }
                    }
                }, 1000);
            },

            stopTimer() {
                clearInterval(this.interval);
                @this.call('timeElapsed')
            }
        }">
            <button @click="startTimer">Start Timer</button>
            <button @click="stopTimer">Stop Timer</button>
            <p>{{ minutes }}:{{ seconds }}</p>
        </div>
    </template>--}}

</section>
