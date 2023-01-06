<section>
    <template x-for="(option, index) in question.options">
        <div class="mb-4">
            <div :id="'question-options-' + index"
                @click="answer = {question: currentQuestion, actualQuestion: question.id, answer: option.id}"
                :class="['flex items-center space-x-2 border p-2 rounded', parseInt(answer) === parseInt(option.id) && !option
                    .correct_option ? 'border-red font-medium' : 'border-gray-300', !!answer && !!option
                    .correct_option ?
                    'border-green rounded-b-none' : ''
                ]">
                <div
                    :class="['flex items-center justify-center h-2 w-2 flex-shrink-0 rounded-full', parseInt(answer) ===
                        parseInt(
                            option.id) && !option.correct_option ? 'bg-red' : 'bg-gray-300', !!answer && !!option
                        .correct_option ? 'bg-green' : ''
                    ]">
                    <div class="bg-white h-1 w-1 rounded-full"></div>
                </div>
                <p x-text="option.body"
                    :class="['flex text-sm tracking-wider items-center cursor-pointer', answer === option.id && !option
                        .correct_option ? 'text-red' : 'text-gray-600', !!answer && !!option.correct_option ?
                        'text-green' :
                        ''
                    ]">
                </p>
            </div>
            <div x-show="!!answer && !!option.correct_option">
                <div class="h-28 overflow-y-scroll p-2 mt-0 border-l border-green">
                    <p x-text="option.explanation" class="tracking-wider text-xs text-gray-500"></p>
                </div>
            </div>
        </div>
    </template>
</section>
