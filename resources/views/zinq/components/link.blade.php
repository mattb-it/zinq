@props([
    'loading' => null,
    'disabled' => false,
    'icon' => null,
    'primary' => false, 'bare' => false, 'neutral' => false,
    'block' => false,
    'xl' => false, 'lg' => false, 'sm' => false, 'xs' => false,
])
@php
    $class = 'zinq-link';
    if ($primary) {
        $class .= ' primary';
    } elseif ($bare) {
        $class .= ' bare';
    } elseif ($neutral) {
        $class .= ' neutral';
    } else {
        $class .= ' default';
    }

    if ($xl) {
        $class .= ' xl';
    } elseif ($lg) {
        $class .= ' lg';
    } elseif ($sm) {
        $class .= ' sm';
    } elseif ($xs) {
        $class .= ' xs';
    }

    if ($block) {
        $class .= ' block';
    }

    $attributesToMerge = [
        'x-data' => '{ redirecting: false }',
        'x-bind:disabled' => 'redirecting || ' . ($disabled ? 'true' : 'false'),
        'class' => $class,
    ];

    if ($loading) {
        $attributesToMerge['@click'] = 'if (redirecting || ' . ($disabled ? 'true' : 'false') . ') { $event.stopPropagation(); } redirecting = true';
    }
@endphp
<a {{ $attributes->merge($attributesToMerge) }}>
    <span
        x-show="!redirecting"
        @if ($icon) class="flex flex-row items-center space-x-2" @endif
    >
        {{ $slot }}
        @if ($icon) <span>{{ $icon }}</span> @endif
    </span>
    <span :class="{ 'hidden': !redirecting }" x-show="redirecting" class="hidden">
        <span class="flex items-center space-x-2">
            <svg class="zinq-click-loader" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
            </svg>
            <span>@if (is_string($loading)) {{ $loading }} @else Processing... @endif</span>
        </span>
    </span>
</a>
