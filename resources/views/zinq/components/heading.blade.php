@props(['level' => null])
@php
    if (!$level) {
        $tag = 'div';
    } else {
        $tag = "h$level";
    }

    $levelClass = match ((int)$level) {
        1 => 'text-3xl font-semibold',
        2 => 'text-2xl font-semibold',
        3 => 'text-xl font-semibold',
        default => 'text-base font-semibold',
    };
@endphp
<{!! $tag !!} {{ $attributes->merge(['class' => "zinq-heading $levelClass"]) }}>
    {{ $slot }}
</{{ $tag }}>
