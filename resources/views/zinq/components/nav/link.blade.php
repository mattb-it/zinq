@props([
    'href' => '#',
    'route' => null,
    'routePatterns' => null,
    'icon' => false,
    'active' => false,
])
@php
    if (is_string($route)) {
        $href = route($route);
        $active = request()->routeIs($routePatterns ?? $route);
    }
@endphp
<li @if ($active) class="active" @endif>
    <a href="{{ $href }}" {{ $attributes->merge() }}>
        @if ($icon)
            <span class="w-full flex flex-row items-center space-x-2">
                {{ $slot }}
                <span>{{ $icon }}</span>
            </span>
        @else
            {{ $slot }}
        @endif
    </a>
</li>
