@php
    $classes = 'pt-3 text-sm text-zinc-900 dark:text-zinc-200';
    
    // Handle inverse card
    if ($attributes->has('data-card-inverse')) {
        $classes = 'pt-3 text-sm text-zinc-100 dark:text-zinc-700';
    }
@endphp

<div {{ $attributes->except(['data-card-inverse', 'data-card-emerald', 'data-card-fuchsia', 'data-card-yellow'])->merge(['class' => $classes]) }}>
    <p>{{ $slot }}</p>
</div>
