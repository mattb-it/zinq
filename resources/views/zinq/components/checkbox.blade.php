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

    // Base checkbox classes
    $checkboxClasses = 'transition-all duration-200 flex items-center justify-center rounded focus:ring-2 focus:outline-hidden focus:ring-offset-2 focus:ring-(color:--primary) dark:focus:ring-offset-(color:--gray-800) bg-white dark:bg-(color:--gray-800) border border-zinc-300 dark:border-zinc-700';

    // Size variations
    if ($size === 'lg') {
        $checkboxClasses .= ' w-7 h-7';
    } elseif ($size === 'sm') {
        $checkboxClasses .= ' w-5 h-5 focus:ring-1';
    } else {
        $checkboxClasses .= ' w-6 h-6';
    }

    // Error state
    if ($error || (isset($errors) && $attribute && $errors->has($attribute))) {
        $checkboxClasses .= ' border-red-700';
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
                :class="checked ? 'border-white dark:border-(color:--primary) bg-(color:--primary) dark:bg-(color:--primary-darker)' : ''"
                class="{{ $checkboxClasses }} @if (!$disabled) focus cursor-pointer @else cursor-not-allowed @endif"
            >
                <svg x-show="checked" :class="{ 'hidden': !checked }" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="currentColor" class="hidden absolute size-4 text-white dark:text-(color:--gray-800)">
                    <rect width="16" height="16" id="icon-bound" fill="none" />
                    <path d="M2,9.014L3.414,7.6L6.004,10.189L12.593,3.6L14.007,5.014L6.003,13.017L2,9.014Z" />
                </svg>
            </div>
            <div class="ml-2" @click="if (!{{ $disabled ? 'true' : 'false' }}) checked = !checked;">
                @if (\Illuminate\Support\Str::startsWith($slot, '<'))
                    {!! $slot !!}
                @else
                    <x-zinq::label for="{{ $id }}" class="text-base" :sm="$size === 'sm'">{{ $slot }}</x-zinq::label>
                @endif
            </div>
        </div>
    </div>
</x-zinq::form.slot>
