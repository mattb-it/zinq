@props(['color' => 'bg-lime-800'])
<span {{ $attributes->merge(['class' => $color . ' uppercase inline-flex rounded-full size-6 text-sm text-white font-medium items-center justify-center']) }}>{{ $slot }}</span>
