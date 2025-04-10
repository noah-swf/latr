@php
    $classes = 'inline-block bg-red-400 rounded px-2 py-0.5 text-xs font-semibold text-white mb-1';
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</span>
