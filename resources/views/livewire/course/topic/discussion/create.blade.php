use Filament\Forms\Contracts\HasForms;
@section('title', config('app.name') . ' | Create new discussion' )

<section class="" x-data>
    <x-navigation.header>
        <div class="flex items-center justify-center text-2xl font-bold text-indigo-600">
            <strong class="text-black">olodo</strong>2Scholar
        </div>
    </x-navigation.header>

    <section class="p-5 lg:w-3/4 mx-auto">
        <form x-ref="form" action="{{ route('topic.topic', ['topic' => $this->topic]) }}">
            <input name="navTab" value="Discussions" hidden>
        </form>

        <button x-on:click="$refs.form.submit()"
            class="mb-5 bg-gray-100 focus:ring-indigo-500 focus:ring-2 text-indigo-500 p-2 px-3 rounded text-xs">
            ← Back to topic
        </button>

        <h2 class="text-lg lg:text-3xl mb-5 font-black">
            Create New Discussion
        </h2>
        <div>
            {{ $this->form }}
            <div class="mt-4" x-data="{
                focus_input: false,

                tag: '',

                tags: @entangle('tags').defer,

                addTag: function() {
                    if(this.tag !== ''){
                        this.tags.push(this.tag);
                        this.tag = '';
                    }
                },

                removeTag: function(tag){
                    this.tags.splice(tag, 1);
                },

                toggleFocus: function() {
                    this.focus_input = true;

                    this.$refs.input.focus();

                    this.$nextTick(() => {
                        if (this.focus_input) this.$refs.input.focus();
                    })
                }
            }">
                <label for="tags" class="text-sm font-bold">Tags (<span x-text="tags.length"></span> / 5) </label>

                <div id="tags" x-on:click.outside="focus_input = false" x-on:click="toggleFocus"
                    :class="{
                        'ring-1 ring-indigo-500': focus_input
                    }"
                    class="bg-white rounded-lg mt-1 p-2 border-gray-300 shadow-sm border ">

                    <div class="flex gap-2 flex-wrap">
                        <template x-for="(current_tag, index) in tags">
                            <div class="flex space-x-2 flex-wrap">
                                <div
                                    class="rounded-full text-xs flex justify-center items-center p-1 px-4 font-bold
                                    bg-indigo-100 text-indigo-600">
                                    <span x-text="current_tag"></span>
                                    <span @click="removeTag(index)" class="ml-3 text-indigo-500 text-sm">&times;</span>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div x-cloak class="flex space-x-2 flex-wrap" x-bind:class="{ 'hidden': tags.length !== 0 }">
                        <div
                            class="rounded-full text-xs flex justify-center items-center p-2 px-4 font-bold
                                bg-gray-200 text-gray-600">
                            Add new tags
                        </div>
                    </div>

                    <div
                        @keydown.enter="addTag"
                        x-cloak
                        :class="{
                            'hidden': !focus_input||tags.length > 4,
                            'flex flex-row-reverse lg:flex-col-reverse justify-between': true
                        }">
                        <button x-on:click="addTag" role="button" x-show="tag"
                            class="lg:mr-auto border p-2 rounded-lg text-sm text-gray-500">Add tag +</button>
                        <input  x-ref="input" type="text" x-model="tag"
                            class="flex-1 px-0 bg-transparent w-full border-0 focus:outline-none focus:ring-0">
                    </div>
                </div>
            </div>

            

            <button
                wire:click="saveDiscussion"
                class="mt-10 bg-indigo-500 py-2 text-base font-semibold text-white
                flex rounded-lg justify-center mb-4 w-full lg:w-1/3 hover:bg-indigo-700 active:bg-indigo-900
                focus:outline-none focus:border-indigo-900 shadow focus:ring ring-indigo-300">
                {{ __('Submit') }}
            </button>
        </div>

    </section>
</section>
