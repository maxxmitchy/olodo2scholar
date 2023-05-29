<div x-cloak x-show="!readSummary" class="z-50 bg-gray-800/[0.8] inset-0 fixed flex p-4 lg:p-12 backdrop-blur">
    <div class="p-4 bg-white lg:w-1/3 md:w-2/3 m-auto rounded space-y-4">
        <p class="text-lg font-extrabold">Read Summary on: {{ $this->summary->title }}</p>
        <span class="p-1 px-2 text-xs text-indigo-800 bg-indigo-200 rounded">{{ $this->summary->slides->count() }}
            slides</span>
        {{-- summary slides control tip --}}
        <div class="p-2 text-xs italic bg-indigo-100 border border-indigo-300">
            <p><strong>Tip:</strong> Press the left side of the screen to go to the previous slide or the right
                side
                of the screen to go to the next slide</p>
        </div>
        <div class="flex flex-col gap-3 md:flex-row pt-4 font-bold">
            <button x-on:click="readSummary = true"
                class="flex justify-center inline-flex px-4 p-2 tracking-wider text-white uppercase bg-indigo-600 rounded">start
                reading</button>
            <a href="{{ route('topic.topic', ['topic' => $this->summary->topic->key]) }}"
                class="text-center px-4 p-2 tracking-wider text-indigo-600 uppercase bg-white border border-indigo-600 rounded">
                go back</a>
        </div>
    </div>
</div>
