<x-guest-layout>
    <section wire:key="premium-registration" class="grid lg:grid-cols-2 grid-cols-1 lg:h-screen">
        <article class="bg-gray-50 lg:py-12 lg:px-28 px-5 py-5">
            <article class="flex items-center space-x-5 lg:p-8 p-3 bg-white rounded">
                <a href="{{ route('landing') }}">
                    <x-application-logo class="flex-shrink-0 w-12 h-12 fill-current" />
                </a>

                <p class="tracking-wider">
                    <strong>Register</strong> on Olodo2Scholar the ultimate exam prep platform.
                </p>
            </article>
            <form class="mt-6" wire:submit.prevent="store">
                @csrf

                <!-- First Name -->
                <div class="mt-4">
                    <x-input-label for="first_name" class="" :value="__('First Name')" />

                    <x-text-input placeholder="enter first name" id="first_name" class="block mt-1 w-full"
                        wire:model.defer="first_name" type="text" name="first_name" :value="old('first_name')"
                        autocomplete="first_name" required />

                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="last_name" class="" :value="__('Last Name')" />

                    <x-text-input placeholder="enter last name" id="last_name" class="block mt-1 w-full"
                        wire:model.defer="last_name" type="text" name="last_name" :value="old('last_name')"
                        autocomplete="last_name" required />

                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" class="" :value="__('Email')" />

                    <x-text-input placeholder="enter email address" id="email" class="block mt-1 w-full"
                        wire:model.defer="email" type="email" name="email" :value="old('email')"
                        autocomplete="username" required />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" class="" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                        wire:model.defer="password" required autocomplete="new-password" placeholder="enter password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex my-8">
                    <label for="terms" class="flex items-center">
                        <input id="terms" required type="checkbox"
                            class="text-indigo-600
                            focus:ring-0 rounded h-4 w-4 form-checkbox"
                            name="terms">
                        <span
                            class="ml-2 text-xs sm:text-sm tracking-wider">{{ __('Agree to our terms of use and privacy.') }}</span>
                    </label>
                </div>

                <button 
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-50 cursor-not-allowed"
                    wire:target="store"
                    class="block w-full rounded-lg bg-indigo-600 px-12 py-2 text-sm lg:text-base font-semibold text-white shadow hover:bg-indigo-700 focus:outline-none focus:ring active:bg-indigo-500 sm:w-auto">
                    {{ __('Register') }}
                </button>
            </form>
        </article>
    </section>
</x-guest-layout>
