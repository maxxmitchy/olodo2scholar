<section class="p-5 flex flex-col space-y-4">
    <h2 class="tracking-wider text-xl font-bold mb-4">
        {{ $this->topicquizzes->title }}
    </h2>
    @foreach ($this->topicquizzes->quizzes as $quiz)
        <article class="bg-white rounded">
            <div class="bg-green-500 rounded rounded-b-none h-3/4 p-3 font-bold text-white">
                <a class="tracking-wider text-sm font-bold">
                    <strong class="text-black font-bold underline">Study questions for {{ $quiz->name }} quiz</strong>, {{ $this->topicquizzes->title }}
                </a>
            </div>
            <div class="flex p-3 h-1/4 justify-between items-center">
                <h6 class="text-xs font-bold text-blueqf-600">{{$quiz->questions->count()}} Questions</h6>
                <a href="" class="text-xs font-bold text-gray-600 underline">view</h6>
                <a href="{{route('auth.create-question', ['quiz' => $quiz])}}" class="text-xs font-bold text-gray-600 underline">
                    add questions
                </a>
            </div>
        </article>
    @endforeach
</section>
