@section('title', config('app.name') . ' | View Summary - ' . $this->summary->title)

<div x-cloak x-data="{
    readSummary: false,

    related: false,

    showFullImage: false,

    slides: @js(array_merge($this->slides->toArray(), [[]])),

    current_slide: @js($this->current_slide),

    get lastSlide() {
        return this.slides.length - 1;
    },

    colors: ['#ec4899', '#f43f5e', '#a855f7', '#d946ef', '#8b5cf6', '#6366f1', '#0ea5e9', '#06b6d4', '#10b981', '#eab308', '#64748b'],

    next: function() {
        this.current_slide = Math.min(this.current_slide + 1, this.slides.length - 1);
        if ((this.current_slide + 1) < (this.slides.length)) {
            this.randomColors();
        } 
        
        if (this.current_slide === this.lastSlide) {
            this.related = !this.related;
        }
    },

    previous: function() {
        this.current_slide = Math.max(this.current_slide - 1, 0);
        if (this.current_slide !== 0) {
            this.randomColors();
        }
    },

    randomColors: function() {
        for (let i = this.colors.length - 1; i > 0; i--) {
            let j = Math.floor(Math.random() * (i + 1));
            [this.colors[i], this.colors[j]] = [this.colors[j], this.colors[i]];
        }
    }
}" class="inset-0 fixed bg-gray-800/[0.8] backdrop-blur md:flex" x-init="readSummary = (current_slide > 0 ? true : false)"
    x-on:keydown.left="previous" x-on:keydown.right="next">
    {{-- slide --}}
    <div :style="{
        background: `linear-gradient(to bottom, ${colors[0]}, ${colors[1]})`,
    }"
        class="relative flex flex-col w-full h-screen mx-auto shadow lg:w-1/3 md:rounded-t-xl ">
        <div class="flex gap-1 p-2">
            <template x-for="(slide, index) in slides">
                <span :class="(current_slide >= index) ? 'bg-white' : 'bg-white/[0.5]'"
                    class="w-full h-1 rounded"></span>
            </template>
        </div>

        {{-- navigation --}}
        <div class="flex items-center gap-4 p-2 text-white">
            {{-- back to topic --}}
            <a href="{{ route('topic.topic', ['topic' => $this->summary->topic->key]) }}"
                class="z-30 bg-white/[0.1] whitespace-nowrap font-semibold  rounded-lg p-1 text-sm px-3">← Topic</a>
            <div class="flex gap-1 pt-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                </svg>
                <p class="text-xs whitespace-normal">{{ $this->summary->title }}</p>
            </div>
        </div>

        {{-- text --}}
        <template x-if="!slides[current_slide].image">
            <div
                class="flex tracking-wider prose-sm prose prose:drop-shadow-md prose-headings:font-bold lg:prose-base prose-slate prose-blockquote:font-semibold prose-a:font-bold prose-a:text-white prose-a:underline">
                <div class="flex flex-col h-full p-4 my-8 text-white">
                    <div class="pt-8">
                        <div x-show="slides[current_slide].title" x-cloak
                            class="p-2 px-4 text-xl uppercase bg-white rounded drop-shadow text-slate-500"
                            x-text="slides[current_slide].title"></div>
                    </div>
                    <div class="justify-center text-lg font-bold " x-html="slides[current_slide].body"></div>
                </div>
            </div>
        </template>

        {{-- image --}}
        <template x-if="slides[current_slide].image">
            <div class="flex flex-col m-2 rounded-lg mt-8 overflow-clip">
                <div class="p-2 bg-white/[0.2] text-white font-extrabold text-lg rounded">
                    <span x-text="slides[current_slide].title"></span>
                </div>
                <div class="relative h-40 overflow-clip">
                    <div class=" w-full bg-slate-500/[0.4] animate-pulse"></div>
                    <img x-bind:src="'/storage/' + slides[current_slide].image"
                        class="w-full absolute z-30 inset-0 h-auto w-full bg-gray-500" />
                    <div class="absolute z-50 h-40 w-full bg-gray-500/[0.3]  flex justify-center items-center">
                        <button @click="showFullImage = !showFullImage"
                            class="tracking-wider uppercase text-xs border rounded-lg p-2 m-auto drop-shadow bg-white text-slate">View
                            image</button>
                    </div>
                </div>

                {{-- view image modal --}}

                <div x-show="showFullImage"
                    class="fixed z-50 inset-0 bg-gray-600/[0.8] backdrop-blur flex justify-center items-center p-4">
                    <img x-bind:src="'/storage/' + slides[current_slide].image"
                        x-on:click.outside="showFullImage = false" class="w-full lg:w-2/3 h-auto" />
                </div>

                {{-- end view image modal --}}

                <div class="p-2 bg-white text-slate-600 font-semibold text-sm">
                    <span x-html="slides[current_slide].body"></span>
                </div>
            </div>
        </template>

        {{-- controls --}}
        <div class="absolute inset-0 flex">
            <div x-on:click="previous" class="w-1/3 "></div>
            <div x-on:click="next" class="w-2/3 "></div>
        </div>

        {{-- slide start modal --}}
        <div x-cloak x-show="!readSummary" class="z-50 bg-gray-800/[0.8] inset-0 fixed flex p-4 lg:p-12 backdrop-blur">
            <div class="p-4 bg-white lg:w-1/3 m-auto rounded space-y-4">
                <p class="text-lg font-extrabold">Read Summary on: {{ $this->summary->title }}</p>
                <span
                    class="p-1 px-2 text-xs text-indigo-800 bg-indigo-200 rounded">{{ $this->summary->slides->count() }}
                    slides</span>
                {{-- summary slides control tip --}}
                <div class="p-2 text-xs italic bg-indigo-100 border border-indigo-300">
                    <p><strong>Tip:</strong> Press the left side of the screen to go to the previous slide or the right
                        side
                        of the screen to go to the next slide</p>
                </div>
                <div class="flex space-x-4 pt-4 font-bold">
                    <button x-on:click="readSummary = true"
                        class="inline-flex px-4 p-2 tracking-wider text-white uppercase bg-indigo-600 rounded">start
                        reading</button>
                    <a href="{{ route('topic.topic', ['topic' => $this->summary->topic->key]) }}"
                        class="px-4 p-2 tracking-wider text-indigo-600 uppercase bg-white border border-indigo-600 rounded">
                        go back</a>
                </div>
            </div>
        </div>
        {{-- end of slide start modal --}}

        {{-- slide ended modal --}}
        <div x-cloak x-show="related" class="z-50 bg-gray-800/[0.8] inset-0 fixed flex p-4 lg:p-12 backdrop-blur">
            <div class="p-4 bg-white lg:w-1/3 m-auto rounded space-y-4">
                <p class="text-lg font-extrabold">Click on related summaries to continue reading</p>
                <div class="grid gap-4">
                    @foreach ($this->summaries as $summary)
                        <a href="{{ route('summary-slides', ['summary' => $summary->key]) }}"
                            class="group bg-white rounded border shadow-sm hover:shadow-xl p-4 border-t-2 border-t-indigo-600">
                            <div class="tracking-wider grow block">
                                <span class="group-hover:underline inline-block">{!! $summary->title !!}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
