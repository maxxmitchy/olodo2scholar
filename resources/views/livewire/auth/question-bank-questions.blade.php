<section class="p-5 mx-auto mt-5 lg:max-w-2xl lg:mt-12">
    <h4 class="mb-5 text-base font-bold tracking-wider">{{ $question_bank->title }}</h4>
    <div class="p-5 space-y-4 bg-white rounded-lg shadow-md">
        <p class="text-sm tracking-wider">
            You can have up to 40 questions per qbank session
        </p>

        <div class="flex items-end text-base font-bold tracking-wider text-gray-600 sm:text-lg">
            <p class="">{{ $question_bank->questions->count() }}</p>
            <p class="">/</p>
            <p class="">40</p>
        </div>

        <div class="flex justify-end">
            <a href="{{route('auth.viewquestions', ['question_bank' => $question_bank->key])}}" class="text-sm tracking-wider underline text-blue">
                view questions
            </a>
        </div>
    </div>

    <br>
    <br>

    <div class="flex flex-col items-center justify-center space-y-4 lg:space-x-4 lg:space-y-0 lg:flex-row lg:justify-end">
        <a href="{{ route('auth.create-question', ['question_bank' => $questionBankKey]) }}"
            class="w-full p-3 text-sm font-medium tracking-wider text-center text-white rounded-lg bg-green">
            Create Questions
        </a>

        @if ($question_bank->questions->count())
            <a href="{{ route('auth.start-questions', ['question_bank' => $question_bank->key]) }}"
                class="w-full p-3 text-sm font-medium tracking-wider text-center text-white bg-indigo-600 rounded-lg">
                Start quiz
            </a>
        @else
            <a class="w-full p-3 text-sm font-medium tracking-wider text-center text-white bg-indigo-600 rounded-lg opacity-25">
                Start qbank session
            </a>
        @endif
    </div>

</section>
