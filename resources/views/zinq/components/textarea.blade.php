@props([
    'id' => null,
    'attribute' => null,
    'lg' => false,
    'focus' => false,
    'error' => null,
    'block' => true,
    'size' => null,
    'label' => null,
    'inline' => false,
])
@php
    $id = $id ?? uniqid('textarea-');

    if (!$attribute && $attributes->has('wire:model') && $attributes->get('wire:model')) {
        $attribute = $attributes->get('wire:model');
    }

    $class = 'zinq-input';
    if ($error || (isset($errors) && $attribute && $errors->has($attribute))) {
        $class .= ' zinq-input-error';
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
        'type' => 'text',
        'class' => $class,
        'id' => $id,
    ];

    if ($focus) {
        $attributesToMerge['autofocus'] = true;
        $attributesToMerge['x-data'] = '';
        $attributesToMerge['x-init'] = '$nextTick(() => $el.focus())';
    }
@endphp
<x-zinq::form.slot :error="$error" :attribute="$attribute" :block="$block" :label="$label" :for="$id" :inline="$inline">
    <textarea {{ $attributes->merge($attributesToMerge) }}></textarea>
</x-zinq::form.slot>
