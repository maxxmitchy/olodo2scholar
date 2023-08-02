<div x-show="slides[start_slide].image">
    <div class="flex flex-col m-2 rounded-lg mt-8 overflow-clip">
        <div class="p-2 bg-white/[0.2] text-white font-extrabold text-lg rounded">
            <span x-text="slides[start_slide].title"></span>
        </div>
        <div 
            x-bind:style="{
                backgroundImage: `url('/storage/${slides[start_slide].image}')`
            }"
            class=" h-40 bg-gray-400 flex">
                <button @click="showFullImage = !showFullImage"
                    class="tracking-wider uppercase text-xs border m-auto rounded-lg p-2 m-auto drop-shadow bg-white text-slate ">View
                    image</button>
        </div>

        {{-- view image modal --}}

        <div x-show="showFullImage"
            class="fixed z-20 inset-0 bg-gray-600/[0.8] backdrop-blur flex justify-center items-center p-4">
            <img x-bind:src="'/storage/' + slides[start_slide].image" x-on:click.outside="showFullImage = false"
                class="w-full lg:w-2/3 h-auto" />
        </div>

        {{-- end view image modal --}}

        <div class="p-2 bg-white text-slate-600 font-semibold text-sm">
            <span x-html="slides[start_slide].body"></span>
        </div>
    </div>
</div>
