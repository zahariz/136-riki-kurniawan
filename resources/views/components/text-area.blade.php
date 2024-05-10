@if ($for !== null || $label !== null)
    <label for="{{ $for }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" >{{ $label }}:</label>
@endif
<textarea id="{{ $id }}" name="{{ $name }}" rows="5" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 e_description" placeholder="{{ $placeholder }}"></textarea>
@if ($message !== null)
    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Opps!</span> {{ $message }}</p>
@endif
