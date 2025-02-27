@props([
    'flat' => false,
    'inverse' => false,
    'emerald' => false,
    'fuchsia' => false,
    'yellow' => false,
])

@php
    $classes = 'rounded-xl p-2 sm:p-4 lg:p-6';

    // Add default styling
    if (!$flat) {
        $classes .= ' sm:shadow';
    }

    // Add color variations
    if ($inverse) {
        $classes .= ' bg-zinc-950 dark:bg-zinc-50';
    } elseif ($emerald) {
        $classes .= ' bg-emerald-300 dark:bg-emerald-900';
    } elseif ($fuchsia) {
        $classes .= ' bg-fuchsia-300 dark:bg-fuchsia-900';
    } elseif ($yellow) {
        $classes .= ' bg-yellow-200 dark:bg-yellow-900';
    } else {
        $classes .= ' sm:bg-white dark:bg-zinc-900';
    }

    // Add data attributes for child component styling
    $dataAttributes = [];
    if ($inverse) {
        $dataAttributes['data-card-inverse'] = 'true';
    }
    if ($emerald) {
        $dataAttributes['data-card-emerald'] = 'true';
    }
    if ($fuchsia) {
        $dataAttributes['data-card-fuchsia'] = 'true';
    }
    if ($yellow) {
        $dataAttributes['data-card-yellow'] = 'true';
    }
@endphp

<div {{ $attributes->merge(['class' => $classes])->merge($dataAttributes) }}>
    {!! $slot !!}
</div>
