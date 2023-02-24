@props([
    "title" => "Add New Comment"
])
@if(auth()->check())
<form x-cloak {{$attributes->wire('submit')}}>
    {{-- add comment --}}
    <div class="">
        <hr>
        <h4 class="text-sm font-bold lg:text-lg py-5">{{$title}}</h4>
        {{ $this->form }}

        <div class="flex space-x-3 mt-4">
            <button {{ $attributes->wire('target') }}
                    wire:loading.class.remove="bg-indigo-600"
                    wire:loading.class="bg-indigo-300"
                    type="submit"
                    class="rounded px-4 py-2 text-sm bg-indigo-600 text-white">
                Send
            </button>
            <button
                type="button"
                x-on:click="closeForm"
                class="rounded px-4 py-2 text-sm text-indigo-600 border border-indigo-600">
                Cancel
            </button>
        </div>
    </div>
    {{-- end add comment --}}
</form>
@else
    <div class="border border-indigo-700 text-center text-indigo-800 bg-indigo-50 flex flex-col w-full p-4 gap-2">
        <p class="font-bold text-lg">You are not logged in</p>
        <p>Please log in or sign up to add a comment to this discussion</p>
        <div class="block space-x-2 mt-4">
            <a href="/login" class="inline-flex rounded-lg px-4 p-1 bg-indigo-600 text-white">Login</a>
            <a href="/register" class="inline-flex rounded-lg px-4 p-1 hover:bg-indigo-100">Sign Up</a>
    </div>
    </div>
@endif
