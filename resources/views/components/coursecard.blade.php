<article class="p-4 flex space-y-3 flex-col justify-between bg-white border rounded-lg item">
    <h3 class="text-lg font-bold tracking-wider lg:text-xl">
        {{ $course->title }}
    </h3>

    <a href="{{ route('course.course_details', ['course' => $course->key]) }}"
        class="block w-full px-8 py-2 text-sm font-semibold text-center text-white bg-indigo-600 rounded-lg shadow lg:text-base hover:bg-indigo-700 focus:outline-none focus:ring active:bg-indigo-500 sm:w-auto">
        Start learning
    </a>
</article>
