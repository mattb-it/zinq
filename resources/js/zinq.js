document.addEventListener('alpine:init', () => {
    window.zinqDiffSlider = function(containerSelector, sliderSelector, darkModeSelector) {
        const container = document.querySelector(containerSelector);
        const slider = container.querySelector(sliderSelector);
        const darkMode = container.querySelector(darkModeSelector);

        let isDragging = false;

        function setupSlider() {
            const containerWidth = container.getBoundingClientRect().width - 4;
            const initialPosition = containerWidth / 2;

            slider.style.left = `${initialPosition}px`;
            darkMode.style.clipPath = `inset(0 ${containerWidth - initialPosition}px 0 0)`;
        }

        slider.addEventListener('pointerdown', (e) => {
            isDragging = true;
            e.preventDefault();
        });

        window.addEventListener('pointermove', (e) => {
            if (!isDragging) return;

            const containerRect = container.getBoundingClientRect();
            let offsetX = e.clientX - containerRect.left;

            let containerRectWidth = containerRect.width;
            containerRectWidth += 4;

            offsetX = Math.max(0, Math.min(offsetX, (containerRectWidth - 10)));
            if (offsetX < 4) {
                // Prevent the slider from going too far to the left
                offsetX = 4;
            }

            darkMode.style.clipPath = `inset(0 ${containerRect.width - offsetX}px 0 0)`;
            slider.style.left = `${offsetX - 4}px`;
        });

        window.addEventListener('pointerup', () => {
            isDragging = false;
        });

        window.addEventListener('load', setupSlider);
    }

    Alpine.data('tooltipComponent', (text, position) => ({
        isVisible: false,
        text: text,
        position: position,

        calculatePosition() {
            if (!text) return;

            this.isVisible = true;
            this.$nextTick(() => {
                const trigger = this.$el;
                const tooltip = this.$refs.tooltip;
                const triggerRect = trigger.getBoundingClientRect();
                const tooltipRect = tooltip.getBoundingClientRect();

                let top = 0, left = 0;

                switch (this.position) {
                    case 'top':
                        top = triggerRect.top - tooltipRect.height - 10;
                        left = triggerRect.left + (triggerRect.width / 2) - (tooltipRect.width / 2);
                        break;
                    case 'bottom':
                        top = triggerRect.bottom + 10;
                        left = triggerRect.left + (triggerRect.width / 2) - (tooltipRect.width / 2);
                        break;
                    case 'left':
                        top = triggerRect.top + (triggerRect.height / 2) - (tooltipRect.height / 2);
                        left = triggerRect.left - tooltipRect.width - 10;
                        break;
                    case 'right':
                        top = triggerRect.top + (triggerRect.height / 2) - (tooltipRect.height / 2);
                        left = triggerRect.right + 10;
                        break;
                }

                // Adjust position if tooltip goes out of viewport
                const windowWidth = window.innerWidth;
                const windowHeight = window.innerHeight;

                if (left + tooltipRect.width > windowWidth) {
                    left = windowWidth - tooltipRect.width - 10;
                }
                if (left < 0) {
                    left = 10;
                }

                if (top + tooltipRect.height > windowHeight) {
                    top = windowHeight - tooltipRect.height - 10;
                }
                if (top < 0) {
                    top = 10;
                }

                tooltip.style.top = `${top}px`;
                tooltip.style.left = `${left}px`;
            });
        },
        hide() {
            this.isVisible = false;
        }
    }));
});

const initTabs = () => {
    const navElements = document.querySelectorAll('nav.zinq-tabs-nav');

    navElements.forEach(nav => {
        const tabs = Array.from(nav.querySelectorAll('.zinq-tab'));
        const dropdownMenuTrigger = nav.querySelector('.zinq-tabs-dropdown');
        const dropdownMenuId = dropdownMenuTrigger.getAttribute('data-zinq-dropdown');
        const dropdownMenu = document.getElementById(dropdownMenuId);

        if (!dropdownMenu) return;

        dropdownMenu.innerHTML = '';

        const containerWidth = nav.parentNode.offsetWidth;
        const totalTabsWidth = nav.offsetWidth;

        if (totalTabsWidth > containerWidth) {
            let usedWidth = 30;

            // Remove hidden class from dropdownMenuTrigger
            dropdownMenuTrigger.classList.remove('hidden');

            tabs.forEach(tab => {
                usedWidth += tab.offsetWidth;

                if (usedWidth > containerWidth) {
                    const li = document.createElement('li');
                    li.className = 'w-full';

                    const a = document.createElement('a');
                    a.className = 'zinq-dropdown-link';
                    a.textContent = tab.textContent;

                    a.addEventListener('click', () => {
                        event.preventDefault();

                        tab.click();
                    });
                    dropdownMenu.appendChild(a);

                    tab.classList.add('hidden');
                } else {
                    tab.classList.remove('hidden');
                }
            });
        } else {
            tabs.forEach(tab => (tab.classList.remove('hidden')));
            dropdownMenu.innerHTML = '';
            dropdownMenuTrigger.classList.add('hidden');
        }
    });
};

