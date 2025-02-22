@props([
    'position' => 'center', // left, right
])
<div {{ $attributes->merge(['class' => 'w-full flex items-center']) }}>
    @if (in_array($position, ['left', 'center']))
        <div class="grow border border-t border-zinc-100 dark:border-zinc-800"></div>
    @endif
    <span class="mx-4 text-zinc-600 dark:text-zinc-400">{{ $slot }}</span>
    @if (in_array($position, ['right', 'center']))
        <div class="grow border border-t border-zinc-100 dark:border-zinc-800"></div>
    @endif
</div>
