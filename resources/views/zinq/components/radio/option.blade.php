@aware(['size'])
@props([
    'value',
    'id' => null,
    'size' => null,
])
@php
    $id = $id ?? uniqid('radio-option-');

    $class = 'zinq-radio';
    if ($size === 'sm') {
        $class .= ' sm';
    } elseif ($size === 'lg') {
        $class .= ' lg';
    }
@endphp
<div @click="updateValue({{ is_bool($value) || is_null($value) ? 'null' : "'$value'" }})"
     class="flex items-center cursor-pointer">
    <div id="{{ $id }}" class="{{ $class }}"
         :class="{ 'selected': value === {{ is_bool($value) || is_null($value) ? 'null' : "'$value'" }} }">
    </div>
    <x-zinq::label for="{{ $id }}" class="zinq-radio-label" :sm="$size === 'sm'">{{ $slot }}</x-zinq::label>
</div>
