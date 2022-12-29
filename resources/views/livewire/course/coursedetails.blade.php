<section class="relative">
    <x-navigation.header/>

    <section class="relative bg-gray-background pb-10 lg:px-24">
        <div class="max-w-screen-xl grid grid-cols-1 lg:gap-10 px-5 pt-20 pb-14 lg:pb-24 lg:pt-28">
            <div class="">
                <div class="">
                    <h1 class="text-xl md:text-2xl font-semibold mt-4 flex items-center">
                        {{ $this->course->title }}
                    </h1>

                    <div class="mt-6 flex items-center flex-wrap md:flex-nowrap">
                        <div class="flex items-center space-x-2 text-sm mr-4 mt-1 md:mt-0">
                            <x-Icons.book class="h-4 w-4"/>
                            <p class="away">{{ $this->course->topics->count() }} topic(s)</p>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center flex-wrap md:flex-nowrap">
                        <a class="bg-green text-white inline-flex items-center justify-center h-10 px-5 rounded text-sm font-semibold
                            leading-none transition-all duration-200 whitespace-nowrap disabled:opacity-50 disabled:cursor-default
                            mr-4 mt-2"
                            href="#course-topics">
                            <span>Start Learning</span>
                        </a>
                    </div>
                </div>
                <div class="mt-8 md:mt-12">
                    <div class="space-y-12">
                        <div>
                            <h1 class="text-lg font-bold">
                                About this course
                            </h1>
                            <div class="mt-3 lg:mt-6 text-sm tracking-wider">
                                <p>
                                    {{ $this->course->description }}
                                </p>
                            </div>
                            <div class="mt-12">
                                <h1 class="text-lg font-bold">Your teacher</h1>
                                <div class="mt-4">
                                    <div>
                                        <div class="font-semibold text-sm leading-none">Name of Author</div>
                                        <p class="mt-2 text-sm">Hey, I'm the author of this course!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section class="mt-12 lg:mt-0">
                <h4 id="course-topics" class="mb-6 text-lg tracking-wider lg:text-lg font-bold">Course Topics</h4>

                <section class="lg:grid sm:grid-cols-2 lg:grid-cols-4 grid-cols-1 gap-10">

                    @forelse ( $course->topics as $key => $topic )
                        <article class="bg-white item border rounded p-3 space-y-3 mb-8 md:mb-0">
                            <h3 class="tracking-wider text-base font-bold">
                                {{$topic->title}}
                            </h3>
                            <p class="tracking-wider text-gray-600 text-sm">
                                {{ $topic->body }}
                            </p>

                            <section class="space-y-2 flex flex-col">
                                <div class="flex space-x-1 items-center">
                                    <x-Icons.hamburger class="h-3 w-3"/>
                                    <p class="tracking-wider text-xs">7 quizzes</p>
                                </div>
                                <div class="flex space-x-1 items-center">
                                    <x-Icons.hamburger class="h-3 w-3"/>
                                    <p class="tracking-wider text-xs">12 summaries</p>
                                </div>
                            </section>

                            <a href="{{ route('course.topic', ['course' => $course, 'topic' => $topic]) }}"
                                class="block text-center w-full p-2 text-sm font-medium tracking-wider text-white
                                bg-[conic-gradient(at_bottom,_var(--tw-gradient-stops))] from-gray-700 via-gray-900 to-black
                                shadow rounded hover:bg-gray-700 focus:outline-none focus:ring active:bg-gray-500 sm:w-auto">
                                Start learning
                            </a>
                        </article>
                    @empty
                    <div class="bg-red-500 rounded p-4">
                        <h3 class="text-white font-bold underline">Error</h3>
                        <p class="text-white text-sm">oops!! Looks like this course is still in develoepment. Please check back later.</p>
                    </div>
                    @endforelse
                </section>
            </section>
        </div>
    </section>

    <x-footer/>
</section>
