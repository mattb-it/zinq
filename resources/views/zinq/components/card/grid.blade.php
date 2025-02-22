@props(['cols' => 3])
@php
    $class = 'grid gap-4';

    // Using this approach so tailwind can compile the classes
    if ($cols == 1) {
        $class .= ' grid-cols-1';
    } elseif ($cols == 2) {
        $class .= ' grid-cols-2';
    } elseif ($cols == 3) {
        $class .= ' grid-cols-3';
    } elseif ($cols == 4) {
        $class .= ' md:grid-cols-4';
    } elseif ($cols == 5) {
        $class .= ' grid-cols-5';
    } elseif ($cols == 6) {
        $class .= ' grid-cols-6';
    }
@endphp
<div {{ $attributes->merge(['class' => $class]) }}>
    {!! $slot !!}
</div>
