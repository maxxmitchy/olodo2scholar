@props([
    "title" => "Add New Comment"
])
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
