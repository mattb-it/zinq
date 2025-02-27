@aware(['emerald', 'fuchsia', 'yellow', 'inverse'])
@php
    $separatorClass = 'my-6';
    $linkClass = 'inline-flex items-center rounded-lg px-1.5 bg-zinc-800! dark:bg-zinc-200! drop-shadow-lg';
    $svgClass = 'fill-zinc-50 dark:fill-zinc-950 size-5 my-1.5';

    // Handle different card types
    if ($emerald) {
        $separatorClass = 'my-6 border-emerald-400/70! dark:border-emerald-700!';
    } elseif ($fuchsia) {
        $separatorClass = 'my-6 border-fuchsia-400/70! dark:border-fuchsia-800!';
    } elseif ($yellow) {
        $separatorClass = 'my-6 border-yellow-400/70! dark:border-yellow-800!';
    } elseif ($inverse) {
        $separatorClass = 'my-6 border-zinc-800! dark:border-zinc-200!';
        $linkClass = 'inline-flex items-center rounded-lg px-1.5 bg-white! dark:bg-black! drop-shadow-lg';
        $svgClass = 'fill-zinc-950 dark:fill-zinc-50 size-5 my-1.5';
    }
@endphp

<hr class="{{ $separatorClass }}" />
<div class="w-full flex justify-end">
    <a href="#" class="{{ $linkClass }} hover:bg-zinc-950! hover:dark:bg-zinc-400!" style="background-image: none !important;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="{{ $svgClass }}">
            <path fill-rule="evenodd" d="M12.97 3.97a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 1 1-1.06-1.06l6.22-6.22H3a.75.75 0 0 1 0-1.5h16.19l-6.22-6.22a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
        </svg>
    </a>
</div>
