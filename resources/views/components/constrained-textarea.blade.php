@props(['limit' => 255, 'value' => ''])

<div
    x-data="{
        content: '{{ $value }}',
        limit: {{ $limit }},
        get remaining() {
            return this.limit - this.content.length
        }
    }"
>
    <textarea
        x-model="content"
        maxlength="{{ $limit }}"
        value="{{$value ?? 'start typing'}}"
        placeholder="start typing..."
        {{ $attributes->merge(['class' => 'w-full rounded-lg border-gray-200 p-4 text-sm shadow-sm text-sm tracking-wider
                        placeholder:text-gray-400']) }}
    ></textarea>

    <p>
        <small>You have <span class="font-semibold text-blue-500" x-text="remaining"></span> characters remaining.</small>
    </p>
</div>
