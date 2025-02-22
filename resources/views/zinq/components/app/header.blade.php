@props(['text', 'sub' => null, 'home' => null, 'back' => null])
<div {{ $attributes->merge(['class' => 'w-full font-medium text-zinc-800 dark:text-white text-lg']) }}>
    @if ($slot)
        <zinq:breadcrumbs :back="$back" :home="$home" class="lg:-mt-4">{{ $slot }}</zinq:breadcrumbs>
    @endif
    <span>{{ $text }}</span>
    @if (isset($sub))
        <zinq:app.subheader class="my-1">{{ $sub }}</zinq:app.subheader>
    @endif
</div>
