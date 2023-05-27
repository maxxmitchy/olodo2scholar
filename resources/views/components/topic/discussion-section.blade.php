<main x-data="{
    showForm: false,
}">
    <section class="p-4 bg-white rounded-md">
        <div class="flex flex-col space-y-3 filters md:flex-row md:space-y-0 md:space-x-6">
            <div class="hidden relative w-full md:w-2/3">
                <label class="text-xs font-medium lg:text-sm" for="sort_by">Search</label>
                <input wire:model="search" type="search" placeholder="search discussions here"
                    class="w-full px-4 py-2 pl-8 text-sm placeholder-gray-900 bg-gray-100 border-none rounded">
                <div class="absolute flex items-center h-full ml-2 top-3">
                    <svg class="w-4 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <div class="w-full md:w-1/3">
                <label class="text-xs font-medium lg:text-sm" for="sort_by">Sort by</label>
                <select wire:model="category" name="category" id="sort_by"
                    class="w-full px-4 py-2 text-sm bg-gray-100 border-none rounded">
                    <option value="None">None</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-full md:w-1/3">
                <label class="text-xs font-medium lg:text-sm" for="post_status">Discussion Status</label>
                <select wire:model="filter" name="other_filters" id="post_status"
                    class="w-full px-4 py-2 text-sm bg-gray-100 border-none rounded">
                    <option value="No Filter">No Filter</option>
                    <option value="Top Voted">Most Comments</option>
                </select>
            </div>
        </div>
    </section>

    <section class="grid grid-cols-1 gap-5 mb-5 mt-7 lg:grid-cols-3">
        @forelse ($this->topic->discussions as $discussion)

            <a href="{{ '/discussion/' . $discussion->key }}"
                class="relative p-4 space-y-4 bg-white border-t-2 border-indigo-600 rounded-sm shadow hover:shadow-xl group">
                {{-- title --}}
                <div class="flex gap-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width=".75"
                        stroke="currentColor" class="w-12 h-12 stroke-indigo-600 flex-shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                    </svg>

                    <div class="flex flex-col">
                        <h3 class="text-base font-bold lg:text-2xl group-hover:underline">
                            {{ $discussion->title }}
                        </h3>

                        {{-- body except --}}
                        <div
                            class="pb-4 tracking-wider prose-sm prose-headings:font-bold prose lg:prose-base prose-slate prose-blockquote:font-semibold
                            prose-a:text-blue prose-a:font-bold hover:prose-a:text-blue-500 prose-a:underline">
                            {!! $discussion->body !!}
                        </div>
                    </div>
                </div>

                {{-- meta --}}
                <div class="flex items-center justify-between text-gray-400">
                    <div class="flex space-x-4">
                        <div class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                            </svg>

                            <span class="text-sm">{{ $discussion->likes->count() }}</span>
                        </div>

                        <div class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                            </svg>

                            <span class="text-sm">{{ $discussion->comments->count() }}</span>
                        </div>
                    </div>
                    <p class="text-sm"> {{ \Carbon\Carbon::parse($discussion->created_at)->diffForHumans() }} </p>
                </div>
            </a>

            @empty
                <article
                    class="col-span-4 space-x-4 flex justify-center items-center bg-indigo-100 text-indigo-500 border border-indigo-500 p-5 rounded">
                    <x-Icons.caution class="h-10 w-10 flex-shrink-0" />
                    <p class="tracking-wider text-sm">
                        Start a new discussion for this topic.
                    </p>
                </article>
            @endforelse
        </section>

        <section class="fixed bottom-0 inset-x-0">
            <div class="flex m-8 justify-end items-center">
                <a href="{{ route('create-discussion', ['topic' => $this->topic->key]) }}"
                    class="rounded-full flex justify-center lg:justify-between p-4 space-x-2 text-white items-center bg-indigo-600 shadow-indigo-400 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 m-auto text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span class="hidden whitespace-nowrap lg:block">New discussion</span>
                </a>
            </div>
        </section>

        <div class="py-4"></div>
    </main>
