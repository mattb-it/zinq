@props(['src', 'alt' => 'Avatar'])
<img src="{{ $src }}" alt="{{ $alt }}" {{ $attributes->merge(['class' => 'rounded-full size-6']) }} />
