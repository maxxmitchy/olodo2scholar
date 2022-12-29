<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <section class="grid lg:grid-cols-2 grid-cols-1 lg:h-screen">
        <article>
            <article class="lg:py-8 flex space-x-4 items-center bg-white lg:px-36 p-5">
                <a href="{{ route('landing') }}">
                    <x-application-logo class="flex-shrink-0 w-12 h-12 fill-current" />
                </a>
                <h4 class="tracking-wider font-bold text-lg">
                    Study<b class="text-purple-600">Eazy</b> Login
                </h4>
            </article>
            <article class="bg-gray-100 lg:py-12 lg:px-36 px-5 py-5">
                <div class="space-y-2">
                    <h4 class="tracking-wider font-bold text-xl lg:text-3xl">
                        Excel in your field of study with our comprehensive resources.
                    </h4>
                    <p class="tracking-wider text-xs md:text-sm">
                        Boost your academic success with our comprehensive resources. As a university student, you can learn everything you need to excel in your field of study in a shorter period of time.
                    </p>
                </div>
                <form class="mt-6" method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" autocomplete="email"
                            :class="{
                                'focus:ring-red-500 focus:outline-red-500 focus:border-red-500' : {{ $errors->has('email') }},
                            }"
                            class="block mt-1 w-full"
                            type="email" name="email"
                            :value="old('email')"
                            required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600
                                    shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                    name="remember">
                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex flex-col lg:flex-row items-center lg:justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-primary-button class="-order-1 lg:order-1 w-full lg:w-max mb-3 lg:mb-0 flex justify-center items-center lg:ml-3">
                            {{ __('Get Started') }}
                        </x-primary-button>
                    </div>
                </form>
            </article>
        </article>

        <article class="bg-purple-500 flex justify-center items-center lg:grid">
            <div class="bg-white p-5 rounded lg:h-80 lg:w-80">

            </div>
        </article>
    </section>
</x-guest-layout>
