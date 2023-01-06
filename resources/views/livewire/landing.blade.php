@php
    function showInitials($name)
    {
        $name_parts = explode(' ', $name);
        $initials = array_map(function ($part) {
            return $part[0];
        }, $name_parts);
        $initials_string = implode('', $initials);
        return $initials_string;
    }
@endphp

@section('title', 'StudyEazy - Start Learning')

<section class="relative" x-data="{
    scrollToParagraph() {
        document.getElementById('course').scrollIntoView({ behavior: 'smooth' });
    }
}">
    <x-navigation.header />

    <section class="relative bg-gray-background pb-10">
        <div
            class="container max-w-screen-xl grid grid-cols-1 lg:grid-cols-2 gap-10 px-5 pt-24 pb-14 lg:px-24 lg:pb-24 lg:pt-36">
            <div class="flex flex-col space-y-3 lg:px-5">
                <h1 class="text-2xl tracking-wider font-extrabold sm:text-4xl">
                    <strong class="text-purple-600 text-4xl sm:text-5xl">Achieving a 4.5 GPA is within reach.</strong>
                    Allow us to assist you in reaching this academic goal.
                </h1>
                <p class="mt-4 text-gray-600 tracking-wider sm:text-lg">
                    Our quizzes and summaries are specifically designed to aid in the mastery of your study materials
                    and excel on tests and exams. We are committed to providing the necessary tools and resources to
                    ensure your academic success.
                </p>
            </div>
            <div class="away hidden"></div>
        </div>


        <div class="flex space-x-5 px-5 lg:px-28">
            <a wire:click="$set('status', 'featured')" href="#featured"
                class="tracking-wider text-base lg:text-lg font-semibold py-3
            border-b-2 {{ $this->status === 'featured' ? 'border-purple-500' : 'border-transparent' }}">
                Featured
            </a>
            <a wire:click="$set('status', 'recent')" href="#recent"
                class="tracking-wider text-base lg:text-lg font-semibold py-3
            border-b-2 {{ $this->status === 'recent' ? 'border-purple-500' : 'border-transparent' }}">
                Recently added
            </a>
            <a wire:click="$set('status', 'trending')" href="#trending"
                class="tracking-wider text-base lg:text-lg font-semibold py-3
            border-b-2 {{ $this->status === 'trending' ? 'border-purple-500' : 'border-transparent' }}">
                Trending
            </a>
        </div>
    </section>

    <div class="relative">
        <div class="absolute inset-0 grid" aria-hidden="true">
            <div class="bg-gray-50"></div>
            <div class="bg-gray-700"></div>
        </div>
        <div class="isolate lg:px-24">
            <article class="wrapper px-5">
                @forelse ($this->coursestat as $course )
                    <x-coursecard :course="$course" />
                @empty
                    <article class="space-x-2 flex justify-center items-center text-red bg-white p-3 rouned">
                        <x-Icons.caution class="h-7 w-7 flex-shrink-0" />
                        <p class="tracking-wider">Sorry, courses are still in development. Check back later for updates.
                        </p>
                    </article>
                @endforelse
            </article>
        </div>
    </div>
    <section class="py-28 bg-gray-700 px-5">
        <div class="text-white max-w-xl mx-auto text-center">
            <h1 class="text-3xl font-extrabold sm:text-5xl">
                Choose a course from the options below
            </h1>

            <p class="mt-4 tracking-wider sm:text-xl sm:leading-relaxed">
                Here're courses from every faculty, department and study levels we cover.
            </p>
        </div>
        <section class="bg-white lg:p-10 px-5 py-5 mt-8 mb-10 rounded max-w-xl mx-auto">
            {{ $this->form }}
        </section>

        <section id="course" class="lg:px-24 grid lg:grid-cols-4 grid-cols-1 gap-10 py-10">
            @forelse ($this->courses as $course)
                <x-coursecard :course="$course" />
            @empty
                <article class="col-span-4 space-x-3 flex justify-center items-center text-red bg-white p-3 rouned">
                    <x-Icons.caution class="h-7 w-7 flex-shrink-0" />
                    <p class="tracking-wider text-sm">
                        We're sorry, but it looks like we don't have any courses that match your search criteria.
                        Please try adjusting your search terms or filters to see if we have any courses that might be a
                        good fit for you.
                    </p>
                </article>
            @endforelse
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
                        <h4 class="tracking-wider text-base font-bold">
                            Monthly
                        </h4>
                        <p class="tracking-wider text-sm">
                            Access to everything.
                        </p>
                    </div>
                    <h4 class="tracking-wider text-2xl font-semibold">₦1,400</h4>
                </div>

                <hr>

                <div class="flex-1 flex-col space-y-2">
                    <!-- <div class="flex space-x-2 items-center">
                        <x-Icons.check class="w-4 h-4"/>
                        <p class="tracking-wider text-sm">Lorem, ipsum galor.</p>
                    </div> -->
                </div>

                <a wire:click="$emit('openModal', 'modal.freefornow')"
                    class="cursor-pointer block text-center w-full p-2 text-base font-medium tracking-wider text-white bg-purple-600 shadow
                    rounded hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-500 sm:w-auto">
                    Get Started
                </a>
            </div>

            <div class="rounded space-y-3 p-5 bg-gray-700 text-white">
                <div class="flex justify-betweeen">
                    <div class="flex flex-1 flex-col space-y-2">
                        <h4 class="tracking-wider text-base font-bold">
                            Every Semester
                        </h4>
                        <p class="tracking-wider text-sm">
                            Best value
                        </p>
                    </div>
                    <h4 class="tracking-wider text-2xl font-semibold">₦4,000</h4>
                </div>

                <hr>

                <div class="flex-1 flex-col space-y-2">
                    <!-- <div class="flex space-x-2 items-center">
                        <x-Icons.check class="w-4 h-4"/>
                        <p class="tracking-wider text-sm">Lorem, ipsum galor.</p>
                    </div> -->
                </div>

                <a wire:click="$emit('openModal', 'modal.freefornow')"
                    class="cursor-pointer block text-center w-full p-2 text-base font-medium tracking-wider text-white bg-gray-600 shadow
                    rounded hover:bg-gray-700 focus:outline-none focus:ring active:bg-gray-500 sm:w-auto">
                    Get Started
                </a>
            </div>

            <div class="rounded space-y-3 p-5 bg-white">
                <div class="flex justify-betweeen">
                    <div class="flex flex-1 flex-col space-y-2">
                        <h4 class="tracking-wider text-base font-bold">
                            Full Session
                        </h4>
                        <p class="tracking-wider text-sm">
                            Access to everything.
                        </p>
                    </div>
                    <h4 class="tracking-wider text-2xl font-semibold">₦7,500</h4>
                </div>

                <hr>

                <div class="flex-1 flex-col space-y-2">
                    <!-- <div class="flex space-x-2 items-center">
                        <x-Icons.check class="w-4 h-4"/>
                        <p class="tracking-wider text-sm">Lorem, ipsum galor.</p>
                    </div> -->
                </div>

                <a wire:click="$emit('openModal', 'modal.freefornow')"
                    class="cursor-pointer block text-center w-full p-2 text-base font-medium tracking-wider text-white bg-purple-600 shadow
                    rounded hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-500 sm:w-auto">
                    Get Started
                </a>
            </div>
        </div>

    </section>

    <section class="py-28 px-5">
        <div class="max-w-xl mx-auto text-center">
            <h1 class="text-3xl tracking-wider font-extrabold sm:text-5xl">
                Trusted by over 2,000 students across Nigerian Universities
            </h1>

            <p class="mt-4 tracking-wider sm:text-xl sm:leading-relaxed">
                Here's what some of our awesome members are saying
            </p>
        </div>

        <div class="mt-20 grid lg:grid-cols-3 gap-10 grid-cols-1 max-w-5xl mx-auto">
            @foreach ($testimonials = [
        ['author' => 'John Ideh', 'text' => 'I absolutely love using this platform! The questions were challenging but helped me retain the information better. I highly recommend giving it a try.'],
        [
            'author' => 'Ibeh Ameachi',
            'text' => "This platform was a game-changer for me.
                    I was able to learn so much in a short amount of time and feel confident in my understanding of the material. Thank you!",
        ],
        ['author' => 'Michael Oliora', 'text' => 'As someone who struggles with staying focused during online learning, I was pleasantly surprised by how much I enjoyed using this platform. The quizzes kept me engaged and helped me retain the information. Highly recommend!'],
        ['author' => 'Tolu Adeniyi', 'text' => 'I have taken a lot of online courses in the past, but this platform was by far the most effective for my learning style. I was able to easily track my progress and felt motivated to keep going. Thank you for creating such a helpful tool!'],
        ['author' => 'William Olu', 'text' => 'This platform was a lifesaver for me. I was able to brush up on important concepts before an exam and feel much more confident going into it. I will definitely be using it for future courses as well.'],
        ['author' => 'Anorue Emmanuel', 'text' => 'As a visual learner, I really appreciated the use of images and diagrams in the quizzes on this course topic platform. It made understanding the material so much easier and more enjoyable. I highly recommend giving it a try!'],
    ] as $i)
                <div class="space-y-3">
                    <div class="p-5 rounded bg-gray-50">
                        <h6 class="tracking-wider font-semibold text-sm">
                            {{ $i['text'] }}
                        </h6>
                    </div>
                    <div class="flex space-x-4 items-center">
                        <div
                            class="h-10 w-10 flex justify-center items-center p-2  font-black flex-shrink-0 text-white bg-black rounded-full shadow">
                            {{ showInitials($i['author']) }}</div>
                        <p class="tracking-wider text-sm underline font-bold">{{ $i['author'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="py-28 bg-slate-50 px-5 tracking-wider">
        <div class="max-w-xl mx-auto text-center">
            <h1 class="text-3xl font-extrabold sm:text-5xl">
                Find out everything you need to know about us
            </h1>

            <p class="mt-4 tracking-wider sm:text-xl sm:leading-relaxed">
                Here's everything you might want to know about us
            </p>
        </div>

        <div class="mt-10 lg:mt-20 grid gap-2 grid-cols-1 max-w-xl mx-auto">
            @foreach ($faqs as $key => $faq)
                <x-accordion :comment="$faq" :key="$key" />
            @endforeach
        </div>
    </section>

    <!-- <div x-data="{ flipped: false }" class="p-16 relative w-44 h-44 mx-auto my-8 cursor-pointer
        text-center font-bold tracking-light text-lg">
        <div x-show="!flipped"
                    x-show="open"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-90"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-end="opacity-0 scale-90"
            class="absolute text-center py-16 overflow-hidden bg-purple-200 inset-0 rounded-lg
            shadow-lg" @click="flipped = true;" >
            Front
        </div>
        <div x-show="flipped"
                    x-show="open"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-90"
            style="display: none;" class="absolute text-center py-16 bg-gray-200 overflow-hidden inset-0 rounded shadow-lg" @click="flipped = false;" >
            Back
        </div>
    </div> -->

    <x-footer />
</section>
