<div>
    @if ($for !== null || $label !== null)
    <label for="{{ $for }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
        {{ $label }}
        </label>
    @endif
    <select id="{{ $id }}"
        {{ $attributes->class(["bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"]) }}
        name="{{ $name }}"
        >
        {{ $slot }}
    </select>
    @if ($message !== null)
    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Opps!</span> {{ $message }}</p>
    @endif
</div>
