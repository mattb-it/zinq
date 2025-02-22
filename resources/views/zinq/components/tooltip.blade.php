@props([
    'text' => '',
    'position' => 'top'
])

<div
    x-data="tooltipComponent('{{ $text }}', '{{ $position }}')"
    @mouseover="calculatePosition"
    @mouseover.away="hide"
    {{ $attributes->merge(['class' => 'relative inline-block group']) }}
>
    {{ $slot }}

    <div
        x-show="isVisible"
        x-transition
        x-ref="tooltip"
        class="zinq-tooltip"
        :class="{
            'invisible': !isVisible,
            'opacity-0': !isVisible,
            'opacity-100': isVisible
        }"
        style="display: none;"
    >
        {{ $text }}
    </div>
</div>
