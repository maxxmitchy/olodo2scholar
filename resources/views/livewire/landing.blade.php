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

@section('title', 'Olodo2Scholar - Start Learning')

<section class="relative" x-data="{
    scrollToParagraph() {
        document.getElementById('course').scrollIntoView({ behavior: 'smooth' });
    }
}">
    <x-navigation.header>
        <input wire:model="search" x-ref="input" @focus="scrollToParagraph" type="search" placeholder="Search from this course list..."
            class="lg:hidden w-full rounded-md shadow-sm border-0 focus:border-indigo-300 focus:ring
                focus:ring-indigo-200 focus:ring-opacity-50 text-[17px] placeholder:text-slate-600"
            >
    </x-navigation.header>

    <section class="relative bg-gray-background pb-10">
        <div
            class="container max-w-screen-xl grid grid-cols-1 lg:grid-cols-2 gap-10 px-5 pt-24 pb-14 lg:px-24 lg:pb-24 lg:pt-36">
            <div class="flex flex-col space-y-3 lg:px-5">
                <h1 class="tracking-wide font-extrabold text-4xl sm:text-5xl">
                    With the right support,
                    <strong class="text-indigo-600 font-extrabold">
                        a 4.5GPA is within reach.
                    </strong>
                </h1>
                <p class="mt-4 text-gray-600 tracking-wider sm:text-lg">
                    Say goodbye to exam struggles and hello to top grades😎. With our personalized quizzes and study
                    summaries, we'll help you master your materials and crush those tests with ease.
                </p>

                <br class="">
                <br class="hidden lg:block">

                <div class="mt-8 lg:mt-16 flex flex-wrap gap-4 text-center">
                    <a href="{{ route('login') }}"
                        class="block w-full rounded-lg bg-indigo-600 px-12 py-4 text-sm lg:text-base font-semibold text-white shadow hover:bg-indigo-700 focus:outline-none focus:ring active:bg-indigo-500 sm:w-auto">
                        Get Started
                    </a>

                    <a href="#course"
                        class="block w-full rounded-lg bg-white px-12 py-4 text-sm lg:text-base font-semibold text-indigo-600 shadow hover:text-indigo-700 focus:outline-none focus:ring active:text-indigo-500 sm:w-auto">
                        Learn More
                    </a>
                </div>
            </div>
            <div class="away">
                <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
                    <div class="mx-auto max-w-lg">
                        <h1 class="text-center text-2xl font-bold sm:text-3xl">
                            Get in touch today!
                        </h1>

                        <p class="mx-auto mt-4 max-w-md text-center text-gray-500">
                            We welcome suggestions for new quiz topics. Contact us with your ideas.
                        </p>

                        <form wire:submit.prevent="contactUs"
                            class="mt-6 mb-0 space-y-4 rounded-lg p-3 lg:p-8 shadow-2xl">
                            @csrf
                            <div>
                                <label for="name" class="text-sm font-medium">Full Name</label>

                                <div class="relative mt-1">
                                    <input required type="text" id="name" wire:model="name"
                                        class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm"
                                        placeholder="Enter full name here" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                            </div>
                            <div>
                                <label for="email" class="text-sm font-medium">Email</label>

                                <div class="relative mt-1">
                                    <input required wire:model="email" type="email" id="email"
                                        class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm"
                                        placeholder="Enter email" />

                                    <span class="absolute inset-y-0 right-4 inline-flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                        </svg>
                                    </span>
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div>
                                <label for="message" class="text-sm font-medium">Message</label>

                                <div class="relative mt-1">
                                    <textarea id="message" name="message" wire:model="infor"
                                        class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm" rows="4" cols="30"
                                        aria-describedby="feedback-description" required placeholder="Enter message"></textarea>
                                    <small id="feedback-description" class="hidden form-text text-muted">Please let us
                                        know
                                        your thoughts and suggestions on how we can improve our service.</small>
                                </div>
                                <x-input-error :messages="$errors->get('infor')" class="mt-2" />
                            </div>


                            <button type="submit" wire:loading.attr="disabled"
                                wire:loading.class="opacity-50 cursor-not-allowed"
                                class="block w-full rounded-lg bg-indigo-600 px-5 py-4 text-sm lg:text-base font-medium text-white">
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>


        <div class="flex space-x-5 px-5 lg:px-28">
            <a wire:click="$set('status', 'featured')" href="#featured"
                class="tracking-wider text-base lg:text-lg font-semibold py-3
            border-b-2 {{ $this->status === 'featured' ? 'border-indigo-600' : 'border-transparent text-gray-500' }}">
                Featured
            </a>
            <a wire:click="$set('status', 'recent')" href="#recent"
                class="tracking-wider text-base lg:text-lg font-semibold py-3
            border-b-2 {{ $this->status === 'recent' ? 'border-indigo-600' : 'border-transparent text-gray-500' }}">
                Recently added
            </a>
            <a wire:click="$set('status', 'trending')" href="#trending"
                class="tracking-wider text-base lg:text-lg font-semibold py-3
            border-b-2 {{ $this->status === 'trending' ? 'border-indigo-600' : 'border-transparent text-gray-500' }}">
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
                @forelse ($this->coursestat as $course)
                    <x-coursecard :course="$course" />
                @empty
                    <article class="col-span-4 space-x-4 flex justify-center shadow shadow-red items-center bg-red text-white p-5 rounded">
                        <x-Icons.caution class="h-10 w-10 flex-shrink-0" />
                        <p class="tracking-wider text-sm">
                            Sorry, courses are still in developement. Check back later.
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
                <article class="col-span-4 space-x-4 flex justify-center shadow shadow-red items-center bg-red text-white p-5 rounded">
                    <x-Icons.caution class="h-10 w-10 flex-shrink-0" />
                    <p class="tracking-wider text-sm">
                        Sorry, no courses match your search. Try adjusting your terms or filters.
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
                    <h4 class="tracking-wider text-2xl font-semibold">₦1,800</h4>
                </div>

                <hr>

                <div class="flex-1 flex-col space-y-2">

                </div>

                <a wire:click="$emit('openModal', 'modal.freefornow')"
                    class="cursor-pointer block text-center w-full p-4 text-base font-medium tracking-wider text-white bg-indigo-600 shadow
                    rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring active:bg-indigo-600 sm:w-auto">
                    Get Started
                </a>
            </div>

            <div class=" shadow shadow-yellow/80 rounded-lg space-y-3 p-5 bg-gray-700 text-white">
                <div class="flex justify-betweeen">
                    <div class="flex flex-1 flex-col space-y-2">
                        <h4 class="tracking-wider text-base font-bold">
                            Every Semester
                        </h4>
                        <p class="tracking-wider text-sm">
                            Best value
                        </p>
                    </div>
                    <h4 class="tracking-wider text-2xl font-semibold">₦4,800</h4>
                </div>

                <hr>

                <div class="flex-1 flex-col space-y-2">

                </div>

                <a wire:click="$emit('openModal', 'modal.freefornow')"
                    class="cursor-pointer block text-center w-full p-4 text-base font-medium tracking-wider shadow text-white bg-gray-600
                    rounded-lg hover:bg-gray-700 focus:outline-none focus:ring active:bg-gray-500 sm:w-auto">
                    Get Started
                </a>
            </div>

            <div class="rounded-lg space-y-3 p-5 bg-white">
                <div class="flex justify-betweeen">
                    <div class="flex flex-1 flex-col space-y-2">
                        <h4 class="tracking-wider text-base font-bold">
                            Full Session
                        </h4>
                        <p class="tracking-wider text-sm">
                            Access to everything.
                        </p>
                    </div>
                    <h4 class="tracking-wider text-2xl font-semibold">₦8,000</h4>
                </div>

                <hr>

                <div class="flex-1 flex-col space-y-2">

                </div>

                <a wire:click="$emit('openModal', 'modal.freefornow')"
                    class="cursor-pointer block text-center w-full p-4 text-base font-medium tracking-wider text-white bg-indigo-600 shadow
                    rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring active:bg-indigo-600 sm:w-auto">
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
    ] as $i)
                <div class="space-y-3">
                    <div class="p-5 rounded bg-gray-50">
                        <p>
                            {{ $i['text'] }}
                        </p>
                    </div>
                    <div class="ml-1 flex space-x-4 items-center">
                        <div
                            class="h-10 w-10 flex justify-center items-center p-2  font-black flex-shrink-0 text-white
                                bg-black rounded-full shadow">
                            {{ showInitials($i['author']) }}
                        </div>
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

    <x-footer />
</section>
