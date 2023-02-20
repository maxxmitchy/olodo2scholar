@section('title', config('app.name') . ' | View discussion - ' . $this->discussion->title)

<section class="" x-data="{
    newComment: false,
}" x-cloak>
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
                <x-discussion.main />

                <x-loading-spinner wire:target="viewReply"/>

                <div wire:loading.remove wire:target="viewReply">
                    @if ($this->view_comment === '')
                        <x-discussion.comments />
                    @else
                        <x-discussion.comment-replies />
                    @endif
                </div>
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
