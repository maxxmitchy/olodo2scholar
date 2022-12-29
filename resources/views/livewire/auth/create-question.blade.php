<section class="p-5 bg-slate-50" x-data="{
    options: @entangle('options').defer,
    answer: @entangle('answer').defer,

    addNewOption: function() {
        if(this.options.length < 4)
        {
            this.options.push('');
            this.$nextTick(() => { this.$refs.option.focus() });
        }
    },

    removeOption(index) {
        this.options.splice(index, 1);
    }
}">
    <h3 class="mb-4 tracking-wider text-base font-bold">
        Create New Question for <strong class="text-purple-500">{{ $this->currentquiz->name }}</strong>
    </h3>

    <form method="POST" wire:submit.prevent="store">
        @csrf
        <!-- Question Content -->
        <div class="mt-4">
            <x-input-label for="content" :value="__('Question Content')" />

            <x-text-input id="content" placeholder="enter question..." class="placeholder:text-gray-300 text-sm block mt-1 w-full"
                wire:model.defer="content" type="text" name="title" :value="old('content')"
                autocomplete="content" required />

            <x-input-error :messages="$errors->get('content')" class="mt-2" />
        </div>

        <!-- Question Explanation -->
        <div class="my-4">
            <x-input-label for="explanation" :value="__('Question Explanation')" />

            <textarea
                class="mt-1 form-control block w-full px-3 py-1.5 placeholder:text-gray-300 text-sm sm:text-base lg:text-lg font-normal
                    bg-white border border-gray-300 transition rounded ease-in-out m-0
                text-gray-700 focus:bg-white focus:outline-none
                focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                "
                id="explanation"
                rows="5"
                placeholder="explain question and answer..."
                wire:model.defer="explanation"
            ></textarea>
            <x-input-error :messages="$errors->get('explanation')" class="mt-2" />
        </div>

        <div class="space-y-3">
            <x-input-label for="option" :value="__('Options')" />

            <template x-for="(option, index) in options">
                <div class="flex space-x-4 w-full mb-3 items-center">
                    <input type="radio" @click="answer = index" name="option" :value="answer"
                        class="border checked:bg-purple-500 focus:ring-purple-500 text-purple-500 w-3 h-3 flex-shrink-0 rounded-full" id="" required>
                    <input x-ref="option" class="text-sm w-3/4 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring
                            focus:ring-indigo-200 focus:ring-opacity-50"
                        type="text" x-model.defer="options[index]" id="option" required
                    >

                    <button class="text-lg font-bold" type="button" @click="removeOption(index)">&times;</button>
                </div>
            </template>
        </div>

        <div class="mt-12 flex space-x-3 justify-center items-center">
            <a @click="addNewOption"
                class="flex-shrink-0 rounded p-2 flex justify-center items-center text-sm border font-medium tracking-wider
                    focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                &plus; option
            </a>

            <button type="submit" class="bg-purple-500 p-2 text-base font-semibold text-white
                flex rounded justify-center w-full hover:bg-purple-700 active:bg-purple-900 focus:outline-none focus:border-purple-900 shadow focus:ring ring-purple-300">
                {{ __('Save Question') }}
            </button>
        </div>
    </form>

    <section class="mt-12">
        <div class="flex space-x-2 items-center">
            <x-icons.hamburger class="text-gray-600 h-3 w-3"/>
            <div class="flex-1 w-full h-0.5 bg-gray-200"></div>
            <h6 class="text-xs font-bold text-gray-600">{{$this->currentquiz->questions->count()}}/40</h6>
        </div>
    </section>
</section>
