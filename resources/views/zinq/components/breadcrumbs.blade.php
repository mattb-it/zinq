@props([
    'back' => null,
    'home' => null,
    'navigate' => false,
])
<nav {{ $attributes->merge(['class' => 'flex items-center space-x-1 text-sm rounded-3xl p-1 pr-3 w-fit']) }}>
    @if ($back)
    <a href="{{ $back }}" class="bg-none p-1 bg-zinc-200 dark:bg-zinc-900 rounded-full hover:bg-zinc-300 dark:hover:bg-zinc-700 text-zinc-600 dark:text-zinc-400 hover:text-zinc-950 dark:hover:text-white" {{ $navigate ?? ' wire:navigate' }}>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
    </a>
    @endif
    <div class="flex flex-wrap items-center space-x-2 text-sm">
        @if ($home)
        <zinq:breadcrumbs.link href="{{ $home }}" :navigate="$navigate">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                <path d="M8.543 2.232a.75.75 0 0 0-1.085 0l-5.25 5.5A.75.75 0 0 0 2.75 9H4v4a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 1 1 2 0v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V9h1.25a.75.75 0 0 0 .543-1.268l-5.25-5.5Z" />
            </svg>
        </zinq:breadcrumbs.link>
        @endif
        {!! $slot !!}
    </div>
</nav>
