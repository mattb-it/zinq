@php
    $classes = 'text-zinc-950 dark:text-zinc-50 font-bold text-xl';
    
    // Handle inverse card
    if ($attributes->has('data-card-inverse')) {
        $classes = 'text-white dark:text-black font-bold text-xl';
    }
@endphp

<div {{ $attributes->except(['data-card-inverse', 'data-card-emerald', 'data-card-fuchsia', 'data-card-yellow'])->merge(['class' => $classes]) }}>
    <span>{{ $slot }}</span>
</div>
