<div x-show="annotations" x-cloak>
    <div x-init="$watch('annotations', (value) => {
        if (value) loadInitialData();
    });" x-data="{
        success: false,
        response: [],
        error: false,
        cursor: 0,
        content: '',
        {{-- load initlal annotations --}}
        loadInitialData: function() {
            this.success = false;
            this.response = [];
            this.error = false;
            this.cursor = 0;
            this.content = '';
            this.$wire.loadAnnotations(currentSlideModel().id, this.cursor)
                .then($data => {
                    this.success = true;
                    this.response = $data.annotations;
                }).catch(() => {
                    this.error = true;
                });
        },
        {{-- reset annotations --}}
        resetAnnotations: function() {
            this.success = false;
            this.response = [];
            this.error = false;
            this.cursor = 0;
            this.content = '';
            this.annotations = false;
        },
        {{-- create annotation --}}
        createAnnotation: function() {
            this.$refs.addBtn.disabled = true;
            this.$refs.textArea.setAttribute('disabled', true);
            this.$wire.createAnnotation(this.currentSlideModel().id, this.content)
                .then($data => {
                    this.$refs.addBtn.disabled = false;
                    this.$refs.textArea.removeAttribute('disabled');
                    this.response.push($data.annotation);
                    document.getElementById('loadMoreBtn').scrollIntoView({
                        behaviour: 'smooth',
                        block: 'end'
                    });
                    this.content = '';
                    this.updateAnnotationsCount();
                }).catch(e => {
    
                });
            
        },
        {{-- toggle vote --}}
        toggleVote: function(event, item, key) {
            event.target.parentNode.disabled = true;
            this.$wire.toggleAnnotationVote(item.id)
                .then(($data) => {
                    this.response[key] = $data.annotation;
                    event.target.parentNode.disabled = false;
                }).catch(e => {
    
                });
        },
        {{-- update annotations counts --}}
        updateAnnotationsCount: function() {
            this.$wire.updateAnnotationCount(this.slides[this.start_slide].id)
                .then($data => {
    
                    this.slides[this.start_slide].annotations_count = $data.slide.annotations_count;
                }).catch(e => {
    
                });
        },
    
        loadMore: function($event) {
            this.cursor += 12;
            $event.target.disabled = true;
            $event.target.innerText = 'Loading...';
            this.$wire.loadAnnotations(this.currentSlideModel().id, this.cursor)
                .then($data => {
                    this.response = [...this.response, ...$data.annotations];
                    {{--  --}}
                    $event.target.disabled = false;
                    $event.target.innerText = 'Load more';
                }).catch((e) => {
    
                });
        }
    }"
        class="fixed inset-0 lg:w-1/3 mx-auto bg-gray-700/50 backdrop-blur flex flex-col justify-end">
        <div x-on:click.away="resetAnnotations" class="flex flex-col bg-gray-800 rounded-t-lg p-6 h-2/3">
            <p class="text-white text-3xl font-extrabold pb-6">Annotations</p>
            {{-- content --}}
            <div x-ref="annotations_list" class="h-full flex flex-col pb-2 flex-grow overflow-y-auto first:border-t-0 ">
                <!-- empty -->
                <template x-if="success && !response.length">
                    <div class="text-gray-200 text-sm traking-wider self-center h-2/3 my-auto">
                        No annotations available at this time
                    </div>
                </template>

                <!-- annotations exists and being loaded -->
                <template x-if="success && response.length">
                    <!-- annotations -->
                    <template x-for="(item, key) in response">
                        <div class="py-4 border-b border-gray-600 flex gap-2">
                            {{-- user initial --}}
                            <div class="rounded-full h-10 bg-indigo-500/60 flex aspect-square">
                                <p x-text="`${item.user.last_name.charAt(0)}${item.user.first_name.charAt(0)}`"
                                    class="text-white text-base font-extrabold m-auto uppercase"></p>
                            </div>

                            {{-- annotation text --}}
                            <div class="space-y-1 flex-grow text-gray-200">
                                <p x-text="item.body" class="tracking-wider font-light text-lg"></p>
                                <p x-text="item.user.last_name+' '+item.user.first_name" class="text-sm font-extrabold">
                                </p>
                            </div>

                            {{--  vote section --}}
                            <div class="block">
                                {{-- vote count --}}
                                <p x-text="item.votes_count"
                                    class="text-center font-bold text-base block text-gray-400"></p>
                                {{-- vote toggle button --}}
                                <button
                                    @if (auth()->check()) x-on:click="(event) => toggleVote(event, item, key)"
                                        x-bind:class="{
                                            'bg-green/40': item.votes.length,
                                            'bg-gray-300/20': !item.votes.length
                                        }"
                                        class="rounded-full h-8 disabled:bg-indigo-500/20 disabled:text-gray-200/80 text-gray-50 p-2 aspect-square"
                                    @else
                                        x-on:click="resetAnnotations; $modals.show('login-modal')"
                                        class="rounded-full h-8 disabled:bg-indigo-500/40 bg-gray-500/10 text-gray-200/30 disabled:text-gray-200/80 p-2 aspect-square" @endif>
                                    {{-- like svg  --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                                    </svg>
                                </button>
                            </div>

                        </div>
                    </template>
                </template>

                <!-- loading -->
                <template x-if="!success && !error">
                    <div class="flex flex-col">
                        <x-summary.annotations_loading_skeleton />
                        <x-summary.annotations_loading_skeleton />
                        <x-summary.annotations_loading_skeleton />
                    </div>
                </template>

                {{-- load more --}}
                <button id="loadMoreBtn" x-on:click="loadMore"
                    x-show="success && (slides[start_slide].annotations_count > 12) && ( slides[start_slide].annotations_count > response.length )"
                    class="block p-3 text-xs font-bold text-indigo-500 
                    bg-indigo-600/10">
                    Load more
                </button>
            </div>

            <!--  -->
            @if (auth()->check())
                <form x-cloak x-show="success" x-on:submit.prevent="createAnnotation" class="flex gap-2 items-center">
                    <textarea x-ref="textArea" maxlength="255" placeholder="start typing..." x-model="content" required
                        class="flex-1 rounded-lg border-gray-200 p-2 text-sm shadow-sm text-sm tracking-wider
                                        placeholder:text-gray-400 inline-block border-gray-200 text-white bg-transparent focus:border-indigo-300 focus:ring focus:ring-indigo-200 
                            focus:ring-opacity-50 rounded-md shadow-sm mt-1"></textarea>
                    <button x-ref="addBtn"
                        class="flex h-full aspect-square text-white disabled:bg-gray-600 focus:bg-indigo-600 rounded-lg font-bold bg-indigo-500 p-2">
                        <svg wire:loading.remove wire:target="createAnnotation" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="m-auto w-8 h-8 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>
                        <svg wire:loading wire:target="createAnnotation"
                            class="w-8 h-8 m-auto animate-spin" viewBox="0 0 91 91" version="1.1"
                            xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <path
                                    d="M0 45.5C0 20.371 20.371 0 45.5 0C59.4019 0 71.8476 6.23466 80.1936 16.0604C86.9337 23.9956 91 34.2729 91 45.5C91 70.629 70.629 91 45.5 91"
                                    id="path_1" />
                                <clipPath id="clip_1">
                                    <use xlink:href="#path_1" />
                                </clipPath>
                            </defs>
                            <g id="Oval">
                                <g clip-path="url(#clip_1)">
                                    <use xlink:href="#path_1" fill="none" stroke="white" stroke-width="8" />
                                </g>
                            </g>
                        </svg>
                    </button>
                </form>
            @else
                <button x-on:click="resetAnnotations(); $modals.show('login-modal')" href="{{ route('login') }}"
                    class="border-2 border-indigo-500 text-indigo-500 rounded-lg font-bold text-sm lg:text-base text-center w-full p-2">
                    Sign in to add annotations
                </button>
            @endif
        </div>
    </div>
</div>
