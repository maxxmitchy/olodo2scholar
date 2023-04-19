@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red dark:text-red space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li wire:key="{{$message}}">{{ $message }}</li>
        @endforeach
    </ul>
@endif
