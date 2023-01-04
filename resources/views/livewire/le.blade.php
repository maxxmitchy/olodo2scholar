<div
    x-data
    @click="
        const clicked = $event.target
        const target = clicked.tagName.toLowerCase()

        const ignores = ['button', 'svg', 'path', 'a']

        if (! ignores.includes(target)) {
            clicked.closest('.idea-container').querySelector('.idea-link').click()
        }
    "
    class="idea-container hover:shadow-card transition duration-150 ease-in bg-white rounded flex cursor-pointer"
>
    <div class="hidden md:block border-r border-gray-100 px-5 py-8">
    <div class="text-center">
        <div class="font-semibold text-2xl @if ($hasVoted) text-blue @endif">{{ $votesCount }}</div>
        <div class="text-gray-500">votes</div>
    </div>

    <div class="mt-8">
        @if ($hasVoted)
        <button wire:click.prevent="revote" class="w-20 bg-purplee text-white border border-purplee hover:bg-purplee-hover font-bold text-xxs uppercase rounded transition duration-150 ease-in px-4 py-3">Revote</button>
        @else
        <button wire:click.prevent="vote" class="w-20 bg-purplee text-white border border-purplee hover:bg-purplee-hover font-bold text-xxs uppercase rounded transition duration-150 ease-in px-4 py-3">Vote</button>
        @endif
    </div>
    </div>

    <div class="flex flex-col md:flex-row flex-1 px-2 py-6">
        <div class="flex-none mx-2 md:mx-0">
            <a href="#">
                <img src="{{ $idea->user->getAvatar() }}" alt="avatar" class="w-14 h-14 rounded">
            </a>
        </div>
        <div class="w-full flex flex-col justify-between mx-2 md:mx-4">
            <h4 class="text-xl font-semibold mt-2 md:mt-0">
                <a href="{{ route('idea.show', ['topic' => session('topic')->key, 'idea' => $idea]) }}" class="idea-link hover:underline">{{ $idea->title }}</a>
            </h4>
            <div class="text-gray-600 mt-3 line-clamp-3">
                @if(auth()->check() && auth()->user()->isAdmin())
                    @if ($idea->spam_reports > 0)
                        <div class="text-red mb-2">Spam Reports: {{ $idea->spam_reports }}</div>
                    @endif
                @endif
                {{ $idea->description }}
            </div>

            <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                <div class="flex flex-col lg:flex-row space-y-1 lg:space-y-0 lg:items-center text-xs
                    text-gray-400 font-semibold lg:space-x-2">
                    <div>{{ $idea->created_at->diffForHumans() }}</div>
                    <div>{{ $idea->category->name }}</div>
                    <!-- <div>&bull;</div> -->
                    <div wire:ignore class="text-gray-900">{{ $idea->comments_count }} comments</div>
                </div>
                <div
                    x-data="{ isOpen: false }"
                    class="flex items-center space-x-2 mt-4 md:mt-0"
                >
                    <div class="status-{{ Str::kebab($idea->status->name) }} p-2 text-xxs font-bold uppercase leading-none">
                        {{ $idea->status->name }}
                    </div>
                </div>

                <div class="flex items-center md:hidden mt-4 md:mt-0">
                    <div class="bg-gray-100 text-center rounded h-10 px-4 py-2 pr-8">
                        <div class="text-sm font-bold leading-none {{ $hasVoted ? 'text-blue' : '' }}">{{ $votesCount }}</div>
                        <div class="text-xxs font-semibold leading-none text-gray-400">votes</div>
                    </div>
                    @if ($hasVoted)
                        <button
                            wire:click.prevent="vote"
                            class="w-20 bg-purple-600 text-white border border-purple-600 font-bold text-xxs uppercase rounded hover:bg-purple-700 transition duration-150 ease-in px-4 py-3 -mx-5"
                        >
                            Voted
                        </button>
                    @else
                        <button
                            wire:click.prevent="vote"
                            class="w-20 bg-gray-200 border border-gray-200 font-bold text-xxs uppercase rounded hover:border-gray-400 transition duration-150 ease-in px-4 py-3 -mx-5"
                        >
                            Vote
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
