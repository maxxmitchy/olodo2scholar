<div :id="(option.correct_option && Boolean(answer)) ? (option.id + '-correct') : 'option'"
    x-data="{
        unanswered: function(){
            return (!answers.filter(answer => answer.question ===
            currentQuestion).length && option.correct_option) && answers.filter(answer => answer.question ===
            currentQuestion).length == 0;
        }
    }"
    :class="{
        /**
        Apply a border with a rose color and red text when the answer is equal to the option ID,
        the option is not the correct option, and the current question was answered.
        */
        'border-rose-400 text-red': (answer === option.id && !option.correct_option) 
            && answers.filter(answer => answer.question === currentQuestion).length > 0,
    
        /**
        Apply a border with a gray color when the answer is not equal to the option ID.
        */
        'border-gray-300': (answer !== option.id),
    
        /**
        Apply a light green border with a shadow effect and green text when the answer is truthy,
        the option is the correct option, and the current question was answered.
        */
        'border-green/50 shadow-green/50 shadow text-green': (Boolean(answer) === true && option.correct_option) &&
            answers.filter(answer => answer.question === currentQuestion).length > 0,
    
        /**
        Apply a border with an indigo color, a shadow effect, and indigo text when there are no other answers for the current question,
        the option is the correct option, and the current question was not answered.
        */
        'border-indigo-500 shadow-indigo-500/50 shadow text-indigo-600': (!answers.filter(answer => answer.question ===
            currentQuestion).length && option.correct_option) && answers.filter(answer => answer.question ===
            currentQuestion).length == 0
    }"
    class="flex items-center space-x-2 border p-3 rounded-lg">

    {{--  --}}

    <!-- Set the text color based on the conditions: -->
    <!-- If the option is the correct option and the current question was answered, the text color will be 'green'. -->
    <!-- If the current question was not answered, the text color will be 'indigo-500'. -->
    <!-- Otherwise, the text color will be 'red'. -->

    <!-- Set the 'checked' attribute to true in the following cases: -->
    <!-- If the answer is equal to the option ID. -->
    <!-- If the current question was not answered and the option is the correct option. -->
    <input :name="'selected_option' + option.id"
        :class="'text-' + ((option.correct_option && answers.filter(answer => answer.question ===
            currentQuestion).length) ? 'green' : (answers.filter(answer => answer.question ===
            currentQuestion).length == 0 ? 'indigo-500' : 'red'))"
        type="radio" disabled
        :checked="(answer === option.id) || (answers.filter(answer => answer.question ===
            currentQuestion).length == 0 && option.correct_option)">

    <div class="flex flex-col">
        <p x-text="option.body"
            :class="{
                'font-bold': (option.correct_option && Boolean(answer) === true),
                '': answer !== option.id,
            }"
            class="flex text-sm tracking-wider items-center cursor-pointer"></p>
        <div x-show="(option.correct_option && Boolean(answer) === true) || unanswered">
            <div class="p-2 mt-0">
                <span class="text-green flex space-x-2">
                    <p class="text-xs tracking-wider">Correct answer</p>
                    <x-Icons.check class="font-bold h-4 w-4" />
                </span>
                <span class="tracking-wider text-xs text-gray-500">
                    <p x-cloak x-text="(typeof explanation === 'undefined' ? '' : explanation)"></p>
                    <button x-on:click="long" class="underline text-indigo-500">Read more</button>
                </span>

            </div>
        </div>

        <div x-show="(answer === option.id && !option.correct_option)">
            <div class="px-2 mt-0">
                <span class="text-red flex items-center space-x-2">
                    <p class="text-xs tracking-wider">Incorrect answer</p>
                    <span class="text-xl">&times;</span>
                </span>
            </div>
        </div>
    </div>
</div>
