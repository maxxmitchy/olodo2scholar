<x-guest-layout>
    <section class="grid lg:grid-cols-2 grid-cols-1 lg:h-screen">
        <article class="bg-gray-50 lg:py-12 lg:px-28 px-5 py-5">
            <article class="flex items-center space-x-5 lg:p-8 p-3 bg-white rounded">
                <a href="{{ route('landing') }}">
                    <x-application-logo class="flex-shrink-0 w-12 h-12 fill-current" />
                </a>

                <p class="tracking-wider text-sm">
                    <b class="text-base">StudyEazy</b>: the ultimate exam prep platform. Boost your grades with fun,
                    personalized quizzes.
                </p>
            </article>
            <form class="mt-6" method="POST" wire:submit.prevent="store">
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
                            class="text-purple-500
                            focus:ring-0 rounded h-4 w-4 form-checkbox"
                            name="terms">
                        <span
                            class="ml-2 text-xs sm:text-sm tracking-wider">{{ __('Agree to our terms of use and privacy.') }}</span>
                    </label>
                </div>

                <button wire:loading
                    class="mt-5 bg-purple-700 py-2 text-base font-semibold text-white
                flex rounded justify-center mb-4 w-full hover:bg-purple-900 active:bg-purple-900 focus:outline-none focus:border-purple-900 shadow focus:ring ring-purple-300">
                    {{ __('Register') }}
                </button>
            </form>
        </article>

        <article class="hidden">
            <article class="lg:py-16 lg:px-36 px-5 py-5" x-data="{ current_plan: @entangle('activePlan') }">
                <h4 class="mb-8 tracking-wider text-gray-800 text-2xl font-bold">Choose Plan</h4>

                <section class="space-y-3">
                    @foreach ([['id' => 1, 'name' => 'Monthly', 'price' => '12/month'], ['id' => 2, 'name' => 'Semester', 'price' => '24/semester'], ['id' => 3, 'name' => 'Session', 'price' => '55/session']] as $subscr)
                        <div @click="current_plan = {{ $subscr['id'] }}"
                            :class="{
                                'border-purple-500 text-purple-700 font-medium': current_plan === {{ $subscr['id'] }},
                                'border-slate-300 text-gray-600': current_plan !== {{ $subscr['id'] }},
                            }"
                            class="cursor-pointer hover:border-purple-500 rounded font-bold border-gray-300 flex items-center space-x-4 border py-3 px-5">
                            <div :class="{
                                'bg-purple-700': current_plan === {{ $subscr['id'] }},
                                'bg-slate-300': current_plan !== {{ $subscr['id'] }}
                            }"
                                class="flex items-center justify-center h-3 w-3 flex-shrink-0 rounded-full">
                                <div class="bg-white h-1 w-1 rounded-full"></div>
                            </div>

                            <h6 class="tracking-wider text-sm font-medium">{{ $subscr['name'] }} ${{ $subscr['price'] }}
                            </h6>
                        </div>
                    @endforeach

                    <br>

                    <p class="tracking-wider text-sm">
                        Nice choice. You can swap your plan any time during your subscription if you change your mind.
                    </p>

                    <br>

                    <div class="flex space-x-4 items-center">
                        <x-Icons.lock class="flex-shrink-0 h-4 w-4" />
                        <p class="tracking-wider text-sm">
                            This is a secure checkout, your payment details don't touch our servers.
                        </p>
                    </div>
                </section>
                <br>
                <br>
            </article>
        </article>
    </section>
</x-guest-layout>
