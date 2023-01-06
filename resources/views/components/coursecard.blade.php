<article class="bg-white item border rounded p-3 space-y-3">
    <div class="-m-2 flex flex-wrap">
        @foreach (['course'] as $i)
            <a href="" class="m-1 px-2 py-1 font-medium tracking-wider text-sm rounded bg-gray-50">
                {{ $i }}
            </a>
        @endforeach
    </div>
    <h3 class="tracking-wider text-lg lg:text-xl font-bold">
        {{ $course->title }}
    </h3>
    <div class="prose tracking-wider line-clamp-3 text-gray-500 text-base lg:text-lg">
        {!! $course->description !!}
    </div>

    <section class="space-y-2 flex flex-col">
        <div class="flex space-x-1 items-center">
            <x-Icons.book class="h-5 w-5 lg:h-6 lg:w-6" />
            <p class="tracking-wider font-bold text-sm sm:text-base">{{ $course->topics->count() }}
                topics</p>
        </div>
    </section>

    <a href="{{ route('course.course_details', ['course' => $course->key]) }}"
        class="block text-center w-full p-2 text-base lg:text-lg tracking-wider text-white bg-purple-600 shadow
            rounded hover:bg-purple-700 focus:outline-none focus:ring focus:ring-purple-600 active:bg-purple-500 sm:w-auto font-bold">
        Start learning
    </a>
</article>
