<div class="flex items-center gap-4 p-2 text-white">
    {{-- back to topic --}}
    <a href="{{ route('topic.topic', ['topic' => $this->summary->topic->key]) }}"
        class="z-30 bg-white/[0.1] whitespace-nowrap font-semibold  rounded-lg p-1 text-sm px-3">← Topic</a>
    <div class="flex gap-1 pt-1">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="flex-shrink-0 w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
        </svg>
        <p class="text-xs whitespace-normal">{{ $this->summary->title }}</p>
    </div>
</div>
