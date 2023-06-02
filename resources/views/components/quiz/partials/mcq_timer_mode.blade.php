<div :id="'options-' + index" 
    x-on:click="selectAnswer"
    :class="{
        'border-indigo-400 text-indigo': (answer === option.id),
        'border-gray-300': answer !== option.id,
    }"
    class="flex items-center space-x-2 border p-3 rounded-lg">
    
    {{--  --}}
    <input :name="'selected_option' + option.id" :class="'checked:border-indigo-500 ' + (answer === option.id ? 'text-indigo-500' : '')" type="radio"
        :disabled="time_left" :checked="(answer === option.id)">
    {{--  --}}

    <div class="flex flex-col">
        <p x-text="option.body"
            :class="{
                'font-bold text-indigo-500': (answer === option.id),
                '': answer !== option.id,
            }"
            class="flex text-sm tracking-wider items-center cursor-pointer"></p>
    </div>
</div>
