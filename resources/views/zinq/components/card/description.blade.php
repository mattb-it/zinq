@aware(['inverse'])
@php
    $classes = 'pt-3 text-sm text-zinc-900 dark:text-zinc-200';

    // Handle inverse card
    if ($inverse) {
        $classes = 'pt-3 text-sm text-zinc-100 dark:text-zinc-700';
    }
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    <p>{{ $slot }}</p>
</div>
