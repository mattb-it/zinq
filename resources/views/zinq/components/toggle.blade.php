@aware(['split'])
@props([
    'label' => null,
    'on' => false,
    'offLabel' => null,
    'id' => null,
    'size' => null,
    'attribute' => null,
    'error' => null,
    'livewireReload' => true,
    'inline' => false,
])
@php
    $id = $id ?? uniqid('toggle-');

    if (!$attribute && $attributes->get('wire:model')) {
        $attribute = $attributes->get('wire:model');
    }

    if (!$offLabel && $slot->isNotEmpty()) {
        $offLabel = $slot;
    }

    $class = 'zinq-toggle';
    if ($size === 'sm') {
        $class .= ' sm';
    } elseif ($size === 'lg') {
        $class .= ' lg';
    }

    if ($livewireReload && $attributes->has('wire:model.live')) {
        $livewireReload = false;
    }
@endphp
<x-zinq::form.slot :error="$error" :attribute="$attribute" :label="$label" :for="$id" :inline="$inline">
    <div
        @if ($livewireReload) wire:key="{{ $id }}" @endif
        x-data="{
            @if ($attributes->get('wire:model.live'))
            isOn: $wire.entangle('{{ $attributes->get('wire:model.live') }}').live,
            @elseif ($attributes->has('wire:model'))
            isOn: $wire.$get('{{ $attributes->get('wire:model') }}'),
            @else
            isOn: {{ is_bool($on) ? ($on ? 'true' : 'false') : 'false' }},
            @endif
            init() {
                Alpine.store('zinq_toggles', Alpine.store('zinq_toggles') || {});
                Alpine.store('zinq_toggles')[`{{ $id }}`] = this;

                @if ($attributes->has('wire:model'))
                this.$watch('$store.zinq_toggles[`{{ $id }}`].isOn', (value) => {
                    $wire.{{ $attributes->get('wire:model') }} = value;
                });
                @endif
            }
        }"
        class="{{ $slot->isNotEmpty() ? 'flex items-center' : '' }}"
    >
        <button
            @click="isOn = !isOn"
            type="button"
            :class="isOn ? 'zinq-toggle-on' : 'zinq-toggle-off'"
            class="{{ $class }} {{ ($attribute && $errors->has($attribute)) || $error ? 'zinq-toggle-error' : '' }}"
        >
              <span
                  :class="isOn ? 'translate-x-5' : 'translate-x-0'"
                  class="zinq-toggle-toggle"
              >
                <span
                    :class="isOn ? 'opacity-0 duration-100 ease-out' : 'opacity-100 duration-200 ease-in'"
                    class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity"
                >
                  <svg class="text-gray-400" fill="none" viewBox="0 0 12 12">
                    <path d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </span>
                <span
                    :class="isOn ? 'opacity-100 duration-200 ease-in' : 'opacity-0 duration-100 ease-out'"
                    class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity"
                >
                  <svg class="text-[#F97316]" fill="currentColor" viewBox="0 0 12 12">
                    <path d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z"/>
                  </svg>
                </span>
              </span>
        </button>
        @if ($slot->isNotEmpty())
            <span @click="isOn = !isOn" >
                <x-zinq::label for="{{ $id }}" class="zinq-toggle-label ml-1.5" :sm="$size === 'sm'">
                    <span x-text="isOn ? '{{ strip_tags($slot) }}' : '{{ strip_tags($offLabel) }}'"></span>
                </x-zinq::label>
            </span>
        @endif
    </div>
</x-zinq::form.slot>
