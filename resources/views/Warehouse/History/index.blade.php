<x-layouts.master>
    <x-slot:head>
        <title>{{ $title }} | Simerak Web App</title>
    </x-slot:head>
    <div class="grid grid-cols-1 px-4 pt-6 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <x-breadcumb>
                <x-breadcumb-head route="/home" title="Dashboard" />
                <x-breadcumb-link route="#" title="Warehouse" />
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
                        <form action="{{ route('warehouse.history') }}" method="GET" id="search-form">
                        <div class="relative flex items-center justify-between">
                            <x-text-input class="w-full mr-2" type="text" id="simple-search" placeholder="Search" name="search" />
                            <x-button class="submitSearch" id="search-button" type="submit">Search</x-button>
                            <a href="{{ route('warehouse.history') }}" type="button" id="reset-button" class="text-gray-600 hover:text-gray-700 dark:text-white underline text-sm ml-2 hidden">Reset</a>
                        </div>
                        </form>
                    </div>
                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    </div>
                </div>
                <div class="overflow-x-auto">
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
                {{ $data->links('pagination::tailwind') }}
            </div>
        </div>
    </section>

    <x-slot:js>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var status = '{{ session('status') }}';
                var error = '{{ session('errors') }}';
                var errors = '{{ session('error') }}';
                // Tampilkan notifikasi SweetAlert berdasarkan status
                if (status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: status
                    });
                }
                if (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Form tidak boleh kosong!'
                    });
                }

                if(errors) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Form tidak boleh kosong!'
                    });
                }

                const searchForm = document.getElementById("search-form");
                const searchButton = document.getElementById("search-button");
                const resetButton = document.getElementById("reset-button");

                // Check Local Storage for button state
                if (localStorage.getItem('searchSubmitted') === 'true') {
                    searchButton.classList.add("hidden");
                    resetButton.classList.remove("hidden");
                }

                searchForm.addEventListener("submit", function(event) {
                    searchButton.classList.add("hidden");
                    resetButton.classList.remove("hidden");
                    localStorage.setItem('searchSubmitted', 'true'); // Save state to Local Storage
                });

                resetButton.addEventListener("click", function() {
                    resetButton.classList.add("hidden");
                    searchButton.classList.remove("hidden");
                    localStorage.removeItem('searchSubmitted'); // Clear state from Local Storage
                });
            });
        </script>
    </x-slot:js>
</x-layouts.master>
