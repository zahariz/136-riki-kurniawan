<li>
    <a href="{{ $href }}" {{ $attributes->class(['flex items-center p-2 text-base rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-900 dark:text-gray-200']) }}>
            {{ $slot }}
            {{ $title }}
    </a>
</li>

