<x-guest-layout>

    <x-auth-session-status class="mb-4" :status="session('status')" />
    <section class="relative flex flex-wrap lg:h-screen lg:items-center">
        <div class="w-full px-4 py-12 sm:px-6 sm:py-16 lg:w-1/2 lg:px-8 lg:py-24">
            <div class="mx-auto max-w-lg text-center">
                <a href="{{ route('landing') }}" class="mb-5 items-center justify-center flex w-full">
                    <x-application-logo class="flex-shrink-0 w-12 h-12 fill-current" />
                </a>
                <h1 class="text-2xl font-bold sm:text-3xl">Get started today!</h1>

                <p class="mt-4 text-gray-500">
                    Boost your academic success with our comprehensive resources. As a university student, you can learn
                    everything you need to excel in your field of study in a shorter period of time.
                </p>
            </div>

            <form class="mx-auto mt-8 mb-0 max-w-md space-y-4" method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="sr-only">Email</label>

                    <div class="relative">
                        <input type="email" name="email" :value="old('email')" required autofocus
                            class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm"
                            placeholder="Enter email" autocomplete="username" />

                        <span class="absolute inset-y-0 right-4 inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div x-data="{ showPassword: false }">
                    <label for="password" class="sr-only">Password</label>
                    <div class="relative">
                        <input type="password" name="password" required autocomplete="current-password"
                            class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm"
                            placeholder="Enter password"
                            x-bind:type="showPassword ? 'text' : 'password'"
                        />

                        <span class="absolute inset-y-0 right-4 inline-flex items-center">
                            <svg x-on:click="showPassword = !showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-500">
                        No account?
                        <a href="#" class="underline">Sign up</a>
                    </p>

                    <button type="submit"
                        class="ml-3 inline-block rounded-lg bg-indigo-600 px-5 py-3 text-sm font-medium text-white">
                        Sign in
                    </button>
                </div>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </form>

        </div>

        <div class="relative h-64 w-full sm:h-96 lg:h-full lg:w-1/2">
            <img alt="Welcome"
                src="https://images.unsplash.com/photo-1630450202872-e0829c9d6172?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80"
                class="absolute inset-0 h-full w-full object-cover" />
        </div>
    </section>


</x-guest-layout>
