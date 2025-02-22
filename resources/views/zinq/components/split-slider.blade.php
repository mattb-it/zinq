<div
    x-data="{
        position: 50,
        isDragging: false,
        startX: 0,
        startPosition: 0,
        containerWidth: 0,
        init() {
          this.containerWidth = this.$refs.container.offsetWidth;
        }
      }"
    @mousedown.self="
        isDragging = true;
        startX = $event.clientX;
        startPosition = position;
      "
    @touchstart.self="
        isDragging = true;
        startX = $event.touches[0].clientX;
        startPosition = position;
      "
    @mousemove.window="
        if (!isDragging) return;
        let delta = $event.clientX - startX;
        position = Math.max(0, Math.min(100, startPosition + (delta / containerWidth * 100)));
      "
    @touchmove.window.prevent="
        if (!isDragging) return;
        let delta = $event.touches[0].clientX - startX;
        position = Math.max(0, Math.min(100, startPosition + (delta / containerWidth * 100)));
      "
    @mouseup.window="isDragging = false"
    @touchend.window="isDragging = false"
    class="relative w-full max-w-2xl mx-auto m-0!"
>
    <div
        x-ref="container"
        class="relative h-[200px] bg-white rounded-lg shadow-lg overflow-hidden"
    >
        <div class="absolute inset-0 flex">
            <!-- Left Content -->
            <div
                class="h-full bg-white transition-all duration-75 overflow-hidden"
                :style="'width: ' + position + '%'"
            >
                <div class="h-full flex items-center justify-center light-mode light">
                    {!! $lightMode !!}
                </div>
            </div>

            <!-- Right Content -->
            <div
                class="h-full bg-zinc-800 transition-all duration-75 overflow-hidden"
                :style="'width: ' + (100 - position) + '%'"
            >
                <div class="h-full flex items-center justify-center dark-mode dark">
                    {!! $darkMode !!}
                </div>
            </div>
        </div>

        <!-- Slider Handle -->
        <div
            class="absolute top-0 bottom-0 w-1 bg-white cursor-ew-resize z-10"
            :style="'left: ' + position + '%'"
            @mousedown.stop="
            isDragging = true;
            startX = $event.clientX;
            startPosition = position;
          "
            @touchstart.stop="
            isDragging = true;
            startX = $event.touches[0].clientX;
            startPosition = position;
          "
        >
            <div class="absolute top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2 w-8 h-8 bg-white rounded-full shadow-lg flex items-center justify-center">
                <div class="w-1 h-4 bg-gray-400 rounded-full"></div>
            </div>
        </div>
    </div>
</div>
