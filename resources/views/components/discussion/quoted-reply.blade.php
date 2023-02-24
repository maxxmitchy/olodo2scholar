@props(['quote'])

@if ($quote)
<blockquote class="text-gray-500 italic text-sm border-l-2 border-indigo-700 bg-gray-200 mb-4 p-2">
    <div class="mb-2">
        {!! $quote->content !!}
    </div>

    <div class="flex ml-auto gap-2 space-y-1 items-center">
        <div class="flex items-center gap-1">
            <p class="font-semibold text-gray-600">{{ $quote->user->first_name ?? "Anon" }}</p>

            <span class="text-gray-400 ml-1">
                {{ \Carbon\Carbon::parse($quote->created_at)->diffForHumans() }}
            </span>
        </div>
        •
        <button class="text-indigo-600 underline" wire:click="viewReply('{{$quote->key}}')">View reply</button>
    </div>
</blockquote>
@endif
