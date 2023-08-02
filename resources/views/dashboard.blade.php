@php
    $courses = auth()
        ->user()
        ->takencourses()
        ->orderBy('created_at', 'DESC')
        ->take(2)
        ->get();

        function iget()
        {
            dd(auth()->user()->takencourses);
        }

        dd(auth()->user()->bookmarks()->get())
@endphp

<section>
    @if (
        !is_null(auth()->user()->university_id) &&
            !is_null(auth()->user()->department_id) &&
            !is_null(auth()->user()->level_id))
        <x-app-layout>
            <x-slot name="header">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Dashboard') }}
                </h2>
            </x-slot>

            <div class="">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="overflow-hidden bg-white sm:rounded-lg">
                        <div class="p-5 border-b border-gray-200 bg-slate-100">
                            <div class="grid grid-cols-1 gap-4 mb-10">
                                <div class="w-full h-full pt-3 bg-white rounded">
                                    <div class="space-y-2">
                                        <h5 class="px-5 font-bold tracking-wider">
                                            Recently viewed courses
                                        </h5>
                                        <div class="flex flex-col">
                                            @forelse ($courses as $course)
                                                <div class="flex border-t border-slate-200">
                                                    <div
                                                        class="flex items-center justify-center p-2 border-r border-slate-200">
                                                        <x-Icons.document class="flex-shrink-0 w-5 h-5" />
                                                    </div>
                                                    <div class="p-2">
                                                        <a href="{{ route('course.course_details', ['course' => $course->key]) }}"
                                                            class="text-sm tracking-tight text-gray-600 underline">
                                                            {{ $course->title }}
                                                        </a>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="px-5 pb-3">
                                                    <p class="text-sm tracking-wider text-gray-600">
                                                        You're not taking any course currently. View courses
                                                        <a href="{{ route('landing') }}"
                                                            class="font-semibold underline text-blue">here</a>
                                                    </p>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>

                                <div class="w-full h-full pt-3 mt-3 space-y-4 bg-white rounded">
                                    <article class="space-y-2">
                                        <h5 class="px-5 font-bold tracking-wider">
                                            Recent study quiz
                                        </h5>
                                        <section class="flex flex-col">
                                            @forelse ([] as $quiz)
                                                <div class="flex border-t border-slate-200">
                                                    <div class="p-5 space-y-4">
                                                        <p class="text-sm tracking-tight text-gray-600">
                                                            Nervous System & Special Senses
                                                        </p>

                                                        <button
                                                            class="flex justify-center w-full py-3 text-sm font-semibold text-white bg-indigo-500 rounded-lg shadow hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300">
                                                            {{ __('Start') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            @empty
                                                <p class="p-5 text-sm tracking-wider text-red">
                                                    You do not have any current quiz in session.
                                                </p>
                                            @endforelse
                                        </section>
                                    </article>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-app-layout>
    @endif

    @if (is_null(auth()->user()->university_id) &&
            is_null(auth()->user()->department_id) &&
            is_null(auth()->user()->level_id))
        <x-app-layout>
            <livewire:onboarding.studentprofile />
        </x-app-layout>
    @endif
</section>
