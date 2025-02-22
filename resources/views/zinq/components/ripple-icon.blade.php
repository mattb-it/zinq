<div {{ $attributes->merge(['class' => 'relative inline-flex']) }}>
    <div class="absolute inset-0 m-0">
        <div class="zinq-circle-ripple"></div>
        <div class="zinq-circle-ripple"></div>
        <div class="zinq-circle-ripple"></div>
        <div class="zinq-circle-ripple"></div>
        <div class="zinq-circle-ripple"></div>
        <div class="zinq-circle-ripple"></div>
    </div>
    <div class="relative p-4 bg-zinc-100 dark:bg-zinc-800 rounded-full shadow-lg">
        {{ $slot }}
    </div>
</div>
