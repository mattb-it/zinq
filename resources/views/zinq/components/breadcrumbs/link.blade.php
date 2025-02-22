@props([
    'href' => null,
    'divider' => '&rarr;',
])
@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge() }}>{{ $slot }}</a>
    <span>{!! $divider !!}</span>
@else
    <span>{{ $slot }}</span>
@endif
