@props(['name'])

<div 
    x-data="{ 
        show: false, 
        name: @js($name),
        disableNavigation: function(event){
            if(this.show){
                event.stopPropagation();
            }
        }
    }"
    class="fixed grid place-items-center inset-0" x-show="show" id="{{ $name }}"
    x-on:modal.window="show=($event.detail === name)"
     @keydown.escape.window="show = false"
     @keydown.left.window="disableNavigation"
     @keydown.right.window="disableNavigation" 
    {{ $attributes }}>
    <div @click="show=false" class="z-30 inset-0 bg-gray-800/60 backdrop-blur fixed"></div>
    <div x-show.transition="show"
        class="bg-white p-6 text-center sm:mt-0 shadow-md mx-5 max-w-xs z-50 sm:text-left rounded-lg">

        <div class=" text-left">
            {{ $body }}
        </div>
    </div>
</div>
