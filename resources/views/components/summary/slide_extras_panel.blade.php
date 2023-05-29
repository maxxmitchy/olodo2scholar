<div x-data="{
    url: '',

    copyText: function() {
        copyToClipboard(this.url);
        this.showText = !this.showText;
        setTimeout(() => {
            this.showText = !this.showText;
        }, 2000);

    },

    copyToClipboard: function(text) {
        const el = document.createElement('textarea');
        el.value = text;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
    }
}" x-show="!lastSlide"
    class="absolute bg-gray-800/80 backdrop-blur p-4 w-full bottom-0 flex gap-4">
    <button  x-on:click="modal_type = 0" class="rounded-lg bg-white/30 p-2 relative">
        <span
            class="text-xs h-6 w-6 text-white p-2 rounded-full bg-red justify-center items-center flex absolute -right-2 -top-2">10</span>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-6 h-6 text-white">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
        </svg>
    </button>

    <button x-on:click="toggleBookmark(currentSlideModel().id)" wire:target="toggleBookmark"
        x-bind:disabled="(!@js(auth()->check()))"
        wire:loading.class="bg-indigo-200 outline outline-offset-2 outline-indigo-300 rounded"
        wire:loading.class.remove="bg-gray-500"
        x-text="slides[start_slide].bookmarks?.length > 0
                ? 'Remove Bookmark'
                : (@js(auth()->check()) ? 'Add Bookmark' : 'Sign in to add bookmark')"
        x-bind:class="{
            'bg-green text-white': (slides[start_slide].bookmarks?.length == 0),
            'bg-indigo-500 text-indigo-50': (slides[start_slide].bookmarks?.length > 0),
        }"
        class="rounded-lg disabled:bg-gray-500 disabled:text-gray-200 font-semibold text-base text-center w-full p-2 shadow-lg">
    </button>

    <button x-on:click="$modals.show('share-modal')" class="rounded-lg bg-white/30 p-2 relative">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="text-white w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
        </svg>
    </button>
</div>
