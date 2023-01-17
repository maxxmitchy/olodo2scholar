@php
    $courses = auth()
        ->user()
        ->takencourses()
        ->orderBy('created_at', 'DESC')
        ->take(2)
        ->get();
@endphp

<section>
    @if(!is_null(auth()->user()->university_id) && !is_null(auth()->user()->department_id)
        && !is_null(auth()->user()->level_id))
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </x-slot>

            <div class="border-y">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-5 bg-slate-100 border-b border-gray-200">
                            <div class="grid grid-cols-1 gap-4 mb-10">
                                <div class="rounded bg-white w-full h-full pt-3">
                                    <div class="space-y-2">
                                        <h5 class="px-5 tracking-tight text-sm font-bold">
                                            Recently viewed courses
                                        </h5>
                                        <div class="flex flex-col">
                                            @forelse ($courses as $course)
                                                <div class="flex border-t border-slate-200">
                                                    <div class="flex justify-center items-center border-r border-slate-200 p-2">
                                                        <x-Icons.document class="h-5 w-5 flex-shrink-0" />
                                                    </div>
                                                    <div class="p-2">
                                                        <a href="{{ route('course.course_details', ['course' => $course->key]) }}"
                                                            class="underline tracking-tight text-sm text-gray-600">
                                                            {{ $course->title }}
                                                        </a>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="px-5 pb-3">
                                                    <p class="tracking-tight text-sm text-gray-600">
                                                        You're not taking any course currently. View courses
                                                        <a href="{{ route('dashboard') }}"
                                                            class="underline text-blue font-semibold">here</a>
                                                    </p>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-4 rounded bg-white w-full h-full pt-3 mt-3">
                                    <article class="space-y-2">
                                        <h5 class="px-5 tracking-tight text-sm font-bold">
                                            Recent study quiz
                                        </h5>
                                        <section class="flex flex-col">
                                            <div class="flex border-t border-slate-200">
                                                <div class="p-5 space-y-4">
                                                    <p class="tracking-tight text-sm text-gray-600">
                                                        Nervous System & Special Senses
                                                    </p>

                                                    <button
                                                        class="bg-indigo-500 font-semibold py-3 text-sm text-white
                                                        flex rounded-lg justify-center w-full hover:bg-indigo-700 active:bg-indigo-900
                                                        focus:outline-none focus:border-indigo-900 shadow focus:ring ring-indigo-300">
                                                        {{ __('Start') }}
                                                    </button>
                                                </div>
                                            </div>
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

    @if (is_null(auth()->user()->university_id) && is_null(auth()->user()->department_id)
        && is_null(auth()->user()->level_id))
    <x-app-layout>
        <livewire:onboarding.studentprofile/>
    </x-app-layout>
    @endif
</section>
