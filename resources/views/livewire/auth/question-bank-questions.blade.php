<section class="p-5 lg:max-w-2xl mx-auto mt-5 lg:mt-12">
    <h4 class="tracking-wider text-base font-bold mb-5">Session - {{ $question_bank->title }}</h4>
    <div class="space-y-4 rounded bg-white shadow-md p-5">
        <p class="text-sm">
            You can have up to 40 questions per qbank session
        </p>

        <div class="flex items-end text-base sm:text-lg font-bold tracking-wider text-gray-600">
            <p class="">{{ $question_bank->questions->count() }}</p>
            <p class="">/</p>
            <p class="">40</p>
        </div>

        <div class="flex justify-end">
            <a href="{{route('auth.viewquestions', ['question_bank' => $question_bank->key])}}" class="tracking-wider text-blue underline text-sm">
                view questions
            </a>
        </div>
    </div>

    <br>
    <br>

    <div class="flex lg:space-x-4 space-y-4 lg:space-y-0 flex-col lg:flex-row justify-center lg:justify-end items-center">
        <a href="{{ route('auth.create-question', ['question_bank' => $questionBankKey]) }}"
            class="font-medium w-full rounded text-center bg-green text-white text-sm tracking-wider p-3">
            Create Questions
        </a>
        <a href="{{ route('auth.start-questions', ['question_bank' => $question_bank->key]) }}"
            class="font-medium text-center rounded w-full bg-indigo-600 text-white
            text-sm tracking-wider p-3">
            Start quiz
        </a>
    </div>

</section>
