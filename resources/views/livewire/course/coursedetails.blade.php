<section class="relative">
    <x-navigation.header/>

    <section class="relative bg-gray-50 pb-10">
        <div class="max-w-screen-xl grid grid-cols-1 lg:grid-cols-2 lg:gap-20 px-5 pt-20 pb-14 lg:px-24 lg:pb-24 lg:pt-36">
            <div class="mb-8 md:mb-24">
                <div class="rounded-lg p-5 md:px-14 md:py-16 bg-[conic-gradient(at_right,_var(--tw-gradient-stops))] from-gray-600 via-gray-800 to-black text-white overflow-hidden relative">
                    <svg aria-hidden="true" class="absolute w-[250px] md:w-[450px] h-[250px] md:h-[450px] right-[-20px] bottom-[-60px] md:bottom-[-120px]
                    text-blue-4 opacity-20 rotate-12 bg-black rounded-full pointer-events-none"><use href="#icon-icon-code" fill="#333"></use></svg>
                    <h1 class="text-3xl md:text-4xl text-white font-semibold mt-4 flex items-center">
                        {{ $this->course->title }}
                    </h1>

                    <div class="mt-6 flex items-center flex-wrap md:flex-nowrap">
                        <div class="flex items-center space-x-2 text-sm mr-4 mt-1 md:mt-0">
                            <x-Icons.book class="h-4 w-4"/>
                            <p class="away">8 topics</p>
                        </div>
                        <div class="flex items-center space-x-2 text-sm mr-4 mt-1 md:mt-0">
                            <x-Icons.quizicon class="h-4 w-4 flex-shrink-0"/>
                            <p>7 quizzes</p>
                        </div>
                    </div>
                    <div class="mt-8 flex items-center flex-wrap md:flex-nowrap">
                        <a class="inline-flex items-center justify-center bg-blue-1 text-white h-10 px-5 rounded-lg text-sm font-medium
                            leading-none transition-all duration-200 whitespace-nowrap disabled:opacity-50 disabled:cursor-default
                            hover:bg-blue-4 !bg-transparent border-2 border-white-o-20 text-white-o-75 hover:text-light-2 mr-4 mt-2"
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
                            <div class="mt-6 text-sm tracking-wider">
                                <p>
                                    {{ $this->course->description }}
                                </p>
                            </div>
                            <div class="mt-12">
                                <h1 class="text-lg font-bold">Your teacher</h1>
                                <div class="mt-6">
                                    <div class="flex">
                                        <img src=""
                                            alt="image" class="w-14 h-14 rounded-full mr-4" loading="lazy">
                                        <div>
                                            <div class="font-medium leading-none">Name of Author</div>
                                            <p class="mt-2 text-sm">Hey, I'm the author of this course!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h1 class="text-lg font-medium text-dark-blue">Share this course</h1>
                            <div class="flex items-center mt-6">
                                <a href="https://twitter.com/intent/tweet?text=Check%20out%20this%20course%20by%20%40teamcodecourse&amp;url=https://codecourse.com/courses/build-an-ecommerce-platform"
                                    target="_blank" rel="noopener" class="p-2 rounded-full bg-gray-700 text-white group mr-5">
                                    <img src="https://icons8.com/icon/13963/twitter" alt="">
                                    <span class="sr-only">Share on Twitter</span>
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=https://codecourse.com/courses/build-an-ecommerce-platform"
                                    target="_blank" rel="noopener" class="p-2 rounded-full bg-gray-700 text-white group mr-5">
                                    <img src="https://icons8.com/icon/uLWV5A9vXIPu/facebook" alt="">
                                    <span class="sr-only">Share on Facebook</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section>
                <hr class="md:hidden mb-12">
                <h4 id="course-topics" class="md:mb-12 mb-6 text-lg tracking-wider lg:text-2xl font-bold">Course Topics</h4>

                <section class="lg:grid lg:grid-cols-2 grid-cols-1 gap-10">

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
