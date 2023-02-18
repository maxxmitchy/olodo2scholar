<template x-for="(option, index) in question.options">
    <div class="mb-4"
        x-data="{
            checked: false,

            explanation: function(){
                return this.option.explanation?.slice(0, 50) + '...';
            },

            long: function(e){
                e.target.hidden = true
                this.explanation = this.option?.explanation;
            },

            selectAnswer: function(){
                this.answer = {question: this.currentQuestion, actualQuestion: this.question.id, option: this.option.id};
                this.checked = true;
                if(option.correct_option){
                    this.score += 1;
                }
                this.scroll();
            },

            scroll: async function(){
                await this.$nextTick();
                setTimeout(() => {
                    document.getElementById(correct_id()+'-correct').scrollIntoView({
                        behaviour: 'smooth',
                        block: 'center',
                    });
                }, 650)
            }
        }">
        <div :id="(option.correct_option && Boolean(answer)) ? (option.id + '-correct') : 'option' "
            x-on:click="selectAnswer"
            :class="{
                'border-rose-400 text-red': (answer === option.id && !option.correct_option),
                'border-gray-300': answer !== option.id,
                'border-green/70 shadow-green/75 shadow-md text-green': (Boolean(answer) === true && option.correct_option)
            }"
            class="flex items-center space-x-2 border p-3 rounded-lg">

            {{--  --}}
            <input :name="'selected_option'+option.id"
                :class="'text-'+(option.correct_option ? 'green' : 'red')"
                type="radio" :disabled="Boolean(answer) == true"
                :checked="(answer === option.id)">
            {{--  --}}

            <div class="flex flex-col">
                <p x-text="option.body"
                    :class="{
                        'font-bold': (option.correct_option && Boolean(answer) === true ),
                        '': answer !== option.id,
                    }"
                    class="flex text-sm tracking-wider items-center cursor-pointer"></p>
                <div x-show="(option.correct_option && Boolean(answer) === true )">
                    <div  class="p-2 mt-0">
                        <span class="text-green flex space-x-2">
                            <p class="text-xs tracking-wider">Correct answer</p>
                            <x-Icons.check class="font-bold h-4 w-4" />
                        </span>
                        <span class="tracking-wider text-xs text-gray-500">
                            <p x-text="explanation"></p>
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
    </div>
</template>
