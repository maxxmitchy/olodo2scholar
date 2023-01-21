<template x-for="(option, index) in question.options">
    <div class="mb-4">
        <div :id="'question-options-' + index"
            @click="answer = {question: currentQuestion, actualQuestion: question.id, answer: option.id}"
            :class="{
                'border-gray-300': answer !== option.id,
                'border-blue text-blue': answer === option.id
            }"
            class="flex items-center space-x-2 border p-2 rounded">
            <div :class="{
                'bg-gray-300': answer !== option.id,
                'bg-blue': answer === option.id,
            }"
                class="flex items-center justify-center h-2 w-2 flex-shrink-0 rounded-full">
                <div class="bg-white h-1 w-1 rounded-full"></div>
            </div>
            <p x-text="option.body"
                :class="{
                    'font-bold': answer === option.id,
                    '': answer !== option.id
                }"
                class="flex text-sm tracking-wider items-center cursor-pointer"></p>
        </div>
    </div>
</template>
