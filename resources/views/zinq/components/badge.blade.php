@props([
    'sm' => false,
    'rounded' => false,
    'primary' => false, 'success' => false, 'warning' => false, 'danger' => false, 'info' => false, 'tab' => false, 'inverse' => false, 'default' => true,
])
@php
    $class = '';
    if ($success) {
        $class .= ' success';
    } elseif ($warning) {
        $class .= ' warning';
    } elseif ($danger) {
        $class .= ' danger';
    } elseif ($info) {
        $class .= ' info';
    } elseif ($primary) {
        $class .= ' primary';
    } elseif ($inverse) {
        $class .= ' inverse';
    } elseif ($tab) {
        $class .= ' tab';
    } elseif ($default) {
        $class .= ' default';
    }

    if ($rounded) {
        $class .= ' rounded-xs';
    }

    if ($sm) {
        $class .= ' sm';
    }
@endphp
<span {{ $attributes->merge(['class' => "zinq-badge $class"]) }}>
    {{ $slot }}
</span>
