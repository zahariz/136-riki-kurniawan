<x-layouts.master>
    <x-slot name="head">
        <title>{{ $title }} | Simerak Web App</title>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ URL::to('css/custom.css') }}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"
            integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous">
        </script>

    </x-slot>

    <div class="grid grid-cols-1 px-4 pt-6 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900" id="">
        <div class="mb-4 col-span-full xl:mb-2">
            <x-breadcumb>
                <x-breadcumb-head route="/home" title="Dashboard" />
                <x-breadcumb-link route="#" title="Warehouse" />
                <x-breadcumb-link route="/warehouse/remove-from-storage" title="Remove From Storage" />
                <x-breadcumb-link route="#" current="true" :title="$title" />
            </x-breadcumb>
        </div>
    </div>
    <style>
        @media print {
         #sidebar, #navbar, #footer, #footers, #title-invoice, #breadcumb {
           display: none;
         }
         .shadow-lg {
           box-shadow: none !important;
         }
         main.pt-20 {
           margin-top: -60px;
           padding-top: 0;
         }
        }
     </style>
    <div class="mx-auto py-2 sm:px-2">
        <!-- row -->
        <div class="flex flex-wrap flex-row">
            <div id="title-invoice" class="flex justify-between max-w-full px-4 py-4 w-full">
                <p class="text-xl font-bold mt-3 mb-5">Print Remove From Storage</p>
                <button type="button" id="btn-invoice" onclick="window.print();"
                    class="py-2 px-4 inline-block text-center mb-3 rounded leading-5 text-gray-100 bg-indigo-500 border border-indigo-500 hover:text-white hover:bg-indigo-600 hover:ring-0 hover:border-indigo-600 focus:bg-indigo-600 focus:border-indigo-600 focus:outline-none focus:ring-0"><svg
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="ltr:mr-2 rtl:ml-2 inline-block bi bi-printer" viewBox="0 0 16 16">
                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                        <path
                            d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                    </svg> Print</button>
            </div>
            <div class="flex-shrink max-w-full px-4 w-full mb-6">
                <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                    <div
                        class="flex justify-between items-center pb-4 border-b border-gray-200 dark:border-gray-700 mb-3">
                        <div class="flex flex-col">
                            <div class="text-3xl font-bold mb-1">
                                <img class="inline-block w-12 h-auto ltr:mr-2 rtl:ml-2"
                                    src="{{ URL::to('images/logo.svg') }}"> Simerak
                            </div>
                            <p class="text-sm">PT. Berkah Abadi<br>Bandung</p>
                        </div>
                        <div class="text-2xl uppercase font-bold">Remove From Storage</div>
                    </div>
                    <div class="flex flex-row justify-between py-3">
                        <div class="flex-1">
                            <p><strong>Created by:</strong><br>
                                <br>
                                +123 456 7890</p>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between mb-2">
                                <div class="flex-1 font-semibold text-right">Transaction No : </div>
                                <div class="flex-1 ltr:text-right rtl:text-left"> {{ $data[0]['transaction']['transaction_code'] }}</div>
                            </div>
                            <div class="flex justify-between mb-2">
                                <div class="flex-1 font-semibold text-right">Transaction date : </div>
                                <div class="flex-1 ltr:text-right rtl:text-left"> {{ \Carbon\Carbon::parse($data[0]['transaction']['transaction_date'])->translatedFormat('d F Y H:i')  }}</div>
                            </div>
                            <div class="flex justify-between mb-2">
                                <div class="flex-1 font-semibold text-right">Print date : </div>
                                <div class="flex-1 ltr:text-right rtl:text-left">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
                            </div>

                        </div>
                    </div>
                    <div class="py-4 relative overflow-x-auto sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr class="bg-gray-100 dark:bg-gray-900 dark:bg-opacity-20">
                                    <th class="text-left px-6 py-3">Products</th>
                                    <th class="text-center px-6 py-3">Qty</th>
                                    <th class="text-center px-6 py-3">Prod Date</th>
                                    <th class="text-center px-6 py-3">Exp Date</th>
                                    <th class="text-center px-6 py-3">Warehouse</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)

                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <td class="flex flex-col px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">

                                            <div class="text-md font-bold">
                                                {{ $row['product']['product_name'] }}
                                            </div>
                                            <div class="text-sm dark:text-gray-300 mb-1">
                                               {{ $row['batch'] }}
                                            </div>

                                    </td>
                                    <td class="text-center px-6 py-4">{{ $row['qty'] }}kg</td>
                                    <td class="text-center px-6 py-4 bg-gray-50 dark:bg-gray-800">{{ \Carbon\Carbon::parse($row['prod_date'])->translatedFormat('d F Y') }}</td>
                                    <td class="text-center px-6 py-4">{{ \Carbon\Carbon::parse($row['exp_date'])->translatedFormat('d F Y') }}</td>
                                    <td class="flex flex-col text-center px-6 py-4 bg-gray-50 dark:bg-gray-800">

                                        <div class="text-md font-bold">
                                        {{ $row['sloc']['nama_sloc'] }}
                                        </div>
                                        <div class="text-sm dark:text-gray-300 mb-1">
                                           {{ $row['sbin']['kode_bin'] }}
                                        </div>

                                    </td>
                                </tr>
                                @endforeach


                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <x-slot name="js">
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
            });
        </script>
    </x-slot>
</x-layouts.master>
