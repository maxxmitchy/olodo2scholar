<section class="relative">
    <x-navigation.header/>

    <section class="relative bg-gray-50 pb-10">
        <div class="max-w-screen-xl grid grid-cols-1 lg:grid-cols-2 lg:gap-10 px-5 pt-24 pb-14 lg:px-24 lg:pb-24 lg:pt-36">
            <div class="flex flex-col space-y-3 lg:px-5">
                <h1 class="text-2xl tracking-wider font-extrabold sm:text-4xl">
                    Don't let studies and exams stress you out - <strong class="text-purple-500">let StudyEazy help you!</strong>
                </h1>
                <p class="mt-4 tracking-wider sm:text-lg">
                    Our quizzes and topic summaries are designed to help you master your study materials and acec your testsand exams.
                </p>
            </div>

            <div class="away">

            </div>
        </div>

        <div class="flex space-x-5 px-5 lg:px-28">
            <p class="tracking-wider text-sm font-semibold py-3 border-b-2 border-purple-500">Featured</p>
            <p class="tracking-wider text-sm font-semibold py-3 border-b-2 border-neutral-100">Recently added</p>
            <p class="tracking-wider text-sm font-semibold py-3 border-b-2 border-neutral-100">Trending</p>
        </div>
    </section>
    <div class="relative">
        <div class="absolute inset-0 grid" aria-hidden="true">
            <div class="bg-gray-50"></div>
            <div class="bg-cyan-800"></div>
        </div>
        <div class="isolate lg:px-24">
            <article class="wrapper px-5">
                @foreach ([1,2] as $i )
                    <article class="bg-white item border rounded p-3 space-y-3">
                        <div class="-m-2 flex flex-wrap">
                            @foreach (['lorem', 'ipsum galor'] as $i)
                                <a href="" class="m-1 px-2 py-1 font-bold tracking-wider text-xs rounded bg-gray-50">
                                    {{ $i }}
                                </a>
                            @endforeach
                        </div>
                        <h3 class="tracking-wider text-base font-bold">
                            Build an E-commerce Platform
                        </h3>
                        <p class="tracking-wider text-gray-500 text-sm">
                            Build an e-commerce platform with laravel and livewire...
                        </p>

                        <section class="space-y-2 flex flex-col">
                            <div class="flex space-x-1 items-center">
                                <x-Icons.book class="h-4 w-4"/>
                                <p class="tracking-wider text-xs">78 topics</p>
                            </div>

                            <div class="flex space-x-1 items-center">
                                <x-Icons.summary class="h-4 w-4"/>
                                <p class="tracking-wider text-xs">7 summaries</p>
                            </div>
                        </section>

                        <a href=""
                            class="block text-center w-full p-2 text-sm font-medium tracking-wider text-white bg-purple-600 shadow
                            rounded hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-500 sm:w-auto">
                            Start learning
                        </a>
                    </article>
                @endforeach
            </article>
        </div>
    </div>
    <section class="py-28 bg-cyan-800 px-5">
        <div class="text-white max-w-xl mx-auto text-center">
            <h1 class="text-3xl font-extrabold sm:text-5xl">
                Choose your topic
            </h1>

            <p class="mt-4 tracking-wider sm:text-xl sm:leading-relaxed">
                Here're courses from every faculty, department and study levels we cover.
            </p>
        </div>
        <section class="bg-white lg:p-10 px-5 py-5 mt-8 mb-10 rounded max-w-xl mx-auto">
            {{ $this->form }}
        </section>

        <section class="lg:px-24 grid lg:grid-cols-4 grid-cols-1 gap-10 py-10">
            @foreach ($this->courses as $course)
                <article class="bg-white item border rounded p-3 space-y-3">
                    <div class="-m-2 flex flex-wrap">
                        @foreach (['lorem', 'ipsum galor'] as $i)
                            <a href="" class="m-1 px-2 py-1 font-bold tracking-wider text-xs rounded bg-gray-50">
                                {{ $i }}
                            </a>
                        @endforeach
                    </div>
                    <h3 class="tracking-wider text-base font-bold">
                        {{ $course->title }}, {{ $course->code }}, {{ $course->level->name }}
                    </h3>
                    <p class="truncate tracking-wider text-gray-500 text-sm">
                        {{ $course->description }}
                    </p>

                    <section class="space-y-2 flex flex-col">
                        <div class="flex space-x-1 items-center">
                            <x-Icons.department class="h-4 w-4"/>
                            <p class="tracking-wider text-xs">{{ $course->department->name }}</p>
                        </div>
                        <div class="flex space-x-1 items-center">
                            <x-Icons.book class="h-4 w-4"/>
                            <p class="tracking-wider text-xs">{{ $course->topics->count() }} topics</p>
                        </div>

                        <div class="flex space-x-1 items-center">
                            <x-Icons.summary class="h-4 w-4"/>
                            <p class="tracking-wider text-xs">7 summaries</p>
                        </div>
                    </section>

                    <a href="{{ route('course.course_details', ['course' => $course->key]) }}" class="block text-center w-full p-2 text-sm font-medium tracking-wider text-white bg-purple-600 shadow
                        rounded hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-500 sm:w-auto">
                        Start learning
                    </a>
                </article>
            @endforeach
        </section>
    </section>

    <section class="border-b py-28 px-5">
        <div class="max-w-xl mx-auto text-center">
            <h1 class="text-3xl font-extrabold sm:text-5xl">
                Get unlimited access with a premium membership
            </h1>

            <p class="mt-4 tracking-wider sm:text-xl sm:leading-relaxed">
                Join hundreds of students improving on their studies everyday
            </p>
        </div>

        <div class="mt-20 grid lg:grid-cols-3 lg:gap-20 gap-10 grid-cols-1 max-w-5xl mx-auto">
            <div class="space-y-3 p-5">
                <div class="flex justify-betweeen">
                    <div class="flex flex-1 flex-col space-y-2">
                        <h4 class="tracking-wider font-bold">
                            Monthly
                        </h4>
                        <p class="tracking-wider text-sm">
                            Access to everything.
                        </p>
                    </div>
                    <h4 class="tracking-wider text-2xl font-semibold">$5/<sub>month</sub></h4>
                </div>

                <hr>

                <div class="flex-1 flex-col space-y-2">
                    <div class="flex space-x-2 items-center">
                        <x-Icons.hamburger class="w-3 h-3"/>
                        <p class="tracking-wider text-sm">Lorem, ipsum galor.</p>
                    </div>
                    <div class="flex space-x-2 items-center">
                        <x-Icons.hamburger class="w-3 h-3"/>
                        <p class="tracking-wider text-sm">Lorem, ipsum galor.</p>
                    </div>
                    <div class="flex space-x-2 items-center">
                        <x-Icons.hamburger class="w-3 h-3 flex-shrink-0"/>
                        <p class="tracking-wider text-sm">Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                    </div>
                </div>

                <a href="" class="block text-center w-full p-2 text-sm font-medium tracking-wider text-white bg-purple-600 shadow
                    rounded hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-500 sm:w-auto">
                    Get Started
                </a>
            </div>

            <div class="rounded space-y-3 p-5 bg-purple-700 text-white">
                <div class="flex justify-betweeen">
                    <div class="flex flex-1 flex-col space-y-2">
                        <h4 class="tracking-wider font-bold">
                            Every Semester
                        </h4>
                        <p class="tracking-wider text-sm">
                            Best value
                        </p>
                    </div>
                    <h4 class="tracking-wider text-2xl font-semibold">$25/<sub>month</sub></h4>
                </div>

                <hr>

                <div class="flex-1 flex-col space-y-2">
                    <div class="flex space-x-2 items-center">
                        <x-Icons.hamburger class="w-3 h-3"/>
                        <p class="tracking-wider text-sm">Lorem, ipsum galor.</p>
                    </div>
                    <div class="flex space-x-2 items-center">
                        <x-Icons.hamburger class="w-3 h-3"/>
                        <p class="tracking-wider text-sm">Lorem, ipsum galor.</p>
                    </div>
                    <div class="flex space-x-2 items-center">
                        <x-Icons.hamburger class="w-3 h-3 flex-shrink-0"/>
                        <p class="tracking-wider text-sm">Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                    </div>
                    <div class="flex space-x-2 items-center">
                        <x-Icons.hamburger class="w-3 h-3 flex-shrink-0"/>
                        <p class="tracking-wider text-sm">Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                    </div>
                    <div class="flex space-x-2 items-center">
                        <x-Icons.hamburger class="w-3 h-3 flex-shrink-0"/>
                        <p class="tracking-wider text-sm">Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                    </div>
                </div>

                <a href="" class="block text-center w-full p-2 text-sm font-medium tracking-wider text-white bg-purple-600 shadow
                    rounded hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-500 sm:w-auto">
                    Get Started
                </a>
            </div>

            <div class="rounded space-y-3 p-5 bg-purple-700 text-white">
                <div class="flex justify-betweeen">
                    <div class="flex flex-1 flex-col space-y-2">
                        <h4 class="tracking-wider font-bold">
                            Full Session
                        </h4>
                        <p class="tracking-wider text-sm">
                            Access to everything.
                        </p>
                    </div>
                    <h4 class="tracking-wider text-2xl font-semibold">$55/<sub>month</sub></h4>
                </div>

                <hr>

                <div class="flex-1 flex-col space-y-2">
                    <div class="flex space-x-2 items-center">
                        <x-Icons.hamburger class="w-3 h-3"/>
                        <p class="tracking-wider text-sm">Lorem, ipsum galor.</p>
                    </div>
                    <div class="flex space-x-2 items-center">
                        <x-Icons.hamburger class="w-3 h-3"/>
                        <p class="tracking-wider text-sm">Lorem, ipsum galor.</p>
                    </div>
                    <div class="flex space-x-2 items-center">
                        <x-Icons.hamburger class="w-3 h-3"/>
                        <p class="tracking-wider text-sm">Lorem, ipsum galor.</p>
                    </div>
                    <div class="flex space-x-2 items-center">
                        <x-Icons.hamburger class="w-3 h-3"/>
                        <p class="tracking-wider text-sm">Lorem, ipsum galor.</p>
                    </div>
                    <div class="flex space-x-2 items-center">
                        <x-Icons.hamburger class="w-3 h-3 flex-shrink-0"/>
                        <p class="tracking-wider text-sm">Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                    </div>
                </div>

                <a href="" class="block text-center w-full p-2 text-sm font-medium tracking-wider text-white bg-purple-600 shadow
                    rounded hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-500 sm:w-auto">
                    Get Started
                </a>
            </div>
        </div>

    </section>

    <section class="py-28 px-5">
        <div class="max-w-xl mx-auto text-center">
            <h1 class="text-3xl font-extrabold sm:text-5xl">
                Trusted by 2,035+ students across Nigerian Universities
            </h1>

            <p class="mt-4 tracking-wider sm:text-xl sm:leading-relaxed">
                Here is what some of our awesome members are saying
            </p>
        </div>

        <div class="mt-20 grid lg:grid-cols-3 lg:gap-20 gap-10 grid-cols-1 max-w-5xl mx-auto">
            @foreach ([1,2,3,4,5] as $i )
                <div class="space-y-3">
                    <div class="p-5 rounded bg-gray-50">
                        <h6 class="tracking-wider font-semibold text-sm">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quidem cum facilis doloribus.
                        </h6>
                    </div>
                    <div class="flex space-x-4 items-center">
                        <div class="p-5 rounded-full shadow"></div>
                        <p class="tracking-wider text-sm">Lorem ipsum dolor sit amet.</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <x-footer/>
</section>
