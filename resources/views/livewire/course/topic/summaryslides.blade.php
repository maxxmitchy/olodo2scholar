@section('title', config('app.name') . ' | View Summary -' . $this->summary->title)

<div x-data="{
    slides: [1, 2, 3, 4, 5, 6, 7, 8],

    current_slide: 1,

    colors: ['#ec4899', '#f43f5e', '#a855f7', '#d946ef', '#8b5cf6', '#6366f1', '#0ea5e9', '#06b6d4', '#10b981', '#eab308', '#64748b'],

    previous: function() {
        if (this.current_slide > this.slides[0]) {
            this.current_slide = this.current_slide - 1;
            this.randomColors();
        }
    },

    next: function() {
        if (this.current_slide < this.slides[this.slides.length - 1]) {
            this.current_slide = this.current_slide + 1;
            this.randomColors();
        }
    },

    color1:'', color2: '',

    randomColors: function() {
        for (let i = this.colors.length - 1; i > 0; i--) {
            let j = Math.floor(Math.random() * (i + 1));
            [this.colors[i], this.colors[j]] = [this.colors[j], this.colors[i]];
        }
    }
}" class="inset-0 fixed bg-gray-800/[0.8] backdrop-blur md:flex ">
    {{-- slide --}}
    <div
        :style="{
            background:`linear-gradient(to bottom, ${colors[0]}, ${colors[1]})`,
        }"
        class="lg:w-1/3 w-full h-screen relative  md:rounded-t-xl mx-auto shadow flex flex-col "
        >
        <div class="flex mt-4 p-2 gap-1">
            <template x-for="slide in slides">
                <span :class="(current_slide >= slide) ? 'bg-white' : 'bg-white/[0.5]'"
                    class="rounded  h-1 w-full"></span>
            </template>
        </div>
        {{-- controls --}}
        <div class="absolute inset-0 flex">
            <div x-on:click="previous" class="w-1/3"></div>
            <div x-on:click="next" class="w-2/3"></div>
        </div>
        {{-- navigation --}}
        <div class="flex gap-4 p-2">
            {{-- back to topic --}}
            <a href="{{ route('topic.topic', ['topic' => $this->summary->topic->key]) }}"
                class="z-50 bg-white/[0.1] font-semibold text-white rounded-lg p-1 text-sm px-3">← Topic</a>
        </div>

        {{-- image --}}
        <div class="flex flex-col h-full p-4 mb-8">
            <div class="flex flex-col m-auto w-3/4 bg-white/[0.2]">

            </div>
        </div>
    </div>
</div>
