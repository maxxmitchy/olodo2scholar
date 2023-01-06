<section class="relative">
    <x-navigation.header />

    <section class="relative bg-gray-background pb-10 lg:px-24">
        <div class="max-w-screen-xl grid grid-cols-1 lg:gap-10 px-5 pt-20 pb-14 lg:pb-24 lg:pt-28">
            <div>
                <div>
                    <h1 class="tracking-wider text-2xl md:text-4xl font-semibold mt-4 flex items-center">
                        {{ $this->course->title }}
                    </h1>

                    <div class="mt-6 flex items-center flex-wrap md:flex-nowrap">
                        <div class="font-bold flex items-center space-x-2 text-base mr-4 mt-1 md:mt-0">
                            <x-Icons.book class="h-5 w-5" />
                            <p class="tracking-wider">{{ $this->course->topics->count() }} topic(s)</p>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center flex-wrap md:flex-nowrap">
                        <a class="bg-green text-white inline-flex items-center justify-center h-10 px-5 rounded text-base font-semibold
                leading-none tracking-wider transition-all duration-200 whitespace-nowrap disabled:opacity-50 disabled:cursor-default
                mr-4 mt-2"
                            href="#course-topics">
                            <span>Start Learning</span>
                        </a>
                    </div>
                </div>
                <div class="mt-10 md:mt-12">
                    <div class="space-y-12">
                        <div>
                            <h1 class="text-xl lg:text-2xl font-bold">
                                About this course
                            </h1>
                            <div class="prose mt-3 lg:mt-6 text-base lg:text-lg tracking-wider">
                                {!! $this->course->description !!}
                            </div>
                            <div class="mt-12">
                                <h1 class="text-lg font-bold  tracking-wider">Your teacher</h1>
                                <div class="mt-4">
                                    <div>
                                        <div class="font-semibold text-sm leading-none tracking-wider">
                                            {{ $this->course->user->last_name }}, {{ $this->course->user->first_name }}
                                        </div>
                                        <p class="mt-2 text-sm tracking-wider">Hey, I'm the author of this course!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section class="mt-12 lg:mt-0">
                <h4 id="course-topics" class="mb-6 text-xl tracking-wider lg:text-2xl font-bold">Course Topics</h4>

                <section class="lg:grid sm:grid-cols-2 lg:grid-cols-4 grid-cols-1 gap-10">
                    @forelse ($course->topics as $key => $topic)
                        <article class="bg-white item border rounded p-3 space-y-3 mb-8 md:mb-0">
                            <h3 class="tracking-wider text-lg font-bold">
                                {{ $topic->title }}
                            </h3>

                            <a href="{{ route('course.topic', ['course' => $course, 'topic' => $topic]) }}"
                                class="block text-center w-full p-2 text-base font-medium tracking-wider text-white
                    bg-[conic-gradient(at_bottom,_var(--tw-gradient-stops))] from-gray-700 via-gray-900 to-black
                    shadow rounded hover:bg-gray-700 focus:outline-none focus:ring focus:ring-gray-600 active:bg-gray-500 sm:w-auto">
                                Start learning
                            </a>
                        </article>
                    @empty
                        <article class="space-x-3 text-base flex justify-center items-center text-red bg-white p-3 rouned">
                            <x-Icons.caution class="h-7 w-7 flex-shrink-0" />
                            <p class="tracking-wider">Sorry, this course is still in development. Check back later for
                                updates.</p>
                        </article>
                    @endforelse
                </section>
            </section>
    </section>

    <x-footer />
</section>
