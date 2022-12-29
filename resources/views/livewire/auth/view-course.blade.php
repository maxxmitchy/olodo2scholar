<section class="p-5">
    <header class="space-y-2">
        <h2 class="tracking-wider text-xl font-bold">
            {{ $this->course->title }}
        </h2>

        {!! $this->course->description !!}

    </header>

    <section class="mt-8">
        <h2 class="mb-3 tracking-wider text-base font-bold">
            Course Topics
        </h2>

        <article class="wrapper">
            @forelse ( $course->topics as $key => $topic )
                <article class="bg-white item rounded">
                    <div class="bg-green-500 rounded rounded-b-none h-3/4 p-3 font-bold text-white">
                        <a href="{{ route('auth.view-course-topic', ['course' => $course, 'topic' => $topic]) }}" class="tracking-wider text-base font-bold underline">
                            {{$topic->title}}
                        </a>
                    </div>
                    <div class="flex p-3 h-1/4 space-x-2 items-center">
                        <x-icons.hamburger class="text-gray-600 h-3 w-3"/>
                        <h6 class="text-xs font-bold text-gray-600">40 Questions</h6>
                    </div>
                </article>
            @empty

            @endforelse
        </article>

        <a href="{{ route('auth.create-topic', ['course' => $this->course->key ]) }}" class="mt-8 tracking-wider text-sm font-bold text-white bg-purple-500 rounded p-2 flex justify-center items-center">
            Add topic
        </a>
    </section>
</section>
