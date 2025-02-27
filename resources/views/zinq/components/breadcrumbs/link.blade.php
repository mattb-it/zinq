@props([
    'href' => null,
    'divider' => '&rarr;',
])
@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => 'text-zinc-600! dark:text-zinc-400! hover:text-zinc-950! dark:hover:text-white! bg-none!']) }}>{{ $slot }}</a>
    <span class="text-zinc-400 dark:text-zinc-700">{!! $divider !!}</span>
@else
    <span class="text-[0.85rem] text-zinc-400 dark:text-zinc-700">{{ $slot }}</span>
@endif
