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


<div class="">
    <br>
    <br>
    <h6 class="tracking-wider text-base lg:text-lg font-bold">
        Flashcards
    </h6>

    <article class="grid lg:grid-cols-3 grid-cols-1 gap-5 mt-5">
        @forelse ($this->coursetopic->flashcards as $flashcard)
            <div class="cursor-pointer group relative block" x-data="{ open: false }">
                <span
                    :class="{
                        '': open === true,
                        'hidden': open === false
                    }"
                    class="absolute inset-0 border-2 border-dashed border-indigo-400 rounded-lg"></span>
                <div
                    class="relative flex h-full transform items-end rounded-lg  border-2 bg-white transition-transform group-hover:-translate-x-2 group-hover:-translate-y-2">
                    <div @click="open = !open"
                        :class="{
                            'absolute opacity-0': open === true,
                            '': open === false
                        }"
                        class="p-5 transition-opacity">
                        <h3 class="text-base font-bold">Question</h3>
                        <p class="mt-4 text-sm tracking-wider">
                            {{ $flashcard->concept }}
                        </p>
                    </div>

                    <div @click="open = !open"
                        :class="{
                            'relative opacity-100': open === true,
                            '': open === false
                        }"
                        class="h-44 overflow-y-scroll absolute p-5 rounded-lg opacity-0 transition-opacity">
                        <h3 class="mt-4 text-base font-bold">Answer To Question</h3>

                        <p class="mt-4 text-sm tracking-wider">
                            {{ $flashcard->definition }}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <article class="space-x-2 flex justify-center items-center text-red bg-white p-3 rouned">
                <x-Icons.caution class="h-7 w-7 flex-shrink-0" />
                <p class="tracking-wider">
                    Sorry, this topic does not have flashcards at the moment.
                </p>
            </article>
        @endforelse
    </article>
</div>
