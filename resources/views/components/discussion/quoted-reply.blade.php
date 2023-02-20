@props(['quote'])

@if ($quote)
<blockquote class="text-gray-500 italic text-sm border-l-2 border-indigo-500 bg-gray-50 mb-4 p-2">
    {!! $quote->content !!}

    <div class="flex ml-auto gap-2 space-y-1 items-center">
        <div class="flex items-center gap-1">
            <p>{{ $quote->user->first_name ?? "Anon" }}</p>

            <span class="text-gray-300 ml-1">
                {{ \Carbon\Carbon::parse($quote->created_at)->diffForHumans() }}
            </span>
        </div>
        •
        <button class="text-indigo-600 underline" wire:click="viewReply('{{$quote->key}}')">View reply</button>
    </div>
</blockquote>
@endif
