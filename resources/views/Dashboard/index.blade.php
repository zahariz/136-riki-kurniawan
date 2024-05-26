<x-layouts.master>
    <x-slot:head>
        <title>Dashboard | Simerak Web App</title>
    </x-slot:head>
    <div class="p-3">
        <div class="grid grid-cols-4 gap-4 mb-4">
            <div class="border-2 rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72 flex items-center justify-center">
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl font-extrabold">{{ $emptyBinTotal !== null ? $emptyBinTotal : 0 }}</dt>
                    <dd class="text-gray-500 dark:text-gray-400 font-bold text-xl">Empty Bin</dd>
                </div>
            </div>
            <div class="border-2 rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72 flex items-center justify-center">
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl font-extrabold">{{ $filledBinTotal !== null ? $filledBinTotal : 0 }}</dt>
                    <dd class="text-gray-500 dark:text-gray-400 font-bold text-xl">Filled Bin</dd>
                </div>
            </div>
            <div class="border-2 rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72 flex items-center justify-center">
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl font-extrabold">{{ $productTotal !== null ? $productTotal : 0 }}</dt>
                    <dd class="text-gray-500 dark:text-gray-400 font-bold text-xl">Total Products</dd>
                </div>
            </div>
            <div class="border-2 rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72 flex items-center justify-center">
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl font-extrabold">{{ $locationTotal !== null ? $locationTotal : 0 }}</dt>
                    <dd class="text-gray-500 dark:text-gray-400 font-bold text-xl">Total Location</dd>
                </div>
            </div>
        </div>
    </div>
    <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4"></div>
    <div class="grid grid-cols-2 gap-4">
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
    </div>
    <x-slot:js>
        <script>

        </script>
    </x-slot:js>
</x-layouts.master>
