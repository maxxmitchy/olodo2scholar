@section('title', config('app.name') . ' | View discussion' . $this->discussion->title)

<section class="" x-data>
    <x-navigation.header>
        <div class="flex items-center justify-center text-2xl font-bold text-indigo-600">
            <strong class="text-black">olodo</strong>2Scholar
        </div>
    </x-navigation.header>

    <section class="p-5 lg:w-3/4 mx-auto">
        <form x-ref="form" action="{{ route('topic.topic', ['topic' => $this->discussion->topic->key]) }}">
            <input name="navTab" value="Discussions" hidden>
        </form>

        <button x-on:click="$refs.form.submit()"
            class="mb-5 bg-gray-100 focus:ring-indigo-500 focus:ring-2 text-indigo-500 p-2 px-3 rounded text-xs">
            ← Back to discussions
        </button>

        <div class="grid lg:grid-cols-3 grid-cols-1  gap-8">
            <div class="lg:col-span-2 flex flex-col">
                <div class="border border-gray-200 rounded-lg bg-white lg:px-8 p-4 space-y-2">
                    {{-- title --}}
                    <div class="flex gap-8 justify-between items-start">
                        <p class="font-bold text-2xl">
                            @if ($this->discussion->is_question)
                                <span>[Question] </span>
                            @endif
                            {{ $this->discussion->title }}
                        </p>

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-6 h-6 flex-shrink-0 mt-2 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                        </svg>

                    </div>
                    {{-- body --}}
                    <div
                        class="pb-4 tracking-wider prose-sm prose-headings:font-bold prose lg:prose-base prose-slate prose-blockquote:font-semibold
                        prose-a:text-blue prose-a:font-bold hover:prose-a:text-blue-500 prose-a:underline">
                        {!! $this->discussion->body !!}
                    </div>
                    <div class="grid gap-2 md:grid-cols-2">
                        <div class="flex space-x-2 flex-wrap">
                            <div
                                class="rounded-full text-xs flex justify-center items-center p-1 px-4 font-bold
                                bg-indigo-50 text-indigo-400">
                                <span>tag</span>
                            </div>
                        </div>

                        <div class="flex flex-1 gap-x-2 md:justify-end items-center">
                            <div class="flex space-x-1 items-center">
                                <div class="h-8 w-8 rounded-full text-white font-exrabold flex items-center justify-center border bg-gradient-to-b from-indigo-600 to-indigo-300"> A </div>
                                <p class="text-sm">Anon. User</p>
                            </div>
                            <p class="text-sm text-gray-400">{{ now()->diffForHumans() }}</p>
                        </div>
                    </div>

                    <div class="flex items-center italic text-gray-400 gap-x-1 text-xs pt-2">
                        <span class="">2 likes</span>
                        •
                        <span class="">2 Comments</span>
                    </div>

                    <hr>
                    <div class="flex capitalize text-indigo-500 ">
                        <button class="py-2 pr-4 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                            </svg>

                            <span class="hidden md:block text-sm capitalize">Like</span>
                        </button>

                        <button class="border-l border-gray-300 py-2 px-4 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                            </svg>

                            <span class="hidden md:block text-sm capitalize">new comment</span>
                        </button>

                        <button class="border-l border-gray-300 py-2 px-4 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
                            </svg>
                            <span class="hidden md:block text-sm">Share</span>
                        </button>

                        <button class="text-red ml-auto py-2 pl-4 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0l2.77-.693a9 9 0 016.208.682l.108.054a9 9 0 006.086.71l3.114-.732a48.524 48.524 0 01-.005-10.499l-3.11.732a9 9 0 01-6.085-.711l-.108-.054a9 9 0 00-6.208-.682L3 4.5M3 15V4.5" />
                            </svg>
                            <span class="text-sm hidden md:block">Report</span>
                        </button>

                    </div>
                </div>

                {{-- comments --}}
                @for($i = 0; $i < 4 ; $i++)
                    <div class="flex flex-col">
                        <div class="mx-4 border-l border-gray-200 h-8"></div>
                        <div class="bg-indigo-50 p-4 border border-indigo-100 rounded-lg">
                            <blockquote class="text-gray-500 italic text-sm border-l-2 border-indigo-500 bg-gray-50 mb-4 p-2">
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem aliquam voluptatum nostrum asperiores, animi vero placeat laudantium voluptates expedita consequatur.
                            </blockquote>
                            <p class="text-sm">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Blanditiis nulla consequatur esse harum amet eius sed sapiente deleniti sit expedita ipsa vitae neque, quas quasi aliquid eaque! Dolorem facere aperiam incidunt iusto itaque deleniti accusantium, dolorum quisquam tempora voluptatem reprehenderit perferendis expedita illo adipisci laborum odit temporibus neque, quidem modi.</p>
                        </div>
                    </div>
                @endfor
            </div>
            {{-- related --}}
            <div class="">
                <div class="lg:sticky lg:top-24 border rounded p-4 border-gray-200">
                    <p class="uppercase tracking-wider text-lg font-bold text-indigo-500">related discussions</p>
                </div>
            </div>
        </div>
    </section>
</section>
