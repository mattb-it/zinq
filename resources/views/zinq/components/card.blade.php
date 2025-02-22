@props([
    'flat' => false,
    'inverse' => false,
    'emerald' => false,
    'fuchsia' => false,
    'yellow' => false,
])

@php
    $class = 'zinq-card';
    if ($flat) {
        $class .= ' zinq-card-flat';
    }
    if ($inverse) {
        $class .= ' zinq-card-inverse';
    }
    if ($emerald) {
        $class .= ' zinq-card-emerald';
    }
    if ($fuchsia) {
        $class .= ' zinq-card-fuchsia';
    }
    if ($yellow) {
        $class .= ' zinq-card-yellow';
    }
@endphp

<div {{ $attributes->merge(['class' => $class]) }}>
    {!! $slot !!}
</div>
