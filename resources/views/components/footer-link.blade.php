@php
$classes = "underline underline-offset-4 md:px-4 py-2 text-sm font-regular leading-5 text-gray-600 transition duration-150 ease-in-out hover:text-primary"
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} >{{ $slot }}</a>
