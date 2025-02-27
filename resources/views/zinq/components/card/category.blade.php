<div {{ $attributes->except(['data-card-inverse', 'data-card-emerald', 'data-card-fuchsia', 'data-card-yellow'])->merge(['class' => 'pb-2 uppercase text-zinc-500 font-semibold text-xs']) }}>
    <span>{{ $slot }}</span>
</div>
