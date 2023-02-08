<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Current Question') }}
        </h2>
    </x-slot>

    <section>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <p class="tracking-wider mb-12 px-5 lg:px-0">
                    {{ $question->content }}
                </p>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ $this->table }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
