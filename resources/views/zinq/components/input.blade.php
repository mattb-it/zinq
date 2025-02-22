@props([
    'attribute' => null,
    'solo' => false,
    'size' => null,
    'block' => false,
    'focus' => false,
    'error' => null,
    'label' => null,
    'id' => null,
    'inline' => false,
])
@php
    $id = $id ?? uniqid('input-');

    if (!$attribute && $attributes->get('wire:model')) {
        $attribute = $attributes->get('wire:model');
    }

    $class = 'zinq-input';
    if ($error || (isset($errors) && $attribute && $errors->has($attribute))) {
        $class .= ' zinq-input-error';
    }

    if ($solo) {
        $class .= ' solo';
    }

    if ($block) {
        $class .= ' block';
    }

    if ($size === 'lg') {
        $class .= ' lg';
    } elseif ($size === 'sm') {
        $class .= ' sm';
    }

    $attributesToMerge = [
        'id' => $id,
        'type' => 'text',
        'class' => $class,
    ];

    if ($focus) {
        $attributesToMerge['autofocus'] = true;
        $attributesToMerge['x-data'] = '';
        $attributesToMerge['x-init'] = '$nextTick(() => $el.focus())';
    }
@endphp
<x-zinq::form.slot :error="$error" :attribute="$attribute" :block="$block" :label="$label" :for="$id" :inline="$inline">
    <input {{ $attributes->merge($attributesToMerge) }} />
</x-zinq::form.slot>
