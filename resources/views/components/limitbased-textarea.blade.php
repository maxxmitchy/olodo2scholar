@props(['limit' => 255, 'value' => ''])

<div
    x-data="{
        body: '{{ $value }}',
        limit: {{ $limit }},
        get remaining() {
            return this.limit - this.body.length
        }
    }"
>
    <textarea
        x-model="body"
        maxlength="{{ $limit }}"
        value="{{$value ?? 'start typing'}}"
        placeholder="start typing..."
        {{ $attributes->merge(['class' => 'w-full rounded-lg border-gray-200 p-2 text-sm shadow-sm text-sm tracking-wider
                        placeholder:text-gray-400']) }}
    ></textarea>

    <p class=" text-white/70">
        <small>You have <span class="font-semibold" x-text="remaining"></span> characters remaining.</small>
    </p>
</div>
