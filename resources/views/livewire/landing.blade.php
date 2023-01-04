<section class="relative">
    <x-navigation.header/>

    <section class="relative bg-gray-background pb-10">
        <div class="max-w-screen-xl grid grid-cols-1 lg:grid-cols-2 lg:gap-10 px-5 pt-24 pb-14 lg:px-24 lg:pb-24 lg:pt-36">
            <div class="flex flex-col space-y-3 lg:px-5">
            <h1 class="text-2xl tracking-tight font-extrabold sm:text-4xl">
                <strong class="text-purple-500">Achieving a 4.5 GPA is within reach. </strong>
                Allow us to assist you in reaching this academic goal.
            </h1>
            <p class="mt-4 text-gray-600 tracking-tight sm:text-lg">
                Our quizzes and summaries are specifically designed to aid in the mastery of your study materials and excel on tests and exams.
                We are committed to providing the necessary tools and resources to ensure your academic success.
            </p>
            </div>

            <div class="away">

            </div>
        </div>

        <div class="flex space-x-5 px-5 lg:px-28">
            <a wire:click="$set('status', 'featured')" href="#featured" class="tracking-tight text-sm font-semibold py-3
            border-b-2 {{ $this->status === 'featured' ? 'border-purple-500' : 'border-transparent' }}">
            Featured
            </a>
            <a wire:click="$set('status', 'recent')" href="#recent" class="tracking-tight text-sm font-semibold py-3
            border-b-2 {{ $this->status === 'recent' ? 'border-purple-500' : 'border-transparent' }}">
            Recently added
            </a>
            <a wire:click="$set('status', 'trending')" href="#trending" class="tracking-tight text-sm font-semibold py-3
            border-b-2 {{ $this->status === 'trending' ? 'border-purple-500' : 'border-transparent' }}">
            Trending
            </a>
        </div>
    </section>

    <div class="relative">
  <div class="absolute inset-0 grid" aria-hidden="true">
    <div class="bg-gray-50"></div>
    <div class="bg-cyan-800"></div>
  </div>
  <div class="isolate lg:px-24">
    <article class="wrapper px-5">
      @forelse ($this->coursestat as $course )
        <article class="bg-white item border rounded p-3 space-y-3">
          <div class="-m-2 flex flex-wrap">
            @foreach (['lorem', 'ipsum galor'] as $i)
              <a href="" class="m-1 px-2 py-1 font-bold tracking-tight text-xs rounded bg-gray-50">
                {{ $i }}
              </a>
            @endforeach
          </div>
          <h3 class="tracking-tight text-base font-bold">
            {{$course->title}}
          </h3>
          <div class="prose tracking-tight line-clamp-3 text-gray-500 text-sm">
            {!! $course->description !!}
          </div>

          <section class="space-y-2 flex flex-col">
            <div class="flex space-x-1 items-center">
              <x-Icons.book class="h-4 w-4"/>
              <p class="tracking-tight text-xs">{{$course->topics->count()}} topics</p>
            </div>
          </section>

          <a href="{{ route('course.course_details', ['course' => $course->key]) }}"
            class="block text-center w-full p-2 text-sm font-medium tracking-tight text-white bg-purple-600 shadow
            rounded hover:bg-purple-700 focus:outline-none focus:ring focus:ring-purple-600 active:bg-purple-500 sm:w-auto">
            Start learning
          </a>
        </article>
        @empty
        <article class="space-x-2 flex justify-center items-center text-red bg-white p-3 rouned">
            <x-Icons.caution class="h-7 w-7 flex-shrink-0"/>
            <p class="tracking-tight">Sorry, courses are still in development. Check back later for updates.</p>
        </article>
      @endforelse
    </article>
  </div>
</div>
<section class="py-28 bg-cyan-800 px-5">
  <div class="text-white max-w-xl mx-auto text-center">
    <h1 class="text-3xl font-extrabold sm:text-5xl">
      Choose a course from the options below
    </h1>

    <p class="mt-4 tracking-tight sm:text-xl sm:leading-relaxed">
      Here're courses from every faculty, department and study levels we cover.
    </p>
  </div>
  <section class="bg-white lg:p-10 px-5 py-5 mt-8 mb-10 rounded max-w-xl mx-auto">
    {{ $this->form }}
  </section>

  <section class="lg:px-24 grid lg:grid-cols-4 grid-cols-1 gap-10 py-10">
    @foreach ($this->courses as $course)
    <article class="bg-white item border rounded p-3 space-y-3">
  <div class="-m-2 flex flex-wrap">
    @foreach (['lorem', 'ipsum galor'] as $i)
      <a href="" class="m-1 px-2 py-1 font-bold tracking-tight text-xs rounded bg-gray-50">
        {{ $i }}
      </a>
    @endforeach
  </div>
  <h3 class="tracking-tight text-base font-bold">
    {{ $course->title }}, {{ $course->code }}, {{ $course->level->name }}
  </h3>
    <div class="prose line-clamp-3 tracking-tight text-gray-500 text-sm">
    {!! $course->description !!}
    </div>

  <section class="space-y-2 flex flex-col">
    <div class="flex space-x-1 items-center">
      <x-Icons.book class="h-4 w-4"/>
      <p class="tracking-tight text-xs">{{$course->topics->count()}} topics</p>
    </div>
  </section>

  <a href="{{ route('course.course_details', ['course' => $course->key]) }}"
    class="block text-center w-full p-2 text-sm font-medium tracking-tight text-white bg-purple-600 shadow
    rounded hover:bg-purple-700 focus:outline-none focus:ring focus:ring-purple-600 active:bg-purple-500 sm:w-auto">
    Start learning
  </a>
