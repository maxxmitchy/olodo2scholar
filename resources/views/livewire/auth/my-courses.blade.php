<section class="p-5 flex flex-col space-y-2">
    @foreach ($courses as $course)
        <a href="{{ route('auth.view-course', ['course' => $course]) }}" class="font-semibold text-sm underline">
            {{ $course->id }}. {{ $course->title }}
        </a>
    @endforeach
</section>
