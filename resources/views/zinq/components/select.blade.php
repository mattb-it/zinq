@props([
    'placeholder' => 'Choose option',
    'label' => null,
    'block' => true,
    'selected' => false,
    'id' => null,
    'attribute' => null,
    'error' => null,
    'inline' => false,
])
@php
    $id = $id ?? uniqid('select-');

    if (!$attribute && $attributes->has('wire:model')) {
        $attribute = $attributes->get('wire:model');
    }

    $class = 'zinq-select zinq-input';
    if ($error || (isset($errors) && $attribute && $errors->has($attribute))) {
        $class .= ' zinq-input-error';
    }
@endphp
<x-zinq::form.slot :error="$error" :attribute="$attribute" :block="$block" :label="$label" :for="$id" :inline="$inline">
    <div
        wire:key="{{ $id }}"
        x-data="{
            open: false,
            options: [],
            @if ($attributes->get('wire:model.live'))
            selected: $wire.entangle('{{ $attributes->get('wire:model.live') }}').live,
            @elseif ($attributes->has('wire:model'))
            selected: $wire.$get('{{ $attributes->get('wire:model') }}'),
            @else
            selected: {{ is_bool($selected) || is_null($selected) ? 'null' : "'$selected'" }},
            @endif
            label: '{{ $placeholder }}',
            init() {
                Alpine.store('zinq_selects', Alpine.store('zinq_selects') || {});
                Alpine.store('zinq_selects')[`{{ $id }}`] = this;

                this.$watch('$store.zinq_selects[`{{ $id }}`].selected', (value) => {
                    this.label = this.getOption(value)?.label || '{{ $placeholder }}';
                    @if ($attributes->has('wire:model'))
                    $wire.{{ $attributes->get('wire:model') }} = value;
                    @endif
                });
            },
            getOption(value) {
                return this.options.find((option) => option.value === value);
            }
        }"
        x-effect="label = selected ? getOption(selected)?.label : '{{ $placeholder }}'"
        {{ $attributes->merge(['class' => 'relative' . ($block ? ' w-full' : '')]) }}
    >
        <button
            @click.prevent="open = !open"
            class="{{ $class }} @if ($block) block @endif"
        >
            <div class="w-full flex items-center justify-between gap-2">
                <span
                    x-text="label"
                    class="text-zinc-500"
                    :class="{'text-zinc-800 dark:text-zinc-200': selected}"
                ></span>
                <svg
                    class="w-5 h-5 text-zinc-300"
                    :class="{'rotate-180': open}"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </button>

        <div
            x-show="open"
            @click.away="open = false"
            class="absolute mt-1 w-full max-w-md bg-white dark:bg-zinc-800 rounded-md shadow-lg py-1 z-50 hidden"
            :class="{'hidden': !open}"
        >
            {!! $slot !!}
        </div>
    </div>
</x-zinq::form.slot>
