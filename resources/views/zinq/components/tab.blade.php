@props(['icon' => null, 'badge' => null, 'href' => null])
<a
    href="{{ $href ?: '#' }}"
    x-init="$el.dataset.index = tabs.length; registerTab($el);"
    @if (!$href) @click.prevent="activeTab = parseInt($el.dataset.index)" @endif
    :class="{
        'zinq-active-tab': isActiveTab(parseInt($el.dataset.index)),
    }"
    class="zinq-tab"
>
    @if ($icon) <span class="flex justify-center items-center space-x-1.5"> @endif
    {!! $slot !!}
    @if ($icon) <span>{{ $icon }}</span>  @endif
    @if ($badge !== null) <zinq:badge rounded tab>{{ $badge }}</zinq:badge> @endif
    @if ($icon) </span> @endif
</a>
