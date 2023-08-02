<article x-cloak class="bg-gray-300/30 mb-5 lg:mb-8 space-y-3 p-4 rounded-lg">
    {{-- Question meta --}}
    <div class="flex justify-between items-center">
        <div class="flex items-center text-sm font-bold tracking-wider text-gray-600 sm:text-base">
            <p class="mr-2">Question</p>
            <p class="text-base" x-text="currentQuestion + 1 "></p>
            <p class="text-sm mx-2">of</p>
            <p class="text-base" x-text="questions.length"></p>
        </div>
        {{-- show timer --}}
        <span x-cloak
            x-show="(quiz_mode === 'Timer') && (time_left >= 0)"
            x-bind:class="{
                'bg-green animate-pulse': time_left > 0,
                'bg-red': time_left == 0
            }"
            class="p-2 rounded text-base font-bold text-white px-3"
            x-text="formatTimer()"></span>
    </div>

    {{-- jump to question --}}
    <button x-on:click="$modals.show('question-list')"
        class="px-3 p-2 bg-indigo-300/30 text-indigo-400 text-xs uppercase focus:outline focus:outline-offset-2
                                            focus:outline-indigo-300 flex gap-2 rounded-lg">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-4 h-4 ">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
        </svg>
        <span>Go to question<span></button>
</article>

{{-- question list --}}
<x-dynamic-modal name="question-list" x-cloak>
    <x-slot name="body">
        <p class="block text-center font-extrabold text-xl pb-4">Questions</p>
        <div class="block h-56 overflow-y-auto">
            <div class="grid grid-cols-4 gap-4  ">
                <template x-for="(question, key) in questions">
                    <button class="w-full aspect-square flex rounded-full justify-center items-center px-3  border"
                        x-on:click="() => {
                                                    currentQuestion = key;
                                                    $modals.show('');
                                                }"
                        x-bind:class="{
                            'bg-indigo-500 text-white': isAnswered(question.id),
                            'bg-gray-300/30': !isAnswered(question.id),
                            'bg-red/30 text-red': !isAnswered(question.id) && time_left == 0
                        }"
                        x-text="key+1"></button>
                </template>
            </div>
        </div>
    </x-slot>
</x-dynamic-modal>
