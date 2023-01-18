<template x-for="(option, index) in question.options">
    <div class="mb-4">
        <div :id="'question-options-' + index"
            @click="answer = {question: currentQuestion, actualQuestion: question.id, answer: option.id}"
            :class="{
                'border-rose-400 text-red shadow-rose-200 shadow-md': (answer === option.id && !option.correct_option),
                'border-gray-300': answer !== option.id,
                'border-green/70 shadow-green/75 shadow-md text-green': (Boolean(answer) === true && option.correct_option)
            }"
            class="flex items-center space-x-2 border p-3 rounded-lg">
            <div :class="{
                'bg-red': (answer === option.id && !option.correct_option),
                'bg-gray-300': answer !== option.id,
                'bg-green': (Boolean(answer) === true && option.correct_option)
            }"
                class="flex items-center justify-center h-3 w-3 flex-shrink-0 rounded-full">
                <div class="bg-white h-1 flex-shrink-0 w-1 rounded-full"></div>
            </div>
            <div class="flex flex-col space-y-3">
                <p x-text="option.body"
                    :class="{
                        'font-bold': answer === option.id,
                        '': answer !== option.id,
                        'font-bold' : Boolean(answer) === true
                    }"
                    class="flex text-sm tracking-wider items-center cursor-pointer"></p>
                <div x-show="(option.correct_option && Boolean(answer) === true )">
                    <div class="h-28 overflow-y-scroll p-2 mt-0">
                        <span class="text-green flex space-x-2">
                            <p class="text-sm tracking-wider">Correct answer</p>
                            <x-Icons.check class="font-bold h-6 w-6" />
                        </span>
                        <p x-text="option.explanation" class="tracking-wider text-xs text-gray-500"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
