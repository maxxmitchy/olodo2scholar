<section class="relative">
    <x-navigation.header/>

    <section class="relative bg-gray-background pb-10 lg:pt-24 pt-10">
        <article class="grid lg:grid-cols-3 grid-cols-1 border-gray-300 px-5 lg:px-24 lg:border-t">
            <article class="lg:px-5 pt-12 lg:col-span-2">
                <h4 class="mb-5 lg:mb-8 font-bold tracking-wider text-lg lg:text-xl">
                    FDA act of 1946, Nigerian Laws
                </h4>
                <div class="space-y-2">
                    <h6 class="tracking-wider text-sm lg:text-base font-semibold">
                        Introduction:
                    </h6>
                    <p class="tracking-wider text-xs lg:text-sm">
                        This is a description of lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium, saepe doloremque. Exercitationem?
                    </p>
                </div>
                <div class="my-8 p-2 border-l-2 border-purple-600">
                    <p class="tracking-wider mb-2 font-semibold text-xs text-gray-600">
                        Before you participate in a topic discussion, we recommend taking the quizzes first to ensure a strong foundation of understanding.
                    </p>
                    <a href="" class="bg-green tracking-wider text-xs font-bold text-white p-2 rounded">
                        Topic discussion
                    </a>
                </div>

                <div class="">
                    <h6 class="tracking-wider text-sm lg:text-base font-semibold">
                        Available quizzes for this topic:
                    </h6>

                    <article class="grid lg:grid-cols-3 grid-cols-1 gap-5 mt-5">
                        @foreach ($this->topicquizzes->quizzes as $quiz )
                        <div class="border rounded p-3">
                            <div class="flex flex-col justify-center space-y-2">
                                <h6 class="tracking-wider text-sm font-bold">
                                    {{$quiz->name}}
                                </h6>
                                <div class="flex items-center space-x-2">
                                    <div class="h-7 w-7 flex-shrink-0 rounded-full border"></div>
                                    <p class="tracking-wider text-xs">by <strong>Authors Name</strong></p>
                                </div>

                                <p class="tracking-wider text-xs font-semibold">Topic understanding: <strong class="text-green">85%</strong></p>
                                <p class="tracking-wider text-xs font-semibold">Lesson quiz performance: <strong class="text-green">75%</strong></p>
                            </div>
                            <a href="{{ route('course.start_quiz', [ 'topic' => $this->topic, 'quiz' => $quiz ] ) }}"
                                class="mt-3 block text-center w-full p-2 text-sm font-medium tracking-wider text-white
                                bg-green shadow rounded focus:outline-none focus:ring active:bg-green-700 sm:w-auto">
                                Start quiz
                            </a>
                        </div>
                        @endforeach
                    </article>
                </div>
            </article>

            <article class="relative">
                <article class="lg:fixed w-full">
                    <div class="bg-gray-900 rounded-r h-screen lg:w-[24rem] overflow-hidden lg:mr-24 p-3 lg:mt-0 mt-12 lg:p-12">
                        <div class="rounded text-white bg-green p-5">
                            <h6 class="tracking-wider text-xs">
                                Course
                            </h6>
                            <h6 class="tracking-wider text-sm lg:text-base font-semibold">
                                FDA act of 1946, Nigerian Laws
                            </h6>
                        </div>
                        <div class="text-white my-5 flex space-x-2 items-center">
                            <x-Icons.arrow-left class="h-4 w-4 text-white"/>
                            <p class="tracking-wider text-xs uppercase">Back</p>
                        </div>
                        <div class="flex justify-between items-center text-white">
                            <h4 class="tracking-wider uppercase text-sm">Topic Name</h4>
                            <div class="flex items-center uppercase text-sm tracking-wider">
                                <h6 class="mr-2 text-xs">Topics</h6>
                                <p class="text-xs text-green">4</p>
                                <p class="text-xs text-green">/</p>
                                <p class="text-xs text-green">5</p>
                            </div>
                        </div>
                        <div class="space-y-2 mt-5">
                            @foreach ([1,2,3] as $i)
                                <div class="flex justify-between space-x-3 items-center bg-gray-600 p-3 rounded">
                                    <p class="tracking-wider text-xs text-white">Another topic name here</p>
                                    <a href="" class="bg-gray-800 rounded text-white text-xs px-3 py-2 rounde">
                                        Start Topic
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </article>
            </article>
        </article>
    </section>
</section>
