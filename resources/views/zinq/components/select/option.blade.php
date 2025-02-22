@props(['value' => null])
@php
    if (!$value) {
        $value = strip_tags($slot->toHtml());
        $label = $value;
    } else {
        $label = strip_tags($slot->toHtml());
    }
@endphp
<button
    x-init="options.push({ value: '{{ $value }}', label: '{{ $label }}' })"
    @click.prevent="selected = {{ is_null($value) ? 'null' : "'$value'" }}; open = false"
    class="w-full px-4 py-2 text-left select-none text-sm text-zinc-700 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-900 flex items-center gap-2"
>
    {!! $slot !!}
</button>
