<template x-for="(option, index) in question.options">
    <div class="mb-4">
        <div
            :id="'question-options-'.index"
            @click="answer = {question: currentQuestion , actualQuestion: question.id, answer: option.id}"
            :class="{
                'border-red text-red' : (answer === option.id && !option.correct_option),
                'border-gray-300' : answer !== option.id,
                'border-green rounded-b-none text-green' : (answer === option.id && option.correct_option)
            }"
            @class([
                "flex items-center space-x-2 border p-2 rounded",
            ])
        >
            <div :class="{
                    'bg-red' : (answer === option.id && !option.correct_option),
                    'bg-gray-300' : answer !== option.id,
                    'bg-green' : (answer === option.id && option.correct_option)
                }"
                @class([
                    "flex items-center justify-center h-2 w-2 flex-shrink-0 rounded-full",
                ])
            >
                <div class="bg-white h-1 w-1 rounded-full"></div>
            </div>
            <p x-text="option.body"
            :class="{
                'font-bold' : answer === option.id,
                '' : answer !== option.id,
            }"
            @class([
                "flex text-sm tracking-wider items-center cursor-pointer",
            ])
            ></p>
            <div x-show="(option.correct_option && answer === option.id)">
                <div class="h-28 overflow-y-scroll p-2 mt-0 border-l border-green">
                    <span class="text-green flex space-x-2">
                        <strong class="text-sm">
                            Correct answer
                        </strong>
                        <x-Icons.check class="font-bold h-6 w-6"/>
                    </span>
                    <p x-text="option.explanation" class="tracking-wider text-xs text-gray-500"></p>
                </div>
            </div>
            <div x-show="(!option.correct_option && answer === option.id)">
                <div class="h-28 overflow-y-scroll p-2 mt-0 border-l border-red">
                    <span class="text-red flex space-x-2">
                        <strong class="text-sm">
                            wrong answer
                        </strong>
                        &times;
                    </span>
                    <p x-text="option.explanation" class="tracking-wider text-xs text-gray-500"></p>
                </div>
            </div>
        </div>
    </div>
</template>
