<template x-for="(option, index) in question.options">
    <div class="mb-4" x-data="{
            selectAnswer: function(){
                this.answer = {question: this.currentQuestion, actualQuestion: this.question.id, answer: this.option.id};
            }
        }">
        <div :id="'question-options-' + index"
            x-on:click="selectAnswer"
            :class="{
                'border-rose-400 text-red': (answer === option.id && !option.correct_option),
                'border-gray-300': answer !== option.id,
                'border-green/70 shadow-green/75 shadow-md text-green': (Boolean(answer) === true && option.correct_option)
            }"
            class="flex items-center space-x-2 border p-3 rounded-lg">

            {{--  --}}
            <input name="selected_option"
                :class="'text-'+(option.correct_option ? 'green' : 'red')"
                type="radio" :disabled="Boolean(answer) == true" value="" :checked="(answer === option.id)">
            {{--  --}}

            <div class="flex flex-col">
                <p x-text="option.body"
                    :class="{
                        'font-bold': answer === option.id,
                        '': answer !== option.id,
                        'font-bold' : Boolean(answer) === true
                    }"
                    class="flex text-sm tracking-wider items-center cursor-pointer"></p>
                <div x-show="(option.correct_option && Boolean(answer) === true )">
                    <div class="p-2 mt-0">
                        <span class="text-green flex space-x-2">
                            <p class="text-xs tracking-wider">Correct answer</p>
                            <x-Icons.check class="font-bold h-4 w-4" />
                        </span>
                        <p x-text="option.explanation" class="tracking-wider text-xs text-gray-500"></p>
                    </div>
                </div>

                <div x-show="(answer === option.id && !option.correct_option)">
                    <div class="px-2 mt-0">
                        <span class="text-red flex items-center space-x-2">
                            <p class="text-xs tracking-wider">Incorrect answer</p>
                            <span class="text-xl">&times;</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
