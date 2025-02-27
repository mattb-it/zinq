@props([
    'sm' => false,
    'rounded' => false,
    'primary' => false, 'success' => false, 'warning' => false, 'danger' => false, 'info' => false, 'tab' => false, 'inverse' => false, 'default' => true,
])
@php
    $baseClasses = 'rounded-md px-2 py-1 text-xs font-medium';
    
    // Size classes
    if ($sm) {
        $baseClasses .= ' px-1 py-0.5 text-[0.65rem]';
    }
    
    // Border radius
    if ($rounded) {
        $baseClasses .= ' rounded-full';
    }
    
    // Color variants
    if ($success) {
        $baseClasses .= ' text-lime-800 dark:text-lime-100 bg-lime-300 dark:bg-lime-800 border border-lime-400 dark:border-lime-700';
    } elseif ($warning) {
        $baseClasses .= ' text-yellow-700 dark:text-yellow-100 bg-yellow-300 dark:bg-yellow-800 border border-yellow-400 dark:border-yellow-700';
    } elseif ($danger) {
        $baseClasses .= ' text-red-700 dark:text-rose-100 bg-rose-300 dark:bg-rose-800 border border-rose-400 dark:border-rose-700';
    } elseif ($info) {
        $baseClasses .= ' text-blue-800 dark:text-blue-100 bg-blue-300 dark:bg-blue-800 border border-blue-400 dark:border-blue-700';
    } elseif ($primary) {
        $baseClasses .= ' text-black bg-[color:var(--primary)] dark:bg-[color:var(--primary-darker)] border border-[color:var(--primary-darker)] dark:border-[color:var(--primary)]';
    } elseif ($inverse) {
        $baseClasses .= ' text-white dark:text-black border border-black dark:border-white bg-zinc-950 dark:bg-zinc-50';
    } elseif ($tab) {
        $baseClasses .= ' text-zinc-500 dark:text-zinc-300 bg-zinc-100 dark:bg-zinc-700';
    } elseif ($default) {
        $baseClasses .= ' text-[color:var(--gray-700)] dark:text-[color:var(--gray-200)] bg-white dark:bg-[color:var(--gray-800)] border border-[color:var(--gray-300)] dark:border-[color:var(--gray-700)]';
    }
@endphp
<span {{ $attributes->merge(['class' => $baseClasses]) }}>
    {{ $slot }}
</span>
