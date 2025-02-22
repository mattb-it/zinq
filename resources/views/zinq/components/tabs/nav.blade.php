@props(['variant' => 'default'])
@php
    $id = 'tabs-' . uniqid();

    $class = 'zinq-tabs-nav';
    if ($variant == 'bordered') {
        $class .= ' zinq-tabs-bordered';
    } elseif ($variant == 'pill') {
        $class .= ' zinq-tabs-pill';
    }
@endphp
<nav {{ $attributes->merge(['class' => $class]) }}>
    {!! $slot !!}
    <zinq:dropdown class="zinq-tabs-dropdown hidden" data-zinq-dropdown="{{ $id }}">
        <x-slot name="trigger">
            <zinq:button bare xs>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd" d="M10.5 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Zm0 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Zm0 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" clip-rule="evenodd" />
                </svg>
            </zinq:button>
        </x-slot>
    </zinq:dropdown>
</nav>
