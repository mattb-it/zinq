@props(['sm' => true])
<label {{ $attributes->merge(['class' => 'zinq-label ' . ($sm ? 'zinq-label-sm' : '')]) }}>
    {!! $slot !!}
</label>
