@section('title', config('app.name').' | '. $this->course->title )

<section class="relative">
    <x-navigation.header>
        <div class="flex items-center justify-center text-2xl font-bold text-indigo-600">
            <strong class="text-black">olodo</strong>2Scholar
        </div>
    </x-navigation.header>

    <section class="relative bg-gray-background pb-10 lg:px-24">
        <div class="max-w-screen-xl grid grid-cols-1 lg:gap-10 px-5 lg:px-0 pt-20 pb-14 lg:pb-24 lg:pt-28">
            <div>
                <section>
                    <div class="mx-auto max-w-screen-2xl py-8">
                        <div class="grid grid-cols-1 gap-8">
                            <div class="space-y-4">
                                <h1 class="mb-4 tracking-wide font-extrabold text-3xl sm:text-5xl">
                                    {{ $this->course->title }}
                                </h1>
                                <span class="font-semibold text-center uppercase whitespace-nowrap text-white bg-indigo-600 rounded-sm px-2 py-1 text-sm">
                                    {{$this->course->level->name}}
                                </span>
                            </div>
                            <div class="flex flex-col lg:flex-row text-indigo-500 divide-y lg:divide-y-0 lg:divide-x-2 divide-indigo-200 lg:divide-gray-400 gap-4">
                                <div class="items-center flex space-x-2">
                                    <x-Icons.university class="h-5 w-5"/>
                                    <p class="tracking-wider text-sm">
                                        {{$this->course->user->university->name}}
                                    </p>
                                </div>
                                <div class="items-center flex space-x-2 pt-4 lg:pt-0 lg:pl-4">
                                    <x-Icons.faculty class="h-5 w-5"/>
                                    <p class="tracking-wider text-sm">
                                        {{ $this->course->department->faculty->name }}
                                    </p>
                                </div>
                                <div class="items-center flex space-x-2 pt-4 lg:pt-0 lg:pl-4">
                                    <x-Icons.department class="h-5 w-5"/>
                                    <p class="tracking-wider text-sm">
                                        {{ $this->course->department->name }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <section class="mt-6 lg:mt-0">
                <h4 id="course-topics" class="mb-12 text-2xl lg:mb-16 lg:text-3xl tracking-wider font-bold">Topics from
                    this course</h4>

                <section class="lg:grid sm:grid-cols-2 lg:grid-cols-4 grid-cols-1 gap-10">
                    @forelse ($course->topics as $key => $topic)
                        <a href="{{ route('course.topic', ['course' => $course, 'topic' => $topic]) }}"
                            class="mb-8 relative block rounded-sm border-t-4 border-indigo-600 p-5 pb-10 shadow hover:shadow-xl">
                            <h3 class="text-lg lg:text-2xl font-bold">{{ $topic->title }}</h3>
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
