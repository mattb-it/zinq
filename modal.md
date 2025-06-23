# Modal Component

The modal component provides a flexible dialog overlay with customizable sizing options.

## Usage

```blade
<x-zinq::modal id="example-modal" title="Example Modal">
    <p>This is the modal content.</p>
</x-zinq::modal>
```

## Properties

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `id` | string | required | Unique identifier for the modal |
| `title` | string | null | Optional title displayed in the header |
| `open` | boolean | false | Controls initial open state |
| `focusInput` | string | null | ID of input element to focus when modal opens |
| `size` | string | 'sm' | Controls the maximum width of the modal |

## Size Options

The `size` property accepts the following values:

- **`xs`** - Extra small modal (~384px max-width)
- **`sm`** - Small modal (default, uses breakpoint-sm)
- **`md`** - Medium modal (~672px max-width)
- **`lg`** - Large modal (~896px max-width)
- **`max`** - Maximum modal (~1280px max-width, full width on large screens)

### Size Examples

```blade
<!-- Extra small modal -->
<x-zinq::modal id="xs-modal" size="xs" title="Extra Small">
    <p>Compact modal for simple confirmations.</p>
</x-zinq::modal>

<!-- Medium modal -->
<x-zinq::modal id="md-modal" size="md" title="Medium Modal">
    <p>Good for forms and moderate content.</p>
</x-zinq::modal>

<!-- Large modal -->
<x-zinq::modal id="lg-modal" size="lg" title="Large Modal">
    <p>Suitable for detailed content and complex forms.</p>
</x-zinq::modal>

<!-- Maximum modal -->
<x-zinq::modal id="max-modal" size="max" title="Maximum Modal">
    <p>Full-width modal for extensive content and data tables.</p>
</x-zinq::modal>
```

## Opening and Closing Modals

Modals can be controlled using Alpine.js events:

```javascript
// Open a modal
window.dispatchEvent(new CustomEvent('open-modal', { detail: 'modal-id' }));

// Close a modal
window.dispatchEvent(new CustomEvent('close-modal', { detail: 'modal-id' }));
```

Or using the Zinq helper:

```php
// In your Livewire component
Zinq::openModal('modal-id');
```

## Features

- Responsive sizing that adapts to screen size
- Keyboard accessibility (ESC key to close)
- Click outside to close
- Focus management for form inputs
- Dark mode support
- Customizable backdrop