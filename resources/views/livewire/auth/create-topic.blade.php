<section class="p-5 bg-slate-50">
    <div class="flex flex-wrap items-center mb-3">
        <a href="{{ route('auth.view-course', ['course' => $this->course->key]) }}" class="font-bold underline tracking-wider text-xs">Course</a>/
        <a class="tracking-wider text-xs">{{ $this->course->title }}</a>
    </div>
    <h3 class="mb-8 tracking-wider text-lg font-bold">
        Create New Topic For {{ $this->course->title }}
    </h3>
    <form method="POST" wire:submit.prevent="store">
        @csrf

        <!-- Topic Title -->
        <div class="mt-4">
            <x-input-label for="title" :value="__('Title')" />

            <x-text-input id="title" placeholder="topic title" class="placeholder:text-gray-300 text-sm block mt-1 w-full"
                wire:model.defer="title" type="text" name="title" :value="old('title')"
                autocomplete="title" required />

            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <!-- Topic Overview -->
        <div class="mt-4">
            {{ $this->form }}
        </div>

        <button class="mt-5 bg-purple-500 py-2 text-base font-semibold text-white
            flex rounded justify-center mb-4 w-full hover:bg-purple-700 active:bg-purple-900 focus:outline-none focus:border-purple-900 shadow focus:ring ring-purple-300">
            {{ __('Create Topic') }}
        </button>
    </form>
</section>
