@props([
    'placeholder' => 'Choose option',
    'label' => null,
    'block' => true,
    'selected' => false,
    'id' => null,
    'attribute' => null,
    'error' => null,
    'inline' => false,
    'search' => false,
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
            filteredOptions: [],
            searchQuery: '',
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
                this.filteredOptions = this.options;

                this.$watch('$store.zinq_selects[`{{ $id }}`].selected', (value) => {
                    this.label = this.getOption(value)?.label || '{{ $placeholder }}';
                    @if ($attributes->has('wire:model'))
                    $wire.{{ $attributes->get('wire:model') }} = value;
                    @endif
                });

                this.$watch('searchQuery', (value) => {
                    this.filterOptions();
                });

                this.$watch('options', () => {
                    this.filteredOptions = this.options;
                    this.filterOptions();
                });

                this.$watch('open', (isOpen) => {
                    if (!isOpen) {
                        this.searchQuery = '';
                        this.filteredOptions = this.options;
                    }
                });
            },
            getOption(value) {
                return this.options.find((option) => option.value === value);
            },
            filterOptions() {
                if (!this.searchQuery) {
                    this.filteredOptions = this.options;
                    return;
                }
                const query = this.searchQuery.toLowerCase();
                this.filteredOptions = this.options.filter(option =>
                    option.label.toLowerCase().includes(query)
                );
            },
            clearSearch() {
                this.searchQuery = '';
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
            class="absolute mt-1 w-full bg-white dark:bg-zinc-800 rounded-md shadow-lg z-50 hidden"
            :class="{'hidden': !open}"
        >
            @if ($search)
                <div class="p-2 border-b border-zinc-200 dark:border-zinc-700">
                    <zinq:input
                        x-model="searchQuery"
                        @click.stop
                        @keydown.escape="clearSearch()"
                        type="text"
                        placeholder="Search..."
                    />
                </div>
            @endif
            <div class="py-1">
                {!! $slot !!}
                @if ($search)
                    <div x-show="searchQuery && filteredOptions.length === 0" class="px-4 py-3 text-sm text-zinc-500 dark:text-zinc-400 text-center">
                        No results found
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-zinq::form.slot>
