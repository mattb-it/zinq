@props(['href' => null, 'sm' => false, 'icon' => null, 'route' => null, 'closeOnClick' => false])
@php
    $class = '';
    if ($sm) {
        $class .= ' sm';
    }

    $attributesToMerge = [
        'class' => "zinq-dropdown-link $class",
    ];

    if (is_string($route)) {
        $href = route($route);
    }

    if ($href) {
        $attributesToMerge['href'] = $href;
    }
@endphp
<li class="w-full">
    @if ($href)
        <a {{ $attributes->merge($attributesToMerge) }}>
            @if ($icon) <span class="w-full flex flex-row space-x-2 items-center"> @endif
            {{ $slot }}
            @if ($icon) <span>{{ $icon }}</span> @endif
            @if ($icon) </span> @endif
        </a>
    @else
        @if ($closeOnClick) <div data-zinq-dropdown-close> @endif
        {!! $slot !!}
        @if ($closeOnClick) </div> @endif
    @endif
</li>
