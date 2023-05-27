<div wire:ignore x-data="{
    replyId: -1,
    replyKey: null,
    author: '',
    body: '',
    {{-- set reply  --}}
    setReply: function($event) {
        this.replyId = $event.detail.replyId;
        this.author = $event.detail.author;
        this.body = $event.detail.body;
        this.replyKey = $event.detail.replyKey;
    },

    {{-- close form  --}}
    closeForm: function() {
        this.replyId = -1;
        this.author = '';
        this.body = '';
        this.replyKey = null;
        this.$wire.set('content', '');
    },

    {{-- addNewComent --}}
    addComment: function() {
        if (this.replyId == 0) {
            this.$wire.addNewComment();
        } else {
            this.$wire.addNewComment({
                id: this.replyId,
                key: this.replyKey
            });
        }
    }
}" @add-new-comment.window="setReply">
    <template x-if="replyId >= 0">
        <div class="z-50 fixed inset-0 bg-gray-700/40 backdrop-blur flex p-8 lg:p-12">
            <div class="bg-white p-4 rounded-md m-auto lg:w-1/3">
                @if (auth()->check())
                    <form x-on:submit.prevent="addComment">
                        {{-- add comment --}}
                        <div class="">
                            <blockquote class="p-2 mb-4 border-l-2 space-y-2 text-sm font-extrabold"
                                :class="{
                                    'bg-gray-200 border-gray-500 text-gray-700': replyId == 0,
                                    'bg-indigo-100 border-indigo-500 text-indigo-700': replyId > 0,
                                }">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-3 h-3 inline-block">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                                </svg>
                                <p class="inline-block text-xs">
                                    Replying to
                                    <span x-text="`${author}'s`"></span>
                                    <span x-text="(replyId == 0 ? 'topic' : 'comment')"></span>
                                </p>
                                <p class="block italic text-xs font-light h-5 overflow-hidden" x-html="body"></p>
                            </blockquote>

                            {{ $this->form }}

                            <div class="flex space-x-3 mt-4">
                                <button wire:loading.class.remove="bg-indigo-600"
                                    wire:loading.class="bg-indigo-300" type="submit"
                                    class="rounded hover:ring focus:outline-none focus:ring-2 focus:ring-indigo-600
                                        focus:ring-offset-2 px-4 py-2 text-sm bg-indigo-600 text-white">
                                    Send
                                </button>
                                <button type="button" x-on:click="closeForm"
                                    class="rounded px-4 py-2 text-sm text-indigo-600 border border-indigo-600">
                                    Cancel
                                </button>
                            </div>
                        </div>
                        {{-- end add comment --}}
                    </form>
                @else
                    <div
                        class="rounded border border-indigo-700 text-center text-indigo-800 bg-indigo-50 flex flex-col w-full p-4 gap-2">
                        <p class="font-bold text-lg">You are not logged in</p>
                        <p>Please log in or sign up to add a comment to this discussion</p>
                        <div class="block space-x-2 mt-4">
                            <a href="/login" class="inline-flex rounded px-4 p-1 bg-indigo-600 text-white">Login</a>
                            <a href="/register" class="inline-flex rounded px-4 p-1 hover:bg-indigo-100">Sign Up</a>
                        </div>

                        <div class="flex justify-center mt-2">
                            <a x-on:click="closeForm"
                                class="text-gray-500 hover:text-black cursor-pointer tracking-wider text-sm underline">continue
                                reading discussions</a>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </template>
</div>
