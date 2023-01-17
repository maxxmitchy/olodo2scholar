<section class="space-y-6">
    <x-modal name="create-question-bank" :show="$errors->isNotEmpty()" focusable>
        <form method="POST" wire:submit.prevent="create" class="p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Create a new Q-bank') }}
            </h2>

            <div class="mt-6">
                <x-input-label for="title" value="Title" class="sr-only" />

                <x-text-input id="title" wire:model="title" name="title" type="text" class="mt-1 block"
                    placeholder="Title" />

                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="description" value="Description" class="sr-only" />

                <x-constrained-textarea rows="5" cols="3" name="description" wire:model="description" />

                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <button
                class="mt-5 block w-full rounded-lg bg-indigo-600 px-12 py-4 text-sm lg:text-base font-semibold text-white shadow hover:bg-indigo-700 focus:outline-none focus:ring active:bg-indigo-500 sm:w-auto">
                Create Q-Bank
            </button>
        </form>
    </x-modal>
</section>
