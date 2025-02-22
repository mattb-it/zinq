@props([
    'value' => null,
    'inline' => false,
    'id' => null,
    'attribute' => null,
    'error' => null,
    'label' => null,
    'size' => null,
    'slotInline' => false,
])
@php
    $id = $id ?? uniqid('radio-');

    if (!$attribute && $attributes->has('wire:model')) {
        $attribute = $attributes->get('wire:model');
    }
@endphp
<x-zinq::form.slot :error="$error" :attribute="$attribute" :label="$label" :for="$id" class="{{ $attributes->get('class') }}" :inline="$slotInline">
    <div
        wire:key="{{ $id }}"
        @if ($inline) class="inline-flex space-x-6 items-center" @endif
        @if (!$inline) class="flex flex-col gap-1" @endif
        x-data="{
            @if ($attributes->get('wire:model.live'))
            value: $wire.entangle('{{ $attributes->get('wire:model.live') }}').live,
            @elseif ($attributes->has('wire:model'))
            value: $wire.$get('{{ $attributes->get('wire:model') }}'),
            @else
            value: {{ is_bool($value) || is_null($value) ? 'null' : "'$value'" }},
            @endif
            init() {
                Alpine.store('zinq_radio', Alpine.store('zinq_radio') || {});
                Alpine.store('zinq_radio')[`{{ $id }}`] = this;

                @if ($attributes->has('wire:model'))
                this.$watch('$store.zinq_radio[`{{ $id }}`].value', (value) => {
                    $wire.{{ $attributes->get('wire:model') }} = value;
                });
                @endif
            },
            updateValue(newValue) {
                this.value = newValue;
            }
        }"
        {{ $attributes }}
    >
        {{ $slot }}
    </div>
</x-zinq::form.slot>
