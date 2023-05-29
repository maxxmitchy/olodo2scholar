<div x-cloak x-show="lastSlide">
    <div class="m-2 p-4 m-auto rounded space-y-6">
        <p class="text-lg text-white font-semibold">Click on related summaries to continue reading</p>
        <div class="grid gap-4">
            @foreach ($this->summaries as $summary)
                <a href="{{ route('summary-slides', ['summary' => $summary->key]) }}"
                    class="z-50 group bg-white rounded border shadow-sm hover:shadow-xl p-4 border-t-2 border-t-indigo-600">
                    <div class="tracking-wider grow block">
                        <span class="group-hover:underline font-bold inline-block">{!! $summary->title !!}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
