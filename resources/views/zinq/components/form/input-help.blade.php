@props(['class' => '', 'error' => false, 'textColor' => 'text-zinc-400'])
@php
    if ($error) {
        $textColor = 'text-red-500';
    }
@endphp
<span
    {{ $attributes->merge(['class' => 'zinq-input-help inline-block text-sm ' . $textColor . ' ' . $class]) }}
>
    {{ $slot }}
</span>
