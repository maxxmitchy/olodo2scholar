<section class="px-5 pb-12 pt-5">
    <header class="space-y-2">
        <h2 class="tracking-wider text-xl font-bold">
            {{ $this->topic->title }}
        </h2>
        <p class="tracking-wider text-sm font-medium">
            {{ $this->topic->body }}
        </p>
    </header>

    <hr class="mt-4">

    <article class="mt-4 space-y-4">
        <h5 class="tracking-wider text-base font-bold">Topic Overview</h5>

        <div class="text-sm">
            {{ \Illuminate\Mail\Markdown::parse($this->topic->overview) }}
        </div>
    </article>

    <hr class="mt-4">

    <article class="mt-4 space-y-4">
        <h5 class="tracking-wider text-base font-bold">Topic Questions and Summary</h5>

        <div class="grid grid-cols-1 gap-4">
            <article class="bg-white rounded">
                <div class="flex space-x-2 bg-green-500 rounded p-3 font-bold text-white">
                    <div class="flex-shrink-0 h-8 w-8 rounded-full bg-white"></div>
                    <a href="" class="tracking-wider text-sm font-bold">
                        {{ $this->topic->title }} <strong class="text-black font-bold underline">Summaries</strong>
                    </a>
                </div>
            </article>
            <article class="bg-white rounded">
                <div class="bg-green-500 rounded rounded-b-none h-3/4 p-3 font-bold text-white">
                    <a href="{{ route('auth.view-topic-quizzes', ['topic' => $this->topic->key]) }}" class="tracking-wider text-sm font-bold">
                        <strong class="text-black font-bold underline">Study quizzes</strong> for {{ $this->topic->title }}
                    </a>
                </div>
                <div class="flex p-3 h-1/4 justify-between items-center">
                    <h6 class="text-xs font-bold text-blueqf-600">0 Quizes</h6>
                    <a href="" class="text-xs font-bold text-gray-600 underline">view</h6>
                    <a  x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'add-quiz')"
                        class="text-xs font-bold text-gray-600 underline">
                        add quiz
                    </a>

                    <x-modal name="add-quiz" :show="$errors->isNotEmpty()" focusable>
                        <form method="post" wire:submit.prevent="store" class="p-6">
                            @csrf
                            @method('create')

                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Create a new quiz for this topic') }}
                            </h2>

                            <!-- Question Name -->
                            <div class="mt-4">
                                <x-input-label for="name" :value="__('Name')" />

                                <x-text-input id="name" placeholder="enter name of quiz..." class="placeholder:text-gray-300 text-sm block mt-1 w-full"
                                    wire:model.defer="name" type="text" name="title" :value="old('name')"
                                    autocomplete="name" required />

                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="difficulty" :value="__('Difficulty')" />

                                <select id="difficulty" wire:model="difficulty"
                                    class="mt-1 w-full rounded py-2.5 border border-gray-300 bg-white shadow-sm focus:outline-none
                                        focus:border-indigo-300 focus:ring focus:ring-indigo-200
                                    focus:ring-opacity-50 text-sm">
                                    @foreach ($difficulties as $key => $difficulty)
                                    <option class="text-sm" value="{{ $difficulty->id }}">{{ $difficulty->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('difficulty')" class="mt-2" />
                            </div>

                            <div class="mt-6 flex justify-end">
                                <button class="mt-5 bg-purple-500 py-2 text-base font-semibold text-white
                                    flex rounded justify-center mb-4 w-full hover:bg-purple-700 active:bg-purple-900 focus:outline-none focus:border-purple-900 shadow focus:ring ring-purple-300">
                                    {{ __('Create Quiz') }}
                                </button>
                            </div>
                        </form>
                    </x-modal>
                </div>
            </article>
        </div>
    </article>
</section>
