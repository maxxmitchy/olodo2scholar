<section class="">

    <x-Auth.createquestionbank/>

    <div class="space-y-4 rounded bg-white w-full h-full pt-5 mt-5 ">
        <article class="space-y-8">
            <div class="flex justify-between items-center px-5">
                <h5 class="tracking-wider text-base font-bold">
                    Q-Banks
                </h5>
                <a href="" x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-question-bank')"
                    class="text-semibold text-gray-700 underline text-sm">
                    {{ __('Create') }}
                </a>
            </div>

            <section class="flex flex-col">
                @forelse ($questionBanks as $questionbank)
                    <div class="flex border-t border-slate-200">
                        <div class="flex justify-center items-center border-r border-slate-200 p-2">
                            <x-icons.document class="h-4 w-4"/>
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