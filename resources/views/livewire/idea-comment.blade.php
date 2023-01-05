<div id="comment-{{ $comment->id }}"
    class="@if ($comment->is_status_update) is-status-update {{ 'status-' . Str::kebab($comment->status->name) }} @endif comment-container relative bg-white rounded flex transition duration-500 ease-in mt-4">
    <div class="flex flex-col md:flex-row flex-1 px-4 py-6">
        <div class="flex-none">
            <a href="#">
                <img src="{{ $comment->user->getAvatar() }}" alt="avatar" class="w-14 h-14 rounded">
            </a>
            @if ($comment->user->isAdmin())
                <div class="tracking-tight md:text-center uppercase text-blue text-xxs font-bold mt-1">Admin</div>
            @endif
        </div>
        <div class="w-full md:mx-4">
            <div class="text-gray-600">
                @if (auth()->check() &&
                    auth()->user()->isAdmin())
                    @if ($comment->spam_reports > 0)
                        <div class="text-red tracking-tight mb-2">Spam Reports: {{ $comment->spam_reports }}</div>
                    @endif
                @endif

                @if ($comment->is_status_update)
                    <h4 class="text-xl tracking-tight font-semibold mb-3">
                        Status Changed to "{{ $comment->status->name }}"
                    </h4>
                @endif

                <div class="mt-4 md:mt-0">
                    {!! nl2br(e($comment->content)) !!}
                </div>
            </div>

            <div class="flex items-center justify-between mt-6">
                <div
                    class="flex flex-col lg:flex-row space-y-1 lg:space-y-0 lg:items-center text-xs
                    text-gray-400 font-semibold lg:space-x-2">
                    <div
                        class="@if ($comment->is_status_update) txt-blue @endif font-bold tracking-tight text-gray-900">
                        {{ $comment->user->last_name }}, {{ $comment->user->first_name }}
                    </div>
                    {{-- @if ($comment->user->id === $comment->idea->user->id) --}}
                    @if ($comment->user->id === $ideaUserId)
                        <div class="tracking-tight hidden lg:block text-center rounded border bg-gray-100 px-3 py-1">OP
                        </div>
                        <h6 class=" tracking-tight lg:hidden text-xs text-gray-500">
                            Original Poster
                        </h6>
                    @endif
                    <div class="tracking-tight text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</div>
                </div>
                @auth
                    <div class="text-gray-900 flex items-center space-x-2" x-data="{ isOpen: false }">
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
                                @can('update', $comment)
                                    <li>
                                        <a href="#"
                                            @click.prevent="
                                        isOpen = false
                                        Livewire.emit('setEditComment', {{ $comment->id }})
                                    "
                                            class="hover:bg-gray-100 tracking-tight block transition duration-150 ease-in px-5 py-3">
                                            Edit Comment
                                        </a>
                                    </li>
                                @endcan

                                @can('delete', $comment)
                                    <li>
                                        <a href="#"
                                            @click.prevent="
                                        isOpen = false
                                        Livewire.emit('setDeleteComment', {{ $comment->id }})
                                    "
                                            class="hover:bg-gray-100 tracking-tight block transition duration-150 ease-in px-5 py-3">
                                            Delete Comment
                                        </a>
                                    </li>
                                @endcan

                                <li>
                                    <a href="#"
                                        @click.prevent="
                                        isOpen = false
                                        Livewire.emit('setMarkAsSpamComment', {{ $comment->id }})
                                    "
                                        class="hover:bg-gray-100 tracking-tight block transition duration-150 ease-in px-5 py-3">
                                        Mark as Spam
                                    </a>
                                </li>

                                @if (auth()->check() &&
                                    auth()->user()->isAdmin())
                                    @if ($comment->spam_reports > 0)
                                        <li>
                                            <a href="#"
                                                @click.prevent="
                                            isOpen = false
                                            Livewire.emit('setMarkAsNotSpamComment', {{ $comment->id }})
                                        "
                                                class="hover:bg-gray-100 tracking-tight block transition duration-150 ease-in px-5 py-3">
                                                Not Spam
                                            </a>
                                        </li>
                                    @endif
                                @endif
                            </ul>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div> <!-- end comment-container -->