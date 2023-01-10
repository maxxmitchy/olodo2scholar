<div class="idea-and-buttons container">

    <div class="idea-container bg-white rounded flex mt-4">
        <div class="flex flex-col md:flex-row flex-1 px-4 py-6">
            <div class="flex-none mx-2">
                <a href="#">
                    <img src="{{ $idea->user->getAvatar() }}" alt="avatar" class="w-14 h-14 rounded">
                </a>
            </div>
            <div class="w-full mx-2 md:mx-4">
                <h4 class="tracking-wider text-xl font-semibold mt-2 md:mt-0">
                    {{ $idea->title }}
                </h4>
                <div class="tracking-wider text-gray-600 mt-3">
                    @if (auth()->check() &&
                        auth()->user()->isAdmin())
                        @if ($idea->spam_reports > 0)
                            <div class="text-red mb-2">Spam Reports: {{ $idea->spam_reports }}</div>
                        @endif
                    @endif
                    {!! nl2br(e($idea->description)) !!}
                </div>

                <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                    <div
                        class="tracking-wider flex flex-col lg:flex-row space-y-1 lg:space-y-0 lg:items-center text-xs
                        text-gray-400 font-semibold lg:space-x-2">
                        <div class="md:block font-bold text-gray-900">
                            {{ $idea->user->last_name }}, {{ $idea->user->first_name }}
                        </div>
                        <div>{{ $idea->created_at->diffForHumans() }}</div>
                        <div class="hidden">{{ $idea->category->name }}</div>
                        <div class="text-gray-900">{{ $idea->comments()->count() }} comments</div>
                    </div>
                    <div class="flex items-center space-x-2 mt-4 md:mt-0" x-data="{ isOpen: false }">
                        <div
                            class="{{ 'status-' . Str::kebab($idea->status->name) }} text-xxs font-bold uppercase leading-none rounded text-center w-28 h-7 py-2 px-4">
                            {{ $idea->status->name }}</div>
                        @auth
                            <div class="relative">
                                <button
                                    class="relative bg-gray-100 hover:bg-gray-200 border rounded h-7 transition duration-150 ease-in py-2 px-3"
                                    @click="isOpen = !isOpen">
                                    <svg fill="currentColor" width="24" height="6">
                                        <path
                                            d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z"
                                            style="color: rgba(163, 163, 163, .5)">
                                    </svg>
                                </button>
                                <ul class="absolute w-44 text-left font-semibold bg-white shadow-dialog rounded z-10 py-3 md:ml-8 top-8 md:top-6 right-0 md:left-0"
                                    x-cloak x-show.transition.origin.top.left="isOpen" @click.away="isOpen = false"
                                    @keydown.escape.window="isOpen = false">
                                    @can('update', $idea)
                                        <li>
                                            <a href="#"
                                                @click.prevent="
                                            isOpen = false
                                            $dispatch('custom-show-edit-modal')
                                        "
                                                class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">
                                                Edit Discussion
                                            </a>
                                        </li>
                                    @endcan

                                    @can('delete', $idea)
                                        <li>
                                            <a href="#"
                                                @click.prevent="
                                            isOpen = false
                                            $dispatch('custom-show-delete-modal')
                                        "
                                                class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">
                                                Delete Discussion
                                            </a>
                                        </li>
                                    @endcan

                                    <li>
                                        <a href="#"
                                            @click.prevent="
                                            isOpen = false
                                            $dispatch('custom-show-mark-idea-as-spam-modal')
                                        "
                                            class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">
                                            Mark as Spam
                                        </a>
                                    </li>

                                    @if (auth()->check() &&
                                        auth()->user()->isAdmin())
                                        @if ($idea->spam_reports > 0)
                                            <li>
                                                <a href="#"
                                                    @click.prevent="
                                                isOpen = false
                                                $dispatch('custom-show-mark-idea-as-not-spam-modal')
                                            "
                                                    class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">
                                                    Not Spam
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                </ul>
                            </div>
                        @endauth
                    </div>

                    <div class="flex items-center md:hidden mt-4 md:mt-0">
                        <div class="bg-gray-100 text-center rounded h-10 px-4 py-2 pr-8">
                            <div
                                class="text-sm font-bold leading-none @if ($hasVoted) text-blue @endif">
                                {{ $votesCount }}</div>
                            <div class="text-xxs font-semibold leading-none text-gray-400">Votes</div>
                        </div>
                        @if ($hasVoted)
                            <button wire:click.prevent="vote"
                                class="w-20 bg-indigo-600 text-white border border-indigo-600 font-bold text-xxs uppercase rounded hover:bg-indigo-700 transition duration-150 ease-in px-4 py-3 -mx-5">
                                Voted
                            </button>
                        @else
                            <button wire:click.prevent="vote"
                                class="w-20 bg-gray-200 border border-gray-200 font-bold text-xxs uppercase rounded hover:border-gray-400 transition duration-150 ease-in px-4 py-3 -mx-5">
                                Vote
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end idea-container -->

    <div class="buttons-container flex items-center justify-between mt-6">
        <div class="flex flex-col md:flex-row items-center space-x-4 md:ml-6">
            <livewire:add-comment :idea="$idea" />
            @if (auth()->check() &&
                auth()->user()->isAdmin())
                <livewire:set-status :idea="$idea" />
            @endif

        </div>

        <div class="hidden md:flex items-center space-x-3">
            <div class="bg-white font-semibold text-center rounded px-3 py-2">
                <div class="text-xl leading-snug @if ($hasVoted) text-blue @endif">
                    {{ $votesCount }}</div>
                <div class="text-gray-400 text-xs leading-none">Votes</div>
            </div>
            @if ($hasVoted)
                <button type="button" wire:click.prevent="vote"
                    class="w-32 h-11 text-xs bg-indigo-600 text-white font-semibold uppercase rounded border border-indigo-600 hover:bg-indigo-700 transition duration-150 ease-in px-6 py-3">
                    <span>Voted</span>
                </button>
            @else
                <button type="button" wire:click.prevent="vote"
                    class="w-32 h-11 text-xs bg-gray-200 font-semibold uppercase rounded border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                    <span>Vote</span>
                </button>
            @endif
        </div>
    </div> <!-- end buttons-container -->
</div>
