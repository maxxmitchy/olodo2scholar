@props(['disabled' => false])

<!-- <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-purple-500
    dark:focus:border-purple-600 focus:ring-purple-500 dark:focus:ring-purple-600 rounded shadow-sm']) !!}> -->
<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm']) !!}>