initTabs();
window.addEventListener('resize', initTabs);

// Out of alpine:init, as alpine:init is not being called on Livewire navigate
initializeDropdowns();

document.addEventListener('livewire:navigated', () => {
    initializeDropdowns();
    initTabs();
    initializeColorPickers();
});

function initializeDropdowns() {
    document.querySelectorAll('.zinq-dropdown-container').forEach(container => {
        initializeDropdown(container);
    });
}
function initializeDropdown(container) {
    const trigger = container.querySelector('[x-ref="trigger"]');
    const dropdown = container.querySelector('[x-ref="dropdown"]');
    if (!trigger || !dropdown) return;

    let isOpen = false;
    let dropdownPosition = { x: 'left', y: 'bottom' };

    // Move dropdown to the end of the body
    document.body.appendChild(dropdown);
    dropdown.removeAttribute('x-cloak');
    dropdown.style.display = 'none';
    dropdown.style.position = 'absolute'; // Ensures proper positioning in the new location

    calculatePosition(true);
    observeTrigger();

    trigger.addEventListener('click', toggleDropdown);

    // Close dropdown if clicked outside
    document.addEventListener('click', (event) => {
        if (isOpen && !container.contains(event.target) && !dropdown.contains(event.target)) {
            closeDropdown();
        }
    });
    // Close dropdown if clicked on option with data-zinq-dropdown-close
    const closeOptions = dropdown.querySelectorAll('[data-zinq-dropdown-close]');
    if (closeOptions.length) {
        closeOptions.forEach(option => {
            option.addEventListener('click', closeDropdown);
        });
    }

    function toggleDropdown() {
        isOpen = !isOpen;
        dropdown.style.display = isOpen ? 'block' : 'none';
        if (isOpen) calculatePosition();
    }

    function closeDropdown() {
        isOpen = false;
        dropdown.style.display = 'none';
    }

    function calculatePosition(forceVisible = false) {
        if (forceVisible) dropdown.style.display = 'block';

        const triggerRect = trigger.getBoundingClientRect();
        const dropdownWidth = dropdown.offsetWidth;
        const dropdownHeight = dropdown.offsetHeight;

        if (forceVisible) dropdown.style.display = 'none';

        const canShowOnBottom = (window.innerHeight - triggerRect.bottom) > dropdownHeight;
        const canShowOnTop = triggerRect.top > dropdownHeight;
        const canShowOnRight = (window.innerWidth - triggerRect.right - 10) > dropdownWidth;
        const canShowOnLeft = triggerRect.left > dropdownWidth;

        if (canShowOnBottom) {
            dropdownPosition.y = 'bottom';
            dropdown.style.top = `${triggerRect.bottom + window.scrollY}px`;
        } else if (canShowOnTop) {
            dropdownPosition.y = 'top';
            dropdown.style.top = `${triggerRect.top - dropdownHeight + window.scrollY}px`;
        } else {
            dropdownPosition.y = 'bottom';
            dropdown.style.top = `${triggerRect.bottom + window.scrollY}px`;
        }

        if (canShowOnRight) {
            dropdownPosition.x = 'left';
            dropdown.style.left = `${triggerRect.left + window.scrollX}px`;
            dropdown.style.right = 'auto';
        } else if (canShowOnLeft) {
            dropdownPosition.x = 'right';
            dropdown.style.left = 'auto';
            dropdown.style.right = `${window.innerWidth - triggerRect.right - window.scrollX}px`;
        } else {
            dropdown.style.left = `${triggerRect.left + window.scrollX}px`;
            dropdown.style.right = 'auto';
        }

        dropdown.classList.toggle('top-full', dropdownPosition.y === 'bottom');
        dropdown.classList.toggle('bottom-full', dropdownPosition.y === 'top');
        dropdown.classList.toggle('left-0', dropdownPosition.x === 'left');
        dropdown.classList.toggle('right-0', dropdownPosition.x === 'right');
    }

    function observeTrigger() {
        window.addEventListener('resize', () => {
            calculatePosition();
            if (isElementHidden(trigger) && isOpen) {
                closeDropdown();
            }
        });
    }

    function isElementHidden(element) {
        const style = getComputedStyle(element);
        return (
            style.display === 'none' ||
            style.visibility === 'hidden' ||
            (element.offsetWidth === 0 && element.offsetHeight === 0) ||
            element.classList.contains('hidden')
        );
    }
}
