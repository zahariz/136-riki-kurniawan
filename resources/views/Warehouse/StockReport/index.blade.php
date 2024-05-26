<x-layouts.master>
    <x-slot:head>
        <title>{{ $title }} | Simerak Web App</title>
    </x-slot:head>
    <div class="grid grid-cols-1 px-4 pt-6 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <x-breadcumb>
                <x-breadcumb-head route="/home" title="Dashboard" />
                <x-breadcumb-link route="#" title="Warehouse" />
                <x-breadcumb-link route="{{route('warehouse.stock-report')}}" title="Filter Stock Report" />
                <x-breadcumb-link route="#" current="true" :title="$title" />
            </x-breadcumb>
        </div>
    </div>
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
        <div class="mx-auto max-w-screen-3xl px-4 lg:px-12">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <h5 id="drawer-label"
                    class="inline-flex items-center text-sm font-semibold text-gray-500 p-6 uppercase dark:text-gray-400">
                    {{ $title }}</h5>
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <x-text-input type="text" id="simple-search" placeholder="Search" name="search" />
                            </div>
                        </form>
                    </div>
                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <x-button type="button" id="createSlocModalButton" data-modal-target="createSlocModal"
                            data-modal-toggle="createSlocModal" class="flex items-center">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Export
                        </x-button>

                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-4">SKU</th>
                                <th scope="col" class="px-4 py-4">Product</th>
                                <th scope="col" class="px-4 py-4">Batch</th>
                                <th scope="col" class="px-4 py-4">Qty</th>
                                <th scope="col" class="px-4 py-4">Storage Location</th>
                                <th scope="col" class="px-4 py-4">Storage Bin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)

                                <tr class="border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $row['product']['sku'] }}</th>
                                    <td class="px-4 py-3 max-w-[12rem] truncate ">{{ $row['product']['product_name'] }}</td>
                                    <td class="px-4 py-3 max-w-[12rem] truncate ">{{ $row['batch'] }}</td>
                                    <td class="px-4 py-3 max-w-[12rem] truncate ">{{ $row['qty'] }} Kg</td>
                                    <td class="px-4 py-3 max-w-[12rem] truncate ">{{ $row['sloc']['nama_sloc'] }}</td>
                                    <td class="px-4 py-3 max-w-[12rem] truncate ">{{ $row['sbin']['kode_bin'] }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                {{ $data->links('pagination::tailwind') }}
            </div>
        </div>
    </section>

    <x-slot:js>
        <script>

        </script>
    </x-slot:js>
</x-layouts.master>
