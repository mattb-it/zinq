@props(['action'])
<form {{ $attributes->merge(['class' => 'zinq-form', 'wire:submit' => $action]) }}>
    {!! $slot !!}
</form>