</article>
@endforeach
</section>
</section>

    <section class="border-b py-28 px-5">
        <div class="max-w-xl mx-auto text-center">
            <h1 class="text-3xl font-extrabold sm:text-5xl">
                Get unlimited access with a premium membership
            </h1>

            <p class="mt-4 tracking-tight sm:text-xl sm:leading-relaxed">
                Join hundreds of students improving on their studies everyday
            </p>
        </div>

        <div class="mt-20 grid lg:grid-cols-3 lg:gap-20 gap-10 grid-cols-1 max-w-5xl mx-auto">
            <div class="space-y-3 p-5">
                <div class="flex justify-betweeen">
                    <div class="flex flex-1 flex-col space-y-2">
                        <h4 class="tracking-tight font-bold">
                            Monthly
                        </h4>
                        <p class="tracking-tight text-sm">
                            Access to everything.
                        </p>
                    </div>
                    <h4 class="tracking-tight text-2xl font-semibold">$5/<sub>month</sub></h4>
                </div>

                <hr>

                <div class="flex-1 flex-col space-y-2">
                    <div class="flex space-x-2 items-center">
                        <x-Icons.check class="w-4 h-4"/>
                        <p class="tracking-tight text-sm">Lorem, ipsum galor.</p>
                    </div>
                </div>

                <a href="" class="block text-center w-full p-2 text-sm font-medium tracking-tight text-white bg-purple-600 shadow
                    rounded hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-500 sm:w-auto">
                    Get Started
                </a>
            </div>

            <div class="rounded space-y-3 p-5 bg-purple-700 text-white">
                <div class="flex justify-betweeen">
                    <div class="flex flex-1 flex-col space-y-2">
                        <h4 class="tracking-tight font-bold">
                            Every Semester
                        </h4>
                        <p class="tracking-tight text-sm">
                            Best value
                        </p>
                    </div>
                    <h4 class="tracking-tight text-2xl font-semibold">$25/<sub>month</sub></h4>
                </div>

                <hr>

                <div class="flex-1 flex-col space-y-2">
                    <div class="flex space-x-2 items-center">
                        <x-Icons.check class="w-4 h-4"/>
                        <p class="tracking-tight text-sm">Lorem, ipsum galor.</p>
                    </div>
                </div>

                <a href="" class="block text-center w-full p-2 text-sm font-medium tracking-tight text-white bg-purple-600 shadow
                    rounded hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-500 sm:w-auto">
                    Get Started
                </a>
            </div>

            <div class="rounded space-y-3 p-5 bg-purple-700 text-white">
                <div class="flex justify-betweeen">
                    <div class="flex flex-1 flex-col space-y-2">
                        <h4 class="tracking-tight font-bold">
                            Full Session
                        </h4>
                        <p class="tracking-tight text-sm">
                            Access to everything.
                        </p>
                    </div>
                    <h4 class="tracking-tight text-2xl font-semibold">$55/<sub>month</sub></h4>
                </div>

                <hr>

                <div class="flex-1 flex-col space-y-2">
                    <div class="flex space-x-2 items-center">
                        <x-Icons.check class="w-4 h-4"/>
                        <p class="tracking-tight text-sm">Lorem, ipsum galor.</p>
                    </div>
                </div>

                <a href="" class="block text-center w-full p-2 text-sm font-medium tracking-tight text-white bg-purple-600 shadow
                    rounded hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-500 sm:w-auto">
                    Get Started
                </a>
            </div>
        </div>

    </section>

    <section class="py-28 px-5">
    <div class="max-w-xl mx-auto text-center">
        <h1 class="text-3xl font-extrabold sm:text-5xl">
        Trusted by over 2,000 students across Nigerian Universities
        </h1>

        <p class="mt-4 tracking-tight sm:text-xl sm:leading-relaxed">
        Here's what some of our awesome members are saying
        </p>
    </div>

    <div class="mt-20 grid lg:grid-cols-3 lg:gap-20 gap-10 grid-cols-1 max-w-5xl mx-auto">
        @foreach ([1,2] as $i )
        <div class="space-y-3">
            <div class="p-5 rounded bg-gray-50">
            <h6 class="tracking-tight font-semibold text-sm">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quidem cum facilis doloribus.
            </h6>
            </div>
            <div class="flex space-x-4 items-center">
            <div class="p-5 rounded-full shadow"></div>
            <p class="tracking-tight text-sm">Lorem ipsum dolor sit amet.</p>
            </div>
        </div>
        @endforeach
    </div>
    </section>


    <x-footer/>
</section>
