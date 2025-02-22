<div
    x-init="$el.dataset.index = contents.length; registerContent($el);"
    x-show="isActiveTab(parseInt($el.dataset.index))"
    x-cloak
    x-transition
>
    {{ $slot }}
</div>
