<section class="relative" x-data="{
        init() {
            localStorage.clear()
        }
}">
    <x-navigation.header/>

    <section class="relative bg-gray-background pb-10 lg:pt-24 pt-10">
        <article class="grid lg:grid-cols-3 grid-cols-1 border-gray-300 px-5 lg:px-24 lg:border-t">
            <article class="relative">
                <article class="z-10 lg:fixed w-full">
                    <div class="bg-gray-900 lg:h-screen lg:w-[24rem] overflow-hidden lg:mr-24 p-3 lg:mt-0 mt-12 lg:p-12">
                        <div class="rounded text-white bg-purplee p-5">
                            <h6 class="tracking-tight text-xs text-black font-bold">
                                Course
                            </h6>
                            <a href="{{ route('course.course_details', ['course' => $this->course->key]) }}" class="underline tracking-tight text-sm lg:text-base font-semibold">
                                {{ $this->course->title }}, {{ $this->course->code }}, {{ $this->course->level->name }}
                            </a>
                        </div>

                        <div class="mt-4 flex justify-between items-center text-white">
                            <h4 class="tracking-tight font-bold text-sm"></h4>
                            <div class="flex items-center font-bold text-sm tracking-tight">
                                <p class="mr-2 text-xs">{{$this->course->topics->count()}}</p>
                                <h6 class="text-xs">Topics</h6>
                            </div>
                        </div>
                        <div class="space-y-2 mt-5">
                            @foreach ($this->course->topics as $topic)
                                <div
                                    class="{{ $topic->key == $this->coursetopic->key ? 'bg-green' : 'bg-gray-600' }} flex justify-between space-x-3 items-center p-3 rounded">
                                    <p class="tracking-tight text-xs text-white">{{$topic->title}}</p>
                                    <a href="{{ route('course.topic', ['course' => $this->course->key, 'topic' => $topic->key]) }}" class="bg-gray-800 rounded text-white text-xs px-3 py-2 rounde">
                                        Start
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </article>
            </article>

            <article class="lg:z-30 lg:px-5 pt-12 lg:col-span-2" x-data="{open: false}">
                <div class="space-y-4">
                    <h6 class="tracking-tight font-bold text-lg lg:text-xl lg:font-semibold">
                        &rarr; {{ $this->coursetopic->title }}
                    </h6>
                    <div :class="{
                            'line-clamp-20' : open === false,
                            'line-clamp-none' : open === true
                        }" class="prose prose-sm prose-slate prose-blockquote:font-semibold
                            prose-a:text-blue prose-a:font-bold hover:prose-a:text-blue-500 prose-a:underline tracking-tight">
                        {!! $this->coursetopic->overview !!}

                        {!! $this->coursetopic->body !!}
                    </div>

                    <p x-show="open === false" @click="open = !open" class="cursor-pointer text-sm tracking-tight
                        text-green underline">continue reading</p>
                    <p x-show="open === true" @click="open = !open" class="cursor-pointer text-sm tracking-tight
                        text-green underline">read less</p>

                </div>
                <div class="bg-white my-8 p-2 rounded border-l-2 border-purple-600">
                    <p class="tracking-tight mb-4 text-sm">
                        Before you participate in a topic discussion, we recommend taking the quizzes first to ensure a strong foundation of understanding.
                    </p>
                    <a href="{{ route('idea.index', ['topic' => $this->coursetopic->key]) }}"
                    class="text-purplee font-semibold underline tracking-tight text-sm">
                        view discussions
                    </a>
                </div>

                <div class="">
                    <h6 class="tracking-tight text-sm lg:text-base font-semibold">
                        Available quizzes for this topic:
                    </h6>

                    <article class="grid lg:grid-cols-3 grid-cols-1 gap-5 mt-5">
                        @foreach ($this->coursetopic->quizzes as $quiz )
                        <div class="border rounded p-3">
                            <div class="flex flex-col justify-center space-y-2">
                                <h6 class="tracking-tight text-sm font-bold">
                                    {{$quiz->name}}
                                </h6>

                            </div>
                            <a href="{{ route('course.start_quiz', [ 'topic' => $this->topic, 'quiz' => $quiz ] ) }}"
                                class="mt-3 block text-center w-full p-2 text-sm font-medium tracking-tight text-white
                                bg-purplee focus:ring-purplee shadow rounded focus:outline-none focus:ring active:bg-purple-700 sm:w-auto">
                                Start quiz
                            </a>
                        </div>
                        @endforeach
                    </article>
                </div>
            </article>
        </article>
    </section>
</section>
