<div x-ref="{{ $reply->key }}" class="bg-white p-4 border border-indigo-100 rounded-lg space-y-2">
    <p
        class="tracking-wider prose-sm prose-headings:font-bold prose-headings:text-indigo-600 prose lg:prose-base prose-slate prose-blockquote:font-semibold
                    prose-a:text-blue prose-a:font-bold hover:prose-a:text-blue-500 prose-a:underline">
        {!! $reply->content !!}
    </p>

    <div class="italic flex ml-auto gap-1 items-center justify-between text-sm">
        <div class="flex items-center gap-1 text-gray-400">
            {{--  --}}
            @if ($reply->children->count())
            <span class="">{{ $reply->children->count() }} replies</span>
                •
                <button wire:click="viewReply('{{ $reply->key }}')" class="underline">View
                    replies</button>
            @endif
        </div>

        <div class="flex flex-wrap">
            <p class="text-gray-500">{{ $reply->user->first_name ?? 'Anon' }}</p>

            <span class="text-gray-300 ml-1">{{ \Carbon\Carbon::parse($reply->created_at)->diffForHumans() }}</span>
            </p>
        </div>
    </div>

    <hr>

    <x-discussion.comment-actions :comment="$reply" />

    <div x-cloak x-show="open_reply == @js($reply->key)" x-data="{
        closeForm: async function() {
            this.open_reply = '';
            await this.$nextTick();
            this.$refs[@js($reply->key)].scrollIntoView({
                behavior: 'smooth',
                block: 'end',
            });
        }
    }">
        {{-- add reply --}}
        <x-discussion.new-comment title="Add New Reply" wire:target="addNewComment"
            wire:submit.prevent="addNewComment({{ collect($reply)->only('id', 'key') }})" />
    </div>
</div>
