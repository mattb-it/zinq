@props([
    'for' => null,
    'label' => false,
    'block' => false,
    'attribute' => null,
    'error' => null,
    'inline' => false,
])
@php
    $containerClass = 'zinq-field';
    if ($block) {
        $containerClass .= ' w-full';
    }

    if ($inline) {
        $containerClass .= ' zinq-field-split';
    } else {
        $containerClass .= ' flex flex-col';
    }
@endphp
<div {{ $attributes->merge(['class' => $containerClass]) }}>
    @if ($label)
        <x-zinq::label for="{{ $for }}">{{ $label }}</x-zinq::label>
    @elseif ($inline)
        <div></div>
    @endif
    @if ($inline)
        <div class="grid">
    @endif
    {!! $slot !!}
    @if ($attribute)
        @error($attribute) <x-zinq::form.input-help error>{{ $message }}</x-zinq::form.input-help> @enderror
    @elseif ($error)
        <x-zinq::form.input-help error>{{ $error }}</x-zinq::form.input-help>
    @endif
    @if ($inline)
        </div>
    @endif
</div>
