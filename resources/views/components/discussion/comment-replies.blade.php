<div x-data="{
    open_reply: '',
}"
    @comment-replied.window=" e => {
        open_reply = '';
        $nextTick(() => {
            $refs[e.detail.key].scrollIntoView({
                behavior: 'smooth',
                block: 'end',
            });
        });
    }"
>
    <div class="flex gap-2 my-2 p-2 items-center">
        <hr class="w-full grow">
        <button wire:click="viewReply('')" class="font-semibold tracking-wider whitespace-nowrap text-indigo-600 ">Back to
            all replies</button>
        <hr class="w-full grow">
    </div>
    {{-- comments --}}
    <div class="flex flex-col">
        {{--  --}}
        <div x-ref="{{ $this->comment_replies->key }}"
            class="bg-indigo-50 p-4 border border-indigo-100 rounded-lg space-y-2">
            <x-discussion.quoted-reply :quote="$this->comment_replies->parent" />

            <p
                class="tracking-wider prose-sm prose-headings:font-bold prose-headings:text-indigo-600 prose lg:prose-base prose-slate prose-blockquote:font-semibold
                    prose-a:text-blue prose-a:font-bold hover:prose-a:text-blue-500 prose-a:underline">
                {!! $this->comment_replies->content !!}
            </p>

            {{-- view replies --}}
            <div class="flex flex-wrap gap-2 items-center text-gray-500 italic text-sm pt-4">
                <span class="">{{ $this->comment_replies->children->count() }} replies</span>
                {{-- author info --}}
                <div class="flex ml-auto gap-1 items-center">
                    <p>{{ $this->comment_replies->user->last_name }}, {{ $this->comment_replies->user->first_name }}</p>

                    <span
                        class="text-gray-300 ml-1">{{ \Carbon\Carbon::parse($this->comment_replies->created_at)->diffForHumans() }}</span>
                    </p>
                </div>
            </div>

            <hr>

            {{-- comment actions --}}
            <x-discussion.comment-actions :comment="$this->comment_replies" />

            <div x-cloak 
                x-show="open_reply == @js($this->comment_replies->key)" 
                x-data="{
                    closeForm: async function() {
                        this.open_reply = '';
                        await this.$nextTick();
                        this.$refs[@js($this->comment_replies->key)].scrollIntoView({
                            behavior: 'smooth',
                            block: 'end',
                        });
                    }
                }">
                {{-- add reply --}}
                <x-discussion.new-comment wire:key="$this->comment_replies->key" title="Add New Reply" wire:target="addNewComment"
                    wire:submit.prevent="addNewComment({{ collect($this->comment_replies)->only('id', 'key') }})" />
            </div>
        </div>

        <x-loading-dots wire:target="setPage, previousPage, nextPage" />

        <div wire:loading.remove>
            <div class="flex-col pl-4">
                @foreach ($this->comment_replies_children as $reply)
                    <div class="h-4 border-l ml-4"></div>
                    <x-discussion.reply-card :reply="$reply" />
                @endforeach
            </div>
        </div>
    </div>
    <br>
    {{ $this->comment_replies_children->links() }}
    <br>
</div>