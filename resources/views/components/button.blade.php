<div>
    <button
    {{ $attributes->class(['flex items-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800']) }}
    type="{{ $type }}"
    data-modal-toggle="{{ $dataModalToggle }}"
    aria-controls="{{ $ariaControls }}"
    id="{{ $id }}"
    >
        {{ $slot }}
    </button>
</div>
