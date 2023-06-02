<x-dynamic-modal name="timeup-modal" x-cloak>
    <x-slot name="body">
        <h4 class="mb-6 tracking-wider text-lg font-bold">
            This Quiz Has Ended
        </h4>
        <div class="flex flex-col space-y-2">
            <button x-on:click="$modals.show('')"
                class="bg-indigo-500 text-white rounded-lg font-bold text-sm lg:text-base text-center w-full p-2">
                Review Answers
            </button>
            <button x-on:click="() => {
                    $modals.show('');
                    endQuiz = true;
                }"
                class="text-indigo-500 bg-indigo-200/30 rounded-lg font-bold text-sm lg:text-base text-center w-full p-2">
                Finish Quiz
            </button>
        </div>
    </x-slot>
</x-dynamic-modal>
