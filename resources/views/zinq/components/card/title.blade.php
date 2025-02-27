@aware(['inverse'])
@php
    $classes = 'text-zinc-950 dark:text-zinc-50 font-bold text-xl';

    // Handle inverse card
    if ($inverse) {
        $classes = 'text-white dark:text-black font-bold text-xl';
    }
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    <span>{{ $slot }}</span>
</div>
