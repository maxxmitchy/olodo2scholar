<template x-for="(option, index) in question.options">
    <div class="mb-4">
        <div
            :id="'question-options-'.index"
            @click="answer = {question: currentQuestion , actualQuestion: question.id, answer: option.id}"
            :class="{
                'border-red font-medium' : (parseInt(answer) === parseInt(option.id) && !!(!option.correct_option)),
                'border-gray-300' : parseInt(answer) !== parseInt(option.id),
                'border-green rounded-b-none' : (!!answer && !!option.correct_option)
            }"
            @class([
                "flex items-center space-x-2 border p-2 rounded",
            ])
        >
            <div :class="{
                    'bg-red' : (parseInt(answer) === parseInt(option.id) && !!(!option.correct_option)),
                    'bg-gray-300' : parseInt(answer) !== parseInt(option.id),
                    'bg-green' : (!!answer && !!option.correct_option)
                }"
                class="flex items-center justify-center h-2 w-2 flex-shrink-0 rounded-full">
                <div class="bg-white h-1 w-1 rounded-full"></div>
            </div>
            <p x-text="option.body"
                :class="{
                    'text-red' : (answer === option.id && !!(!option.correct_option)),
                    'text-gray-600' : answer !== option.id,
                    'text-green' : (!!answer && !!option.correct_option)
                }"
                class="flex text-sm tracking-wider items-center cursor-pointer"
            ></p>
        </div>
        <template x-if="!!answer && !!option.correct_option">
            <div class="h-28 overflow-y-scroll p-2 mt-0 border-l border-green">
                <p x-text="option.explanation" class="tracking-wider text-xs text-gray-500">
                    
                </p>
            </div>
        </template>
    </div>
</template>
