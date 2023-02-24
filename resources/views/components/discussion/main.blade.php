<div x-ref="discussion_topic" class="border border-gray-200 rounded-lg bg-white lg:px-8 p-4 space-y-2">
    {{-- title --}}
    <div class="flex gap-8 justify-between items-start">
        <p class="font-bold text-2xl">
            @if ($this->discussion->is_question)
                <span>[Question] </span>
            @endif
            {{ $this->discussion->title }}
        </p>

        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-6 h-6 flex-shrink-0 mt-2 text-gray-400">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
        </svg>

    </div>
    {{-- body --}}
    <div
        class="pb-4 tracking-wider prose-sm prose-headings:font-bold prose lg:prose-base prose-slate prose-blockquote:font-semibold
        prose-a:text-blue prose-a:font-bold hover:prose-a:text-blue-500 prose-a:underline">
        {!! $this->discussion->body !!}
    </div>

    <div class="grid gap-2 md:grid-cols-2">
        <div class="flex gap-2 flex-wrap">
            @foreach (collect(json_decode($this->discussion->tags)) as $tag)
                <div
                    class="rounded-full text-xs flex justify-center items-center p-1 px-4 font-bold
                    bg-indigo-50 text-indigo-400">
                    <span>{{ $tag }}</span>
                </div>
            @endforeach
        </div>

        <div class="flex flex-1 gap-x-2 md:justify-end items-center">
            <div class="flex space-x-1 items-center">
                <div
                    class="h-8 w-8 rounded-full text-white font-exrabold flex items-center justify-center border bg-gradient-to-b from-indigo-600 to-indigo-300">
                    A </div>
                <p class="text-sm">Anon. User</p>
            </div>
            <p class="text-sm text-gray-400">{{ $this->discussion->created_at->diffForHumans() }}</p>
        </div>
    </div>

    <hr>

    <div class="flex justify-between">
        <div class="flex capitalize text-indigo-500 divide-x p-1">
            <button class="py-2 group pr-4 flex items-center space-x-2 {{$this->userLikesDiscussion() ? 'text-red' : 'text-indigo-500'}}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                </svg>

                <div wire:click="likeDiscussion" class="flex items-center gap-2">
                    <span class="hidden group-hover:underline md:block text-sm capitalize {{$this->userLikesDiscussion() ? 'font-bold' : ''}} ">{{ $this->userLikesDiscussion() ? "Liked" : "Like" }}</span>
                    @if($this->discussion->likes->count() > 0)
                        <span class="block p-1 bg-indigo-200 text-white text-xs capitalize rounded-full px-2">
                            {{ $this->discussion->likes->count() }}
                        </span>
                    @endif
                </div>
            </button>

            <button x-on:click="newComment = !newComment"
                class=" border-gray-300 py-2 hover:underline px-4 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 011.037-.443 48.282 48.282 0 005.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                </svg>

                <span class="hidden md:block text-sm capitalize">new comment</span>
            </button>

            <button class=" border-gray-300 py-2 hover:underline px-4 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
                </svg>
                <span class="hidden md:block text-sm">Share</span>
            </button>
        </div>

        <button class="text-red opacity-0 py-2 pl-4 flex items-center space-x-2 hover:underline">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 3v1.5M3 21v-6m0 0l2.77-.693a9 9 0 016.208.682l.108.054a9 9 0 006.086.71l3.114-.732a48.524 48.524 0 01-.005-10.499l-3.11.732a9 9 0 01-6.085-.711l-.108-.054a9 9 0 00-6.208-.682L3 4.5M3 15V4.5" />
            </svg>
            <span class="text-sm hidden md:block">Report</span>
        </button>
    </div>

    <div x-data="{
        closeForm: async function() {
            this.newComment = false;
            await this.$nextTick();
            this.$refs.discussion_topic.scrollIntoView({
                behavior: 'smooth',
                block: 'end',
            });
        }
    }" x-show="newComment" @comment-added.window="closeForm">
        <x-discussion.new-comment wire:target="addNewreply" wire:submit.prevent="addNewComment" />
    </div>
</div>
