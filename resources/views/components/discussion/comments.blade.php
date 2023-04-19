<div x-data="{
    open_reply: ''
}"
    @comment-replied.window=" e => {
        open_reply = '';
        $nextTick(() => {
            $refs[e.detail.key].scrollIntoView({
                behavior: 'smooth',
                block: 'end',
            });
        });
    }">
    {{-- comments --}}

    <x-loading-dots wire:target="setPage, previousPage, nextPage" />

    <section wire:loading.remove>
        @forelse ($this->comments as $comment)
            <div class="flex flex-col" wire:key="{{$comment->key}}">
                @if ($loop->iteration !== 1)
                    <div class="mx-4 border-l border-gray-200 h-8"></div>
                @else
                    <div class="h-8"></div>
                @endif
                <div x-ref="{{ $comment->key }}" class="bg-indigo-50 p-4 border border-indigo-100 rounded-lg space-y-2">
                    <x-discussion.quoted-reply :quote="$comment->parent" />

                    <p
                        class="tracking-wider prose-sm prose-headings:font-bold prose-headings:text-indigo-600 prose lg:prose-base prose-slate prose-blockquote:font-semibold
                            prose-a:text-blue prose-a:font-bold hover:prose-a:text-blue-500 prose-a:underline">
                        {!! $comment->content !!}
                    </p>

                    {{-- view replies --}}
                    <div class="flex flex-wrap gap-2 items-center text-gray-500 italic text-sm pt-4">
                        <span class="">{{ $comment->children->count() }} replies</span>
                        @if ($comment->children->count())
                            •
                            <button wire:click="viewReply('{{ $comment->key }}')" class="underline">View
                                replies</button>
                        @endif
                        {{-- author info --}}
                        <div class="flex ml-auto gap-1 items-center">
                            <div
                                class="h-8 w-8 rounded-full text-white font-extrabold flex items-center
                                justify-center border bg-gray-600">
                                A </div>
                            <p>Anon</p>

                            <span
                                class="text-gray-300 ml-1">{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</span>
                            </p>
                        </div>
                    </div>
                    <hr>

                    {{-- comment actions --}}

                    <x-discussion.comment-actions :comment="$comment" />

                    <div x-cloak x-show="open_reply == @js($comment->key)" x-data="{
                        closeForm: async function() {
                            this.open_reply = '';
                            await this.$nextTick();
                            this.$refs[@js($comment->key)].scrollIntoView({
                                behavior: 'smooth',
                                block: 'end',
                            });
                        }
                    }">
                        {{-- add reply --}}
                        <x-discussion.new-comment title="Add New Reply" wire:target="addNewComment"
                            wire:submit.prevent="addNewComment({{ collect($comment)->only('id', 'key') }})" />
                    </div>
                </div>
            </div>
        @empty
            <article
                class="col-span-4 space-x-4 my-4 gap-2 flex flex-col text-center bg-indigo-100 text-indigo-500 border border-indigo-500 p-5 rounded">
                <h4 class="font-bold text-xl">No comments yet</h4>
                <p class="tracking-wider text-sm">
                    Add a new comment to this discussion.
                </p>
            </article>
        @endforelse
    </section>

    <br>

    {{ $this->comments->links() }}
</div>