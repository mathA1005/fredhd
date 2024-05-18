@props(['name', 'label', 'value', 'icon'])

<div class="flex justify-center items-center">
    <input type="checkbox" id="{{ $label }}" value="{{ $value }}" name="{{ $name }}" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:none disabled:opacity-50 disabled:pointer-events-none">
    <label for="{{ $label }}" class="text-sm text-gray-500 ms-3 dark:text-neutral-400"> <i data-lucide="{{ $icon }}"></i> {{ $label }}</label>
</div>
