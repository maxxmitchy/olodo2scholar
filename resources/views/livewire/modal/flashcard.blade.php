<div class="flex flex-col rounded-lg shadow-lg" x-data="{ currentCard: 0, questions: [{ question: 'What is the capital of France?', answer: 'Paris', showAnswer: false }, { question: 'What is the capital of Germany?', answer: 'Berlin', showAnswer: false }, { question: 'What is the capital of Italy?', answer: 'Rome', showAnswer: false }] }">
    <div class="relative cursor-pointer transition duration-300 ease-in-out transform" x-data="{ showAnswer: questions[currentCard].showAnswer }"
        @click="questions[currentCard].showAnswer = !questions[currentCard].showAnswer">
        <div class="p-4 bg-white" x-show="!questions[currentCard].showAnswer"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-90"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-end="opacity-0 scale-90">
            <h3 class="text-lg font-bold">Question</h3>
            <p class="text-gray-700 mt-2" x-text="questions[currentCard].question"></p>
        </div>
        <div class="p-4 bg-gray-200" x-show="questions[currentCard].showAnswer"
            x-transition:enter="transition ease-out duration-200" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
            <h3 class="text-lg font-bold">Answer</h3>
            <p class="text-gray-700 mt-2" x-text="questions[currentCard].answer"></p>
        </div>
    </div>
    <div class="p-4 bg-white flex justify-between">
        <button @click="currentCard = currentCard - 1"
            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded"
            x-bind:disabled="currentCard === 0">
            Previous
        </button>
        <button @click="currentCard = currentCard + 1"
            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded"
            x-bind:disabled="currentCard === questions.length - 1">
            Next
        </button>
    </div>
</div>
