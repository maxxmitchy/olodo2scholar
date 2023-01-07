<section class="relative">
    <x-navigation.header />

    <section class="relative bg-gray-background pb-10 lg:px-24">
        <div class="max-w-screen-xl grid grid-cols-1 lg:gap-10 px-5 pt-20 pb-14 lg:pb-24 lg:pt-28">
            <div>
                <section>
                    <div class="mx-auto max-w-screen-2xl py-8">
                        <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                            <div class="">
                                <div class="mx-auto max-w-xl text-center">
                                    <h2 class="mb-5 text-2xl font-bold md:text-4xl">
                                        {{ $this->course->title }}
                                    </h2>

                                    <p class="prose sm:mt-4 sm:block">
                                        {!! $this->course->description !!}
                                    </p>

                                    <div class="mt-4 md:mt-8">
                                        <a href="#course-topics"
                                            class="inline-block text-white rounded border border-indigo-500 bg-indigo-600 px-12 py-3 text-sm font-semibold text-blue-500 transition hover:bg-transparent hover:text-white focus:outline-none focus:ring focus:ring-yellow-400">
                                            Started Learning
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1">
                                <img alt="Student"
                                    src="https://images.unsplash.com/photo-1567168544813-cc03465b4fa8?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80"
                                    class="h-40 w-full object-cover sm:h-56 md:h-full" />
                            </div>
                        </div>
                    </div>
                </section>
                <div class="mt-8 md:mt-12">
                    <div>
                        <div class="mt-8">
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
            <section class="mt-12 lg:mt-0">
                <h4 id="course-topics" class="mb-12 text-2xl lg:mb-16 lg:text-3xl tracking-wider font-bold">Topics from this course</h4>

                <section class="lg:grid sm:grid-cols-2 lg:grid-cols-4 grid-cols-1 gap-10">
                    @forelse ($course->topics as $key => $topic)
                        <a href="{{ route('course.topic', ['course' => $course, 'topic' => $topic]) }}"
                            class="mb-8 relative block rounded-sm border-t-4 border-indigo-600 p-5 pb-20 shadow-xl">
                            <h3 class="text-2xl lg:text-4xl font-bold">{{ $topic->title }}</h3>
                            <span class="absolute bottom-8 right-8">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </span>
                        </a>

                    @empty
                        <article
                            class="space-x-3 text-base flex justify-center items-center text-red bg-white p-3 rouned">
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
