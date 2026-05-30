@error($for)
    <span {{-- Alpine.js local state to control visibility --}} x-data="{ show: true }" {{-- Show message immediately, then auto-hide after 5 seconds --}} x-init="show = true;
    setTimeout(() => show = false, 5000)" {{-- Toggle visibility --}}
        x-show="show" {{-- Smooth fade-out transition when hiding --}} x-transition:leave="transition ease-in duration-500"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" {{-- Merge custom classes passed from parent with default styling --}}
        {{ $attributes->merge(['class' => 'text-danger errors-message-crud']) }}>
        {{-- Validation error message from Laravel --}}
        {{ $message }}
    </span>
@enderror
