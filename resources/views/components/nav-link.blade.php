@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'inline-flex items-center px-1 pt-1 border-b-2 border-customGreen text-sm font-medium leading-5 text-customGreen focus:outline-none focus:border-customGreen transition duration-150 ease-in-out'
                : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-black hover:text-customGreen hover:border-customGreen focus:outline-none focus:text-customGreen focus:border-customGreen transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
