<x-layouts.master>
    <x-slot name="head">
        <title>{{ $title }} | Simerak Web App</title>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ URL::to('css/custom.css') }}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </x-slot>

    <div class="grid grid-cols-1 px-4 pt-6 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <x-breadcumb>
                <x-breadcumb-head route="/home" title="Dashboard" />
                <x-breadcumb-link route="#" title="Warehouse" />
                <x-breadcumb-link route="#" current="true" :title="$title" />
            </x-breadcumb>
        </div>
    </div>
    <div class="grid gird-cols-1 px-4 pt-2 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
        <!-- Right Content -->
        <div class="col-span-full xl:col-auto sm:col-span-2">
            <div
                class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <h3 class="mb-4 text-xl font-semibold dark:text-white">{{ $title }}</h3>
                <form action="{{ route('storeSession') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-6 gap-6">
                        <!-- Dropdown Product -->
                        <div class="col-span-12 sm:col-full">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product</label>
                            <div class="relative" onclick="event.stopImmediatePropagation();">
                                <input id="Product" type="text" name="product_name"
                                    placeholder="Type sku product here.." autocomplete="off"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    onkeyup="onKeyUpProduct(event)" />
                                <input id="product_id" type="hidden" name="product_id"
                                    placeholder="Type sku product here.." autocomplete="off"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                     />
                                @error('product')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                            class="font-medium">Opps!</span> {{ $message }}</p>
                                @enderror
                                <div id="dropdownProduct"
                                    class="w-full h-60 border border-gray-300 rounded-md bg-white absolute z-10 overflow-y-auto hidden">
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-full">
                            <x-text-input for="batch" autocomplete="off" id="h_batch" type="text" name="h_batch"
                                label="Batch" disabled placeholder="Type batch number here..">
                                @error('batch')
                                    <x-slot:message>{{ $message }}</x-slot:message>
                                @enderror
                            </x-text-input>
                            <x-text-input for="batch" autocomplete="off" class="hidden" id="batch" type="hidden" name="batch"
                                label="Batch" placeholder="Type batch number here..">

                            </x-text-input>
                        </div>
                        <div class="col-span-12 sm:col-full hidden">
                            <x-text-input for="id" autocomplete="off" id="id" type="hidden" name="id"
                                label="id" placeholder="Type id number here..">

                            </x-text-input>
                        </div>
                        <div class="col-span-12 sm:col-full">
                            <x-text-input for="h_prod_date" autocomplete="off" id="h_prod_date" type="text" name="h_prod_date"
                                label="Prod Date" disabled placeholder="Type prod date number here..">
                                @error('prod_date')
                                    <x-slot:message>{{ $message }}</x-slot:message>
                                @enderror
                            </x-text-input>
                            <x-text-input for="prod_date" autocomplete="off" class="hidden" id="prod_date" type="hidden" name="prod_date"
                                label="Prod Date" placeholder="Type prod date number here..">

                            </x-text-input>
                        </div>
                        <div class="col-span-12 sm:col-full">
                            <x-text-input for="h_exp_date" autocomplete="off" id="h_exp_date" type="text" name="h_exp_date"
                                label="Exp Date" placeholder="Type exp date number here.." disabled>
                                @error('exp_date')
                                    <x-slot:message>{{ $message }}</x-slot:message>
                                @enderror
                            </x-text-input>
                            <x-text-input for="exp_date" autocomplete="off" id="exp_date" type="hidden" class="hidden" name="exp_date"
                                label="Exp Date" placeholder="Type exp date number here..">

                            </x-text-input>
                        </div>

                        <!-- Dropdown Storage Location -->
                        <div class="col-span-12 sm:col-full">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Storage
                                Location</label>
                            <div class="relative">
                                <input id="h_Sloc" type="text" name="h_nama_sloc" disabled
                                    placeholder="Type storage location code here.." autocomplete="off"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                     />
                                <input id="Sloc" type="hidden" name="nama_sloc"
                                    placeholder="Type storage location code here.." autocomplete="off"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                     />
                                <input id="sloc_id" type="hidden" name="sloc_id"
                                    placeholder="Type storage location code here.." autocomplete="off"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                     />
                                @error('sloc')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                            class="font-medium">Opps!</span> {{ $message }}</p>
                                @enderror
                                <div id="dropdownSloc"
                                    class="w-full z-10 h-60 border border-gray-300 rounded-md bg-white absolute overflow-y-auto hidden">
                                </div>
                            </div>
                        </div>
                        <!-- Dropdown Storage Bin -->
                        <div class="col-span-12 sm:col-full">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Storage
                                Bin</label>
                            <div class="relative">
                                <input id="h_StorageBin" type="text" name="h_kode_bin" disabled
                                    placeholder="Type storage bin here.." autocomplete="off"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                     />
                                <input id="StorageBin" type="hidden" name="kode_bin"
                                    placeholder="Type storage bin here.." autocomplete="off"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                     />
                                <input id="sbin_id" type="hidden" name="sbin_id"
                                    placeholder="Type storage bin here.." autocomplete="off"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                     />
                                @error('sbin')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                            class="font-medium">Opps!</span> {{ $message }}</p>
                                @enderror
                                <div id="dropdownStorageBin"
                                    class="w-full h-60 border border-gray-300 rounded-md bg-white absolute overflow-y-auto hidden">
                                </div>
                            </div>
                        </div>


                        <div class="col-span-12 sm:col-full">
                            <x-text-input for="qty" autocomplete="off" id="qty" type="number" name="qty"
                                label="Qty" placeholder="Type qty here..">
                                @error('qty')
                                    <x-slot:message>{{ $message }}</x-slot:message>
                                @enderror
                            </x-text-input>
                        </div>
                        <div class="col-span-12 sm:col-full flex items-end">
                            <button type="submit" class="flex items-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Generate</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-span-2">
            <div
                class="p-4 mb-4 xl:gap-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <h3 class="mb-4 text-xl font-semibold dark:text-white">Cart</h3>
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-9">
                        <div class="relative overflow-x-auto" id="overflow">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-4 py-4">Product</th>
                                        <th scope="col" class="px-4 py-4">Batch</th>
                                        <th scope="col" class="px-4 py-4">Qty</th>
                                        <th scope="col" class="px-4 py-4">Storage Location</th>
                                        <th scope="col" class="px-4 py-4">Storage Bin</th>
                                        <th scope="col" class="px-4 py-3">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach (session('sessionRemoveFromStorage', []) as $data)
                                        <tr class="border-b dark:border-gray-700">
                                            <th scope="row"
                                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white product_name">
                                                {{ $data['product_name'] }}</th>
                                            <th scope="row"
                                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white product_id hidden">
                                                {{ $data['product_id'] }}</th>
                                            <th scope="row"
                                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white batch">
                                                {{ $data['batch'] }}</th>
                                            <td class="px-4 py-3 max-w-[12rem] truncate qty">{{ $data['qty'] }}</td>
                                            <td class="px-4 py-3 max-w-[12rem] truncate nama_sloc">{{ $data['nama_sloc'] }}</td>
                                            <td class="px-4 py-3 max-w-[12rem] truncate kode_bin">{{ $data['kode_bin'] }}</td>
                                            <td class="px-4 py-3 max-w-[12rem] truncate exp_date hidden">{{ $data['exp_date'] }}</td>
                                            <td class="px-4 py-3 max-w-[12rem] truncate prod_date hidden">{{ $data['prod_date'] }}</td>
                                            <td class="px-4 py-3 max-w-[12rem] truncate sloc_id hidden">{{ $data['sloc_id'] }}</td>
                                            <td class="px-4 py-3 max-w-[12rem] truncate sbin_id hidden">{{ $data['sbin_id'] }}</td>
                                            <td class="px-4 py-3 max-w-[12rem] truncate id hidden">{{ $data['id'] }}</td>
                                            <td class="px-4 py-3 max-w-[12rem] truncate uuid" hidden>
                                                {{ $data['uuid'] }}</td>
                                                <td class="px-4 py-3 flex items-center justify-end">
                                                    <button id="{{ $data['uuid'] }}-dropdown-button"
                                                        data-dropdown-toggle="{{ $data['uuid'] }}-dropdown"
                                                        class="inline-flex items-center text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 dark:hover-bg-gray-800 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100 dropdownId"
                                                        type="button">
                                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                        </svg>
                                                    </button>
                                                    <div id="{{ $data['uuid'] }}-dropdown"
                                                        class="hidden z-10 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                                        <ul class="py-1 text-sm" aria-labelledby="{{ $data['uuid'] }}-dropdown-button">
                                                            <li>
                                                                <button type="button" data-modal-target="updateSession"
                                                                    data-modal-toggle="updateSession"
                                                                    class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200 edit-rfs">
                                                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                                        viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                        <path
                                                                            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                                                                    </svg>
                                                                    Edit
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button type="button" data-modal-target="deleteModal"
                                                                    data-modal-toggle="deleteModal"
                                                                    class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 text-red-500 dark:hover:text-red-400 delete-rfs">
                                                                    <svg class="w-4 h-4 mr-2" viewbox="0 0 14 15" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor"
                                                                            d="M6.09922 0.300781C5.93212 0.30087 5.76835 0.347476 5.62625 0.435378C5.48414 0.523281 5.36931 0.649009 5.29462 0.798481L4.64302 2.10078H1.59922C1.36052 2.10078 1.13161 2.1956 0.962823 2.36439C0.79404 2.53317 0.699219 2.76209 0.699219 3.00078C0.699219 3.23948 0.79404 3.46839 0.962823 3.63718C1.13161 3.80596 1.36052 3.90078 1.59922 3.90078V12.9008C1.59922 13.3782 1.78886 13.836 2.12643 14.1736C2.46399 14.5111 2.92183 14.7008 3.39922 14.7008H10.5992C11.0766 14.7008 11.5344 14.5111 11.872 14.1736C12.2096 13.836 12.3992 13.3782 12.3992 12.9008V3.90078C12.6379 3.90078 12.8668 3.80596 13.0356 3.63718C13.2044 3.46839 13.2992 3.23948 13.2992 3.00078C13.2992 2.76209 13.2044 2.53317 13.0356 2.36439C12.8668 2.1956 12.6379 2.10078 12.3992 2.10078H9.35542L8.70382 0.798481C8.62913 0.649009 8.5143 0.523281 8.37219 0.435378C8.23009 0.347476 8.06631 0.30087 7.89922 0.300781H6.09922ZM4.29922 5.70078C4.29922 5.46209 4.39404 5.23317 4.56282 5.06439C4.73161 4.8956 4.96052 4.80078 5.19922 4.80078C5.43791 4.80078 5.66683 4.8956 5.83561 5.06439C6.0044 5.23317 6.09922 5.46209 6.09922 5.70078V11.1008C6.09922 11.3395 6.0044 11.5684 5.83561 11.7372C5.66683 11.906 5.43791 12.0008 5.19922 12.0008C4.96052 12.0008 4.73161 11.906 4.56282 11.7372C4.39404 11.5684 4.29922 11.3395 4.29922 11.1008V5.70078ZM8.79922 4.80078C8.56052 4.80078 8.33161 4.8956 8.16282 5.06439C7.99404 5.23317 7.89922 5.46209 7.89922 5.70078V11.1008C7.89922 11.3395 7.99404 11.5684 8.16282 11.7372C8.33161 11.906 8.56052 12.0008 8.79922 12.0008C9.03791 12.0008 9.26683 11.906 9.43561 11.7372C9.6044 11.5684 9.69922 11.3395 9.69922 11.1008V5.70078C9.69922 5.46209 9.6044 5.23317 9.43561 5.06439C9.26683 4.8956 9.03791 4.80078 8.79922 4.80078Z" />
                                                                    </svg>
                                                                    Delete
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="flex items-end justify-end mt-2">
                            <button data-modal-target="confirmationSubmit" data-modal-toggle="confirmationSubmit" type="submit" class="flex items-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Update modal -->
    <x-modal-form id="updateSession" data-modal-hide="updateSession" action="{{ route('updateSession') }}"
        title-modal="Update Cart">
        @method('PUT')
        @csrf
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product</label>
            <div class="relative" onclick="event.stopImmediatePropagation();">
                <input id="e_Product" type="text" name="product_name" placeholder="Type sku product here.."
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    onkeyup="onKeyUpEProduct(event)" />

                <div id="e_dropdownProduct"
                    class="w-full h-60 border border-gray-300 rounded-md bg-white absolute z-10 overflow-y-auto hidden">
                </div>
            </div>
        </div>
        <div>
            <x-text-input for="h_e_batch" type="text" name="batch" id="h_e_batch" label="Batch" disabled
                placeholder="Ex. 241305-A1" />
            <x-text-input for="e_batch" type="hidden" class="hidden" name="batch" id="e_batch" label="Batch"
                placeholder="Ex. 241305-A1" />
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Storage Location</label>
            <div class="relative">
                <input id="h_e_Sloc" type="text" name="h_nama_sloc" placeholder="Type storage location code here.." disabled
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                     />
                <input id="e_Sloc" type="hidden" name="nama_sloc" placeholder="Type storage location code here.."
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                     />

                <div id="e_dropdownSloc"
                    class="w-full h-60 border border-gray-300 rounded-md bg-white absolute overflow-y-auto hidden">
                </div>
            </div>
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Storage Bin</label>
            <div class="relative">
                <input id="h_e_StorageBin" type="text" name="h_kode_bin" placeholder="Type storage bin here.." disabled
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                     />
                <input id="e_StorageBin" type="hidden" name="kode_bin" placeholder="Type storage bin here.."
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                     />

                <div id="e_dropdownStorageBin"
                    class="w-full h-60 border border-gray-300 rounded-md bg-white absolute overflow-y-auto hidden">
                </div>
            </div>
        </div>
        <div class="sm:col-span-2">
            <x-text-input for="qty" id="e_qty" type="number" name="qty" label="Qty"
                placeholder="Type qty here.." />
        </div>
        <div class="sm:col-span-2 hidden">
            <x-text-input for="exp_date" id="e_exp_date" type="text" name="exp_date" label="exp_date"
                placeholder="Type exp_date here.." />
        </div>
        <div class="sm:col-span-2 hidden">
            <x-text-input for="prod_date" id="e_prod_date" type="text" name="prod_date" label="prod_date"
                placeholder="Type prod_date here.." />
        </div>
        <div class="sm:col-span-2 hidden">
            <x-text-input for="sloc_id" id="e_sloc_id" type="number" name="sloc_id" label="sloc_id"
                placeholder="Type sloc_id here.." />
        </div>
        <div class="sm:col-span-2 hidden">
            <x-text-input for="sbin_id" id="e_sbin_id" type="number" name="sbin_id" label="sbin_id"
                placeholder="Type sbin_id here.." />
        </div>
        <div class="sm:col-span-2 hidden">
            <x-text-input for="product_id" id="e_product_id" type="text" name="product_id" label="product_id"
                placeholder="Type product_id here.." />
        </div>
        <div class="sm:col-span-2 hidden">
            <x-text-input for="id" id="e_id" type="text" name="id" label="id"
                placeholder="Type id here.." />
        </div>
        <div class="sm:col-span-2 hidden">
            <x-text-input for="uuid" id="e_uuid" type="text" name="uuid" label="uuid"
                placeholder="Type uuid here.." />
        </div>


        <x-slot:labelBtn>
            Update
        </x-slot:labelBtn>
    </x-modal-form>

    <!-- Delete modal -->
    <div id="deleteModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <form action="{{ route('deleteSession') }}" method="DELETE">
            @csrf
            <div class="sm:col-span-2 hidden">
                <x-text-input for="uuid" id="d_uuid" type="text" name="uuid" label="uuid"
                    placeholder="Type uuid here.." />
            </div>
            <x-modal-confirmation data-modal-hide="deleteModal">
                <x-slot:text>
                    Are you sure want to delete this?
                </x-slot:text>
            </x-modal-confirmation>
        </form>
    </div>

    <!-- Confirmation modal -->
    <div id="confirmationSubmit"  tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <form action="{{ route('warehouse.remove-from-storage.store') }}" method="POST">
            @csrf
            @foreach (session('sessionRemoveFromStorage', []) as $key => $data)
            <div class="sm:col-span-2 hidden">
                <x-text-input for="product_id" id="product_id" type="text" name="product_id[{{ $key }}]" label="Product Id" value="{{ $data['product_id'] }}"
                    placeholder="Type product here.." />
            </div>
            <div class="sm:col-span-2 hidden">
                <x-text-input for="id" id="id" type="text" name="id[{{ $key }}]" label="Product Id" value="{{ $data['id'] }}"
                    placeholder="Type product here.." />
            </div>
            <div class="sm:col-span-2 hidden">
                <x-text-input for="product_name" id="product_name" type="text" name="product_name[{{ $key }}]" label="Product Name" value="{{ $data['product_name'] }}"
                    placeholder="Type product here.." />
            </div>
            <div class="sm:col-span-2 hidden">
                <x-text-input for="batch" id="batch" type="text" name="batch[{{ $key }}]" label="batch" value="{{ $data['batch'] }}"
                    placeholder="Type batch here.." />
            </div>
            <div class="sm:col-span-2 hidden">
                <x-text-input for="qty" id="qty" type="number" name="qty[{{ $key }}]" label="qty" value="{{ $data['qty'] }}"
                    placeholder="Type qty here.." />
            </div>
            <div class="sm:col-span-2 hidden">
                <x-text-input for="sloc_id" id="sloc_id" type="text" name="sloc_id[{{ $key }}]" label="sloc_id" value="{{ $data['sloc_id'] }}"
                    placeholder="Type sloc_id here.." />
            </div>
            <div class="sm:col-span-2 hidden">
                <x-text-input for="nama_sloc" id="nama_sloc" type="text" name="nama_sloc[{{ $key }}]" label="nama_sloc" value="{{ $data['nama_sloc'] }}"
                    placeholder="Type nama_sloc here.." />
            </div>
            <div class="sm:col-span-2 hidden">
                <x-text-input for="kode_bin" id="kode_bin" type="text" name="kode_bin[{{ $key }}]" label="kode_bin" value="{{ $data['kode_bin'] }}"
                    placeholder="Type kode_bin here.." />
            </div>
            <div class="sm:col-span-2 hidden">
                <x-text-input for="sbin_id" id="sbin_id" type="text" name="sbin_id[{{ $key }}]" label="sbin_id" value="{{ $data['sbin_id'] }}"
                    placeholder="Type sbin_id here.." />
            </div>
            <div class="sm:col-span-2 hidden">
                <x-text-input for="exp_date" id="exp_date" type="text" name="exp_date[{{ $key }}]" label="exp_date" value="{{ $data['exp_date'] }}"
                    placeholder="Type exp_date here.." />
            </div>
            <div class="sm:col-span-2 hidden">
                <x-text-input for="prod_date" id="prod_date" type="text" name="prod_date[{{ $key }}]" label="prod_date" value="{{ $data['prod_date'] }}"
                    placeholder="Type prod_date here.." />
            </div>
            @endforeach
            <x-modal-confirmation data-modal-hide="confirmationSubmit">
                <x-slot:text>
                    Are you sure want to save this transaction?
                </x-slot:text>
            </x-modal-confirmation>
        </form>
    </div>

    <x-slot name="js">
        <script>
            // Data untuk dropdown
            let products = @json($products);

            let locations = @json($sloc);

            let storageBins = @json($sbin);
            // Fungsi untuk menangani event keyboard pada input produk
            function onKeyUpProduct(e) {
                let keyword = e.target.value;
                let dropdownEl = document.querySelector("#dropdownProduct");
                dropdownEl.classList.remove("hidden");
                let filteredProducts = products.filter((p) =>
                    p.product.product_name.toLowerCase().includes(keyword.toLowerCase()) ||
                    p.sbin.kode_bin.toLowerCase().includes(keyword.toLowerCase())
                );

                renderOptionsProduct(filteredProducts, dropdownEl);
            }


            // Fungsi untuk menangani event keyboard pada input produk
            function onKeyUpEProduct(e) {
                let keyword = e.target.value;
                let dropdownEl = document.querySelector("#e_dropdownProduct");
                dropdownEl.classList.remove("hidden");
                let filteredProducts = products.filter((p) =>
                    p.product.product_name.toLowerCase().includes(keyword.toLowerCase()) ||
                    p.sbin.kode_bin.toLowerCase().includes(keyword.toLowerCase())
                );

                renderOptionsEProduct(filteredProducts, dropdownEl);
            }



            // Fungsi untuk merender opsi dropdown
            function renderOptionsProduct(options, dropdownEl) {
                let newHtml = ``;

                options.forEach((option) => {
                    newHtml += `<div
                        onclick="selectOption('${option.product.product_name}', '${dropdownEl.id}', '${option.product.id}','${option.batch}', '${option.sloc.nama_sloc}', '${option.sloc.id}', '${option.sbin.kode_bin}', '${option.sbin.id}', '${option.qty}', '${option.exp_date}', '${option.prod_date}', '${option.id}')"
                        class="p-2.5 border-b border-gray-200 text-stone-600 cursor-pointer hover:bg-slate-100 transition-colors"
                    >
                        ${option.product.product_name} - ${option.sbin.kode_bin}
                    </div>`;
                });

                dropdownEl.innerHTML = newHtml;
            }

            // Fungsi untuk merender opsi dropdown
            function renderOptionsEProduct(options, dropdownEl) {
                let newHtml = ``;

                options.forEach((option) => {
                    newHtml += `<div
                        onclick="selectOptionEProduct('${option.product.product_name}', '${dropdownEl.id}', '${option.product.id}','${option.batch}', '${option.sloc.nama_sloc}', '${option.sloc.id}', '${option.sbin.kode_bin}', '${option.sbin.id}', '${option.qty}', '${option.exp_date}', '${option.prod_date}', '${option.id}')"
                        class="p-2.5 border-b border-gray-200 text-stone-600 cursor-pointer hover:bg-slate-100 transition-colors"
                    >
                        ${option.product.product_name} - ${option.sbin.kode_bin}
                    </div>`;
                });

                dropdownEl.innerHTML = newHtml;
            }

            function formatTanggal(tanggal) {
            const bulanIndo = [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];

            let [datePart] = tanggal.split(' ');

            let [tahun, bulan, hari] = datePart.split('-');

            return `${parseInt(hari)} ${bulanIndo[parseInt(bulan) - 1]} ${tahun}`;
        }

            // Fungsi untuk memilih opsi dropdown
            function selectOption(selectedOption, dropdownId, productId, batchs, namaSloc, slocId, kodeBin, binId, qtyS, expDate, prodDate, Id) {
                hideDropdown(dropdownId);
                let inputId = dropdownId.replace("dropdown", "");
                console.log(inputId);
                let input = document.querySelector(`#${inputId}`);
                let product_id = document.getElementById("product_id");
                let batch = document.getElementById("batch");
                let h_batch = document.getElementById("h_batch");
                let nama_sloc = document.getElementById("Sloc");
                let h_nama_sloc = document.getElementById("h_Sloc");
                let sloc_id = document.getElementById("sloc_id");
                let kode_bin = document.getElementById("StorageBin");
                let h_kode_bin = document.getElementById("h_StorageBin");
                let sbin_id = document.getElementById("sbin_id");
                let qty = document.getElementById("qty");
                let id = document.getElementById("id");
                let exp_date = document.getElementById("exp_date");
                let h_exp_date = document.getElementById("h_exp_date");
                let prod_date = document.getElementById("prod_date");
                let h_prod_date = document.getElementById("h_prod_date");
                input.value = selectedOption;
                product_id.value = productId;
                batch.value = batchs;
                h_batch.value = batchs;
                nama_sloc.value = namaSloc;
                h_nama_sloc.value = namaSloc;
                sloc_id.value = slocId;
                kode_bin.value = kodeBin;
                h_kode_bin.value = kodeBin;
                sbin_id.value = binId;
                qty.value = qtyS;
                exp_date.value = expDate;
                h_exp_date.value = formatTanggal(expDate);
                prod_date.value = prodDate;
                h_prod_date.value = formatTanggal(prodDate);
                id.value = Id;
            }

            // Fungsi untuk memilih opsi dropdown
            function selectOptionEProduct(selectedOption, dropdownId, productId, batchs, namaSloc, slocId, kodeBin, binId, qtyS, expDate, prodDate, Id) {
                hideDropdown(dropdownId);
                let inputId = dropdownId.replace("dropdown", "");
                console.log(inputId);
                let input = document.querySelector(`#${inputId}`);
                let product_id = document.getElementById("e_product_id");
                let batch = document.getElementById("e_batch");
                let h_batch = document.getElementById("h_e_batch");
                let nama_sloc = document.getElementById("e_Sloc");
                let h_nama_sloc = document.getElementById("h_e_Sloc");
                let sloc_id = document.getElementById("e_sloc_id");
                let kode_bin = document.getElementById("e_StorageBin");
                let h_kode_bin = document.getElementById("h_e_StorageBin");
                let sbin_id = document.getElementById("e_sbin_id");
                let qty = document.getElementById("e_qty");
                let id = document.getElementById("e_id");
                let exp_date = document.getElementById("e_exp_date");
                let prod_date = document.getElementById("e_prod_date");
                input.value = selectedOption;
                product_id.value = productId;
                batch.value = batchs;
                h_batch.value = batchs;
                nama_sloc.value = namaSloc;
                h_nama_sloc.value = namaSloc;
                sloc_id.value = slocId;
                kode_bin.value = kodeBin;
                h_kode_bin.value = kodeBin;
                sbin_id.value = binId;
                qty.value = qtyS;
                exp_date.value = expDate;
                prod_date.value = prodDate;
                id.value = Id;
            }
            // Fungsi untuk menyembunyikan dropdown
            function hideDropdown(dropdownId) {
                let dropdownEl = document.querySelector(`#${dropdownId}`);
                dropdownEl.classList.add("hidden");
            }


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
                        text: errors
                    });
                }

                document.addEventListener('click', function(event) {
                    // Periksa apakah yang diklik adalah tombol dengan kelas 'edit_expense'
                    if (event.target.classList.contains('edit-rfs')) {
                        // Temukan elemen tr terdekat dari tombol yang diklik
                        var row = event.target.closest('tr');

                        // Ambil nilai dari setiap kolom dalam baris tabel
                        var product_name = row.querySelector('.product_name').innerText;
                        var product_id = row.querySelector('.product_id').innerText;
                        var batch = row.querySelector('.batch').innerText;
                        var exp_date = row.querySelector('.exp_date').innerText;
                        var prod_date = row.querySelector('.prod_date').innerText;
                        var qty = row.querySelector('.qty').innerText;
                        var nama_sloc = row.querySelector('.nama_sloc').innerText;
                        var sloc_id = row.querySelector('.sloc_id').innerText;
                        var kode_bin = row.querySelector('.kode_bin').innerText;
                        var sbin_id = row.querySelector('.sbin_id').innerText;
                        var id = row.querySelector('.id').innerText;
                        var uuid = row.querySelector('.uuid').innerText;
                        console.log(uuid);

                        // Masukkan nilai-nilai tersebut ke dalam elemen-elemen input dalam modal
                        document.getElementById('e_Product').value = product_name;
                        document.getElementById('e_batch').value = batch;
                        document.getElementById('h_e_batch').value = batch;
                        document.getElementById('e_qty').value = qty;
                        document.getElementById('e_exp_date').value = exp_date;
                        document.getElementById('e_prod_date').value = prod_date;
                        document.getElementById('e_sloc_id').value = sloc_id;
                        document.getElementById('e_sbin_id').value = sbin_id;
                        document.getElementById('e_product_id').value = product_id;
                        document.getElementById('e_Sloc').value = nama_sloc;
                        document.getElementById('h_e_Sloc').value = nama_sloc;
                        document.getElementById('e_StorageBin').value = kode_bin;
                        document.getElementById('h_e_StorageBin').value = kode_bin;
                        document.getElementById('e_uuid').value = uuid;
                        document.getElementById('e_id').value = id;

                    }
                });
                document.addEventListener('click', function(event) {
                    // Periksa apakah yang diklik adalah tombol dengan kelas 'edit_expense'
                    if (event.target.classList.contains('delete-rfs')) {
                        // Temukan elemen tr terdekat dari tombol yang diklik
                        var row = event.target.closest('tr');

                        // Ambil nilai dari setiap kolom dalam baris tabel

                        var uuid = row.querySelector('.uuid').innerText;
                        console.log(uuid);

                        // Masukkan nilai-nilai tersebut ke dalam elemen-elemen input dalam modal
                        document.getElementById('d_uuid').value = uuid;

                    }
                });

            });


        </script>
    </x-slot>
</x-layouts.master>
