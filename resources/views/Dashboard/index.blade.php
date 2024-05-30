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
    <div class="grid grid-cols-2 gap-4 p-3">
        <div class="shadow-lg rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72">
            <h5 id="drawer-label"
                    class="inline-flex items-center text-sm font-semibold text-gray-500 p-4 uppercase dark:text-gray-400">
                    Latest Transaction</h5>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-4">Transaction No</th>
                        <th scope="col" class="px-4 py-4">Transaction Type</th>
                        <th scope="col" class="px-4 py-4">Product</th>
                        <th scope="col" class="px-4 py-4">Batch</th>
                        <th scope="col" class="px-4 py-4">Qty</th>
                        <th scope="col" class="px-4 py-4">Transaction Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                        <tr class="border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $row['transaction']['transaction_code'] }}</th>
                            <td class="px-4 py-3 max-w-[12rem] truncate ">{{ $row['transaction']['transaction_type'] }}</td>
                            <td class="px-4 py-3 max-w-[12rem] truncate ">{{ $row['product']['product_name'] }}</td>
                            <td class="px-4 py-3 max-w-[12rem] truncate ">{{ $row['batch'] }}</td>
                            <td class="px-4 py-3 max-w-[12rem] truncate ">{{ $row['qty'] }}</td>
                            <td class="px-4 py-3 max-w-[12rem] truncate ">{{ \Carbon\Carbon::parse($row['transaction']['transaction_date'])->translatedFormat('d F Y H:i')  }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
    </div>
    <x-slot:js>
        <script>

        </script>
    </x-slot:js>
</x-layouts.master>
