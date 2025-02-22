@aware(['attribute'])
@props([
    'id' => null,
    'checked' => false,
    'value' => 'true',
    'disabled' => false,
    'size' => null,
    'attribute' => null,
    'error' => null,
    'label' => null,
    'slotInline' => false,
])
@php
    $id = $id ?? uniqid('checkbox-');

    if (!$attribute && $attributes->get('wire:model')) {
        $attribute = $attributes->get('wire:model');
    }

    $class = 'zinq-checkbox ';
    if ($error || (isset($errors) && $attribute && $errors->has($attribute))) {
        $class .= ' zinq-checkbox-error';
    }

    if ($size === 'lg') {
        $class .= ' lg';
    } elseif ($size === 'sm') {
        $class .= ' sm';
    }
@endphp
<x-zinq::form.slot :error="$error" :attribute="$attribute" :block="false" :label="$label" :for="$id" :inline="$slotInline">
    <div class="block">
        <div
            wire:key="{{ $id }}"
            x-data="{
                @if ($attributes->get('wire:model.live'))
                checked: $wire.entangle('{{ $attributes->get('wire:model.live') }}').live,
                @elseif ($attributes->has('wire:model'))
                checked: $wire.$get('{{ $attributes->get('wire:model') }}'),
                @else
                checked: {{ $checked ? 'true' : 'false' }},
                @endif
                init() {
                    Alpine.store('zinq_checkboxes', Alpine.store('zinq_checkboxes') || {});
                    Alpine.store('zinq_checkboxes')[`{{ $id }}`] = this;

                    @if ($attributes->has('wire:model'))
                    this.$watch('$store.zinq_checkboxes[`{{ $id }}`].checked', (value) => {
                        $wire.{{ $attributes->get('wire:model') }} = value;
                    });
                    @endif
                }
            }"
            class="flex items-center"
            :class="{ 'opacity-50 cursor-not-allowed': {{ $disabled ? 'true' : 'false' }} }"
        >
            <div
                @click="if (!{{ $disabled ? 'true' : 'false' }}) checked = !checked"
                @keydown.space.prevent="if (!{{ $disabled ? 'true' : 'false' }}) checked = !checked"
                :class="checked ? 'zinq-checkbox-checked' : ''"
                class="{{ $class }} @if (!$disabled) focus cursor-pointer @else cursor-not-allowed @endif"
            >
                <svg x-show="checked" :class="{ 'hidden': !checked }" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="currentColor" class="hidden zinq-checkbox-tick">
                    <rect width="16" height="16" id="icon-bound" fill="none" />
                    <path d="M2,9.014L3.414,7.6L6.004,10.189L12.593,3.6L14.007,5.014L6.003,13.017L2,9.014Z" />
                </svg>
            </div>
            <div class="ml-2" @click="if (!{{ $disabled ? 'true' : 'false' }}) checked = !checked;">
                @if (\Illuminate\Support\Str::startsWith($slot, '<'))
                    {!! $slot !!}
                @else
                    <x-zinq::label for="{{ $id }}" class="zinq-checkbox-label" :sm="$size === 'sm'">{{ $slot }}</x-zinq::label>
                @endif
            </div>
        </div>
    </div>
</x-zinq::form.slot>
