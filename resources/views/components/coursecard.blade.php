<article class="p-4 flex space-y-3 flex-col justify-between bg-white border rounded item">
    <h3 class="text-lg font-semibold tracking-wider lg:text-xl">
        {{ $course->title }}
    </h3>

    <a
        href="{{ route('course.course_details', ['course' => $course->key]) }}"
        class="cursor-pointer block text-center w-full p-4 text-base font-medium tracking-wider text-white bg-indigo-600 shadow
            rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring active:bg-indigo-600 sm:w-auto">
        Start learning
    </a>
</article>