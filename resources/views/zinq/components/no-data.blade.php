@props(['text', 'on' => true])
@if ($on)
<div {{ $attributes->merge(['class' => 'zinq-no-data']) }}>
    <div class="min-h-[200px] relative flex flex-col items-center justify-center p-8 overflow-hidden">
        {{ $slot }}
        <div class="relative z-10 text-center {{ isset($slot) && $slot->isNotEmpty() ? 'mt-8' : '' }}">
            <div class="text-center text-sm text-zinc-600 dark:text-zinc-400">{{ $text }}</div>
            {{ $button }}
        </div>
    </div>
</div>
@endif
