<section class="">

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Question Banks') }}
        </h2>
    </x-slot>

    <x-Auth.createquestionbank/>

    <div class="w-full h-full max-w-6xl pt-5 mx-auto mt-5 space-y-4 bg-white rounded ">
        <article class="space-y-8">
            <div class="flex items-center justify-between px-5 space-x-12">
                <h5 class="text-base font-bold tracking-wider">
                    Your Q-Banks
                </h5>
                <a href="" x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-question-bank')"
                    class="text-sm underline text-blue">
                    {{ __('Create') }}
                </a>
            </div>

            <section class="flex flex-col">
                @forelse ($questionBanks as $questionbank)
                    <div class="flex border-t border-slate-200">
                        <div class="flex items-center justify-center p-5 border-r border-slate-200">
                            <x-Icons.document class="w-5 h-5"/>
                        </div>
                        <div class="p-4">
                            <a href="{{ route('auth.question_bank_questions', ['question_bank' => $questionbank->key]) }}"
                                class="text-sm tracking-wider underline text-blue">
                                {{$questionbank->title}}
                            </a>
                        </div>
                    </div>
                @empty
                <p class="px-5 mb-5 text-sm tracking-wider text-red">No question banks found</p>
                @endforelse
            </section>
        </article>
    </div>
</section>
