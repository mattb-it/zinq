<div
    x-data="{
        activeTab: null,
        tabs: [],
        contents: [],
        registerTab(el) {
            this.tabs.push(el);
            this.setDefaultActiveTab();
        },
        registerContent(el) {
            this.contents.push(el);
        },
        setDefaultActiveTab() {
            if (this.activeTab === null && this.tabs.length > 0) {
                this.activeTab = 0;
            }
        },
        isActiveTab(index) {
            return this.activeTab === index;
        }
    }"
    x-init="setDefaultActiveTab()"
    {{ $attributes }}
>
    {!! $slot !!}
</div>

