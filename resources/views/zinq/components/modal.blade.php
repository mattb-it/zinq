@props(['id', 'title' => null, 'open' => false, 'focusInput' => null])
<div x-data="{
        isOpen: {{ $open === true ? 'true' : 'false' }},
        focusInput() {
            this.$nextTick(() => {
                if (this.isOpen && {{ $focusInput === null ? 'false' : 'true' }}) {
                    const input = document.getElementById('{{ $focusInput }}');
                    if (input) {
                        input.focus();
                    }
                }
            });
        }
    }"
     x-show="isOpen"
     @keydown.window.escape="isOpen = false"
     id="{{ $id }}"
     @open-modal.window="if ($event.detail === '{{ $id }}' || $event.detail[0] === '{{ $id }}') { isOpen = true; focusInput(); }"
     @close-modal.window="if ($event.detail === '{{ $id }}' || $event.detail[0] === '{{ $id }}') { isOpen = false; }"
     x-cloak
     class="fixed inset-0 flex items-center justify-center bg-black/20 dark:bg-black/50 zinq-backdrop-pixelate z-50">
    <div @click.away="isOpen = false" class="bg-white dark:bg-(color:--gray-900) rounded-md py-4 px-6 max-w-(--breakpoint-sm) w-full border border-white shadow-[2px_2px_0px_0px_var(--gray-700)] dark:shadow-[2px_2px_0px_0px_var(--gray-700)] dark:border-(color:--gray-800)">
        <!-- Modal Header -->
        <div class="flex justify-between items-center">
            @if ($title) <h3 class="zinq-modal-heading text-lg font-semibold text-gray-900 dark:text-(color:--gray-300)">{{ $title }}</h3> @endif
            <button @click.prevent="isOpen = false" class="text-(color:--gray-700) dark:text-(color:--gray-500) hover:text-(color:--yellow) ring-focus rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="mt-4">
            {{ $slot }}
        </div>
    </div>
</div>
