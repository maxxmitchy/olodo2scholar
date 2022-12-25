<section class="relative">
    <x-navigation.header/>

    <section class="relative bg-gray-50 pb-10 lg:pt-24 pt-10">
        <article class="grid lg:grid-cols-3 grid-cols-1 border-gray-300 lg:border-t">
            <article class="lg:border-r border-gray-300 col-span-2 px-3 lg:px-28 py-12">
                <article class="grid lg:grid-cols-2 grid-cols-1 gap-10 mb-12">
                    <article class="flex space-x-3 items-center">
                        <div class="h-12 w-12 rounded-full flex-shrink-0 border"></div>
                        <div class="flex flex-col space-y-1">
                            <h2 class="underline tracking-wider text-base font-bold">Tom Cooper</h2>
                            <p class="tracking-wider text-sm lg:text-base">
                                updated 2022-11-08
                            </p>
                        </div>
                    </article>
                    <article class="flex space-x-4 lg:space-x-8 items-center">
                        <a href="#quizzes" class="cursor-pointer hover:bg-gray-700 p-2 rounded justify-center items-center bg-gray-600 text-white
                            space-x-3 flex">
                            <x-Icons.play class="h-4 w-4"/>
                            <p class="tracking-wider font-semibold text-sm">
                                Quizzes
                            </p>
                        </a>
                        <x-Icons.save class="h-5 w-5"/>
                        <div class="relative">
                            <x-Icons.discussion class="h-5 w-5"/>
                            <p class="text-sm font-semibold absolute -top-2 -right-2">4</p>
                        </div>
                    </article>
                </article>

                <article class="">
                    <h4 class="tracking-wider text-xl font-bold">
                        Course Topic Name
                    </h4>

                    <p class="mt-5 tracking-wider lg:text-base text-sm">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Culpa vitae quas similique vel numquam, molestiae harum delectus, quisquam quis quos iste. Qui dolorum obcaecati natus, eaque doloribus nam quaerat nostrum mollitia perspiciatis incidunt odit ab consequatur laborum quas alias, reprehenderit ullam provident porro repellat ad ea consequuntur unde sint aspernatur.
                    </p>
                </article>

            </article>
            <article class="space-y-8 lg:space-y-6 lg:p-12 p-3">
                <x-accordion :comment="['id' => 1, 'title' => 'Topic Summaries']">
                    <x-slot name="body">
                        Lorem ipsum dolor sit amet.
                    </x-slot>
                </x-accordion>

                <div class="space-y-2">
                    <h2 id="quizzes" class="tracking-wider font-bold text-lg">
                        Topic Quizzes
                    </h2>
                    <p class="tracking-wider text-sm">
                        This is a great way to reinforce your understanding of the topic and identify any areas where you may need to review further. Good luck!
                    </p>
                </div>

                <article class="grid grid-cols-1 gap-5 lg:gap-10">
                    @foreach ($this->topicquizzes->quizzes as $quiz )
                        <div class="bg-gray-200 p-5 rounded space-y-3">
                            <h4 class="tracking-wider text-base font-semibold">
                                {{ $quiz->name }}
                            </h4>

                            <a class="flex items-center justify-center bg-gray-700 text-white h-10 px-5 rounded text-sm font-medium
                                leading-none transition-all duration-200 whitespace-nowrap disabled:opacity-50 disabled:cursor-default
                                hover:bg-gray-800 mt-2"
                                href="{{ route('course.start_quiz', [ 'topic' => $this->topic, 'quiz' => $quiz ] ) }}">
                                <span>Start Quiz</span>
                            </a>
                        </div>
                    @endforeach
                </article>
            </article>
        </article>
    </section>
</section>
