@section('title', config('app.name') . ' | View Summary - ' . $this->summary->title)

<div
    x-cloak x-data="{
    init() {
            start_slide = @js($this->start_slide);
        },

        readSummary: false,

        modal_type: null,

        toggleBookmark: function(id) {
            this.$wire.toggleBookmark(id).
            then(($data) => {
                this.slides = [...$data.slides, []];
            });
        },

        annotations: false,

        showFullImage: false,

        slides: @js(collect($this->slides)->push([])),

        start_slide: @js($this->start_slide),

        get lastSlide() {
            return this.start_slide === (this.slides.length - 1);
        },

        currentSlideModel: function() {
            return this.slides[this.start_slide];
        },

        colors: [
            '#ec4899',
            '#f43f5e',
            '#a855f7',
            '#d946ef',
            '#8b5cf6',
            '#6366f1',
            '#0ea5e9',
            '#06b6d4',
            '#10b981',
            '#eab308',
            '#64748b'
        ],

        next: function() {
            this.start_slide = Math.min(this.start_slide + 1, this.slides.length - 1);
            if ((this.start_slide + 1) < (this.slides.length)) {
                this.randomColors();
            }
        },

        previous: function() {
            this.start_slide = Math.max(this.start_slide - 1, 0);
            if (this.start_slide !== 0) {
                this.randomColors();
            }
        },

        randomColors: function() {
            for (let i = this.colors.length - 1; i > 0; i--) {
                let j = Math.floor(Math.random() * (i + 1));
                [this.colors[i], this.colors[j]] = [this.colors[j], this.colors[i]];
            }
        },
}" class="inset-0 fixed bg-gray-800/[0.8] backdrop-blur md:flex" x-init="readSummary = (start_slide > 0 ? true : false)"
    {{-- x-on:keydown.left="previous" x-on:keydown.right="next" --}}>

    {{-- slide --}}
    <div :style="{
        background: `linear-gradient(to bottom, ${colors[0]}, ${colors[1]})`,
    }"
        class="relative flex flex-col w-full h-screen mx-auto shadow lg:w-1/3 md:w-2/3 md:rounded-t-xl ">

        <x-summary.slide_steps />

        {{-- navigation --}}
        <x-summary.slide_navigation />

        <div x-show="!lastSlide">
            {{-- text --}}
            <x-summary.slide_is_text />

            {{-- image --}}
            <x-summary.slide_is_image />            
        </div>

        {{-- last slide --}}
        <x-summary.last_slide />

        {{-- controls --}}
        <div class="absolute inset-0 flex justify-between pointer-events-none">
            <div  x-on:click="previous" class="w-1/3 pointer-events-auto"></div>
            {{-- gap between controls --}}
            <div  x-on:click="next" class="w-1/3 pointer-events-auto"></div>
        </div>

        {{-- extras panel --}}
        <x-summary.slide_extras_panel />

        {{-- annotations panel --}}
        <x-summary.annotations/>

        <x-Bookmark.login-modal/>

        {{-- global modal for share  --}}
        <x-dynamic-modal name="share-modal">
            <x-slot name="body">
                <h4 class="mb-6 tracking-wider text-lg font-bold">
                    Share Summary
                </h4>

                <div x-data="{
                    shareUrl: function() {
                        let url = @js(route('summary-slides', ['summary' => $this->summary]));
                        url = (this.start_current) ? url + '?start_slide=' + start_slide : url;
                        return url;
                    },
                
                    start_current: false,
                
                    copyToClipboard: function(event) {
                        navigator.clipboard.writeText(this.shareUrl())
                            .then(() => {
                                event.target.innerText = 'Link copied';
                                event.target.disabled = true;
                
                                setTimeout(() => {
                                    event.target.innerText = 'Copy Link';
                                    event.target.disabled = false;
                                }, 1500);
                            })
                            .catch((error) => {
                                // Error: Failed to copy value to clipboard
                                console.error('Failed to copy value to clipboard:', error);
                            });
                    }
                }" class="flex flex-col gap-4">
                    <input readonly type="text" x-bind:value="shareUrl"
                        class="rounded outline outline-offset-2 outline-indigo-600 bg-indigo-100/30 p-2 rounded-lg">
                    <div x-cloak x-show="start_slide != 0" class="flex gap-2 items-start">
                        <input x-model="start_current" type="checkbox" class="text-indigo-600">
                        <small>Start from current slide</small>
                    </div>
                    <div class="space-y-2">
                        <button x-on:click="copyToClipboard"
                            class="bg-indigo-500 disabled:bg-green text-white rounded-lg font-bold text-sm lg:text-base text-center w-full p-2 inline-block">
                            Copy Link
                        </button>
                        <button x-on:click="$modals.show('')"
                            class="text-indigo-500 bg-indigo-200/30 rounded-lg font-bold text-sm lg:text-base text-center w-full p-2 inline-block">
                            Close
                        </button>
                    </div>
                </div>
            </x-slot>
        </x-dynamic-modal>

        {{-- slide start modal --}}
        <x-summary.slide_modal />
    </div>
</div>
