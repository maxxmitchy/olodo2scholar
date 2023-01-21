<section class="">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Question Banks') }}
        </h2>
    </x-slot>

    <x-Auth.createquestionbank/>

    <div class="max-w-6xl mx-auto space-y-4 rounded bg-white w-full h-full pt-5 mt-5 ">
        <article class="space-y-8">
            <div class="flex justify-between space-x-12 items-center px-5">
                <h5 class="tracking-wider text-base font-bold">
                    Click to view questions in Q-Banks
                </h5>
                <a href="" x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-question-bank')"
                    class="font-bold text-blue underline text-sm">
                    {{ __('Create') }}
                </a>
            </div>

            <section class="flex flex-col">
                @forelse ($questionBanks as $questionbank)
                    <div class="flex border-t border-slate-200">
                        <div class="flex justify-center items-center border-r border-slate-200 p-5">
                            <x-Icons.document class="h-4 w-4"/>
                        </div>
                        <div class="p-4">
                            <a href="{{ route('auth.question_bank_questions', ['question_bank' => $questionbank->key]) }}"
                                class="text-blue underline tracking-wider text-sm">
                                {{$questionbank->title}}
                            </a>
                        </div>
                    </div>
                @empty
                <p class="px-5 mb-5 tracking-wider text-sm text-red">No question banks found</p>
                @endforelse
            </section>
        </article>
    </div>
</section>
