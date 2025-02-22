@props(['sm' => false, 'smLinks' => false])
@php
$class = '';
if ($sm) {
    $class .= ' sm';
}

if ($smLinks) {
    $class .= ' sm-links';
}
@endphp
<div class="relative zinq-dropdown-container {{ $attributes->get('class') }}" data-zinq-dropdown="{{ $attributes->get('data-zinq-dropdown') }}">
    <div class="flex items-center" x-ref="trigger">
        {{ $trigger }}
    </div>

    <div
        x-cloak
        x-ref="dropdown"
        class="{{ "zinq-dropdown $class" }}"
        id="{{ $attributes->get('data-zinq-dropdown') }}"
    >
        <ul class="flex flex-col items-center space-y-0.5">
            {{ $slot }}
        </ul>
    </div>
</div>
