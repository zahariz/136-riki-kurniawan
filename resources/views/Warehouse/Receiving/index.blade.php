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
        <div class="col-span-full">
            <div
                class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <h3 class="mb-4 text-xl font-semibold dark:text-white">{{ $title }}</h3>
                <form action="{{ route('warehouse.receiving.sessionStore') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-6 gap-6">
                        <!-- Dropdown Product -->
                        <div class="col-span-6 sm:col-span-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product</label>
                            <div class="relative" onclick="event.stopImmediatePropagation();">
                                <input id="Product" type="text" name="product_name"
                                    placeholder="Type sku product here.." autocomplete="off"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    onkeyup="onKeyUpProduct(event)" />
                                <input id="ProductId" type="hidden" name="product_id"
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
                        <div class="col-span-6 sm:col-span-3">
                            <x-text-input for="batch" id="batch" type="text" autocomplete="off" name="batch"
                                label="Batch" placeholder="Type batch number here..">
                                @error('batch')
                                    <x-slot:message>{{ $message }}</x-slot:message>
                                @enderror
                            </x-text-input>
                        </div>
                        <!-- Dropdown Storage Location -->
                        <div class="col-span-6 sm:col-span-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Storage
                                Location</label>
                            <div class="relative" onclick="event.stopImmediatePropagation();">
                                <input id="Sloc" type="text" name="nama_sloc"
                                    placeholder="Type storage location code here.." autocomplete="off"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    onkeyup="onKeyUpSloc(event)" />
                                <input id="SlocId" type="hidden" name="sloc_id"
                                    placeholder="Type storage location code here.." autocomplete="off"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                     />
                                @error('sloc')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                            class="font-medium">Opps!</span> {{ $message }}</p>
                                @enderror
                                <div id="dropdownSloc"
                                    class="w-full h-60 border border-gray-300 rounded-md bg-white absolute z-10 overflow-y-auto hidden">
                                </div>
                            </div>
                        </div>
                       <!-- Dropdown Storage Bin -->
                        <div class="col-span-6 sm:col-span-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Storage Bin</label>
                            <div class="relative" onclick="event.stopImmediatePropagation();">
                                <input id="StorageBin" type="text" name="kode_bin"
                                    placeholder="Type storage bin here.." autocomplete="off"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    onkeyup="onKeyUpStorageBin(event)" />
                                <input id="StorageBinId" type="hidden" name="sbin_id"
                                    autocomplete="off"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    />
                                @error('sbin')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                            class="font-medium">Opps!</span> {{ $message }}</p>
                                @enderror
                                <div id="dropdownStorageBin"
                                    class="w-full h-60 border border-gray-300 rounded-md bg-white absolute z-10 overflow-y-auto hidden">
                                </div>
                            </div>
                        </div>


                        <div class="col-span-6 sm:col-span-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Production
                                Date</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input name="prod_date" autocomplete="off" datepicker datepicker-format="dd/mm/yyyy"
                                    type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Select date">
                            </div>
                            @error('prod_date')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                        class="font-medium">Opps!</span> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Expired
                                Date</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input name="exp_date" autocomplete="off" datepicker datepicker-format="dd/mm/yyyy"
                                    type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Select date">
                            </div>
                            @error('exp_date')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                        class="font-medium">Opps!</span> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-text-input for="qty" autocomplete="off" id="qty" type="number"
                                name="qty" label="Qty" placeholder="Type qty here..">
                                @error('qty')
                                    <x-slot:message>{{ $message }}</x-slot:message>
                                @enderror
                            </x-text-input>
                        </div>
                        <div class="col-span-6 sm:col-span-3 flex items-end">
                            <button type="submit" class="flex items-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div
        class="p-4 mb-4 m-4 xl:gap-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <h3 class="mb-4 text-xl font-semibold dark:text-white">Cart</h3>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-4">Product</th>
                        <th scope="col" class="px-4 py-4">Batch</th>
                        <th scope="col" class="px-4 py-4">Qty</th>
                        <th scope="col" class="px-4 py-4">Storage Location</th>
                        <th scope="col" class="px-4 py-4">Storage Bin</th>
                        <th scope="col" class="px-4 py-4">Production Date</th>
                        <th scope="col" class="px-4 py-4">Expired Date</th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @foreach (session('sessionReceiving', []) as $data)
                        <tr class="border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white product_id hidden">
                                {{ $data['product_id'] }}</th>
                            <th scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white product_name">
                                {{ $data['product_name'] }}</th>
                            <th scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white batch">
                                {{ $data['batch'] }}</th>
                            <td class="px-4 py-3 max-w-[12rem] truncate qty">{{ $data['qty'] }}</td>
                            <td class="px-4 py-3 max-w-[12rem] truncate nama_sloc">{{ $data['nama_sloc'] }}</td>
                            <td class="px-4 py-3 max-w-[12rem] truncate sloc_id hidden">{{ $data['sloc_id'] }}</td>
                            <td class="px-4 py-3 max-w-[12rem] truncate kode_bin">{{ $data['kode_bin'] }}</td>
                            <td class="px-4 py-3 max-w-[12rem] truncate sbin_id hidden">{{ $data['sbin_id'] }}</td>
                            <td class="px-4 py-3 max-w-[12rem] truncate prod_date">{{ $data['prod_date'] }}</td>
                            <td class="px-4 py-3 max-w-[12rem] truncate exp_date">{{ $data['exp_date'] }}</td>
                            <td class="px-4 py-3 max-w-[12rem] truncate uuid" hidden>{{ $data['uuid'] }}</td>
                            <td class="px-4 py-3 flex items-center justify-end">
                                <button id="{{ $data['uuid'] }}-dropdown-button"
                                    data-dropdown-toggle="{{ $data['uuid'] }}-dropdown"
                                    class="inline-flex items-center text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 dark:hover-bg-gray-800 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                    type="button">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>
                                <div id="{{ $data['uuid'] }}-dropdown"
                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
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
            <x-button label="Login" data-modal-target="confirmationSubmit"
            data-modal-toggle="confirmationSubmit" type="button">Submit</x-button>
        </div>

    </div>

    <!-- Update modal -->
    <x-modal-form id="updateSession" data-modal-hide="updateSession"
        action="{{ route('warehouse.receiving.sessionUpdate') }}" title-modal="Update Cart">
        @method('PUT')
        @csrf
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product</label>
            <div class="relative" onclick="event.stopImmediatePropagation();">
                <input id="e_Product" type="text" name="e_product_name" placeholder="Type sku product here.."
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    onkeyup="onKeyUpEProduct(event)" />
                <input id="e_ProductId" type="hidden" name="e_product_id" placeholder="Type sku product here.."
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    />
                <div id="e_dropdownProduct"
                    class="w-full h-60 border border-gray-300 rounded-md bg-white absolute z-10 overflow-y-auto hidden">
                </div>
            </div>
        </div>
        <div>
            <x-text-input for="e_batch" type="text" name="e_batch" id="e_batch" label="Batch"
                placeholder="Ex. 241305-A1" />
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Storage Location</label>
            <div class="relative" onclick="event.stopImmediatePropagation();">
                <input id="e_Sloc" type="text" name="e_nama_sloc" placeholder="Type storage location code here.."
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    onkeyup="onKeyUpESloc(event)" />
                <input id="e_SlocId" type="hidden" name="e_sloc_id" placeholder="Type storage location code here.."
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                     />
                <div id="e_dropdownSloc"
                    class="w-full h-60 border border-gray-300 rounded-md bg-white absolute z-10 overflow-y-auto hidden">
                </div>
            </div>
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Storage Bin</label>
            <div class="relative" onclick="event.stopImmediatePropagation();">
                <input id="e_StorageBin" type="text" name="e_kode_bin" placeholder="Type storage bin here.."
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    onkeyup="onKeyUpEStorageBin(event)" />
                <input id="e_StorageBinId" type="hidden" name="e_sbin_id" placeholder="Type storage bin here.."
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                     />
                <div id="e_dropdownStorageBin"
                    class="w-full h-60 border border-gray-300 rounded-md bg-white absolute z-10 overflow-y-auto hidden">
                </div>
            </div>
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Production Date</label>
            <div class="relative" onclick="event.stopImmediatePropagation();">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                </div>
                <input name="e_prod_date" id="e_prod_date" datepicker datepicker-format="dd/mm/yyyy" type="text"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Select date">
            </div>
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Expired Date</label>
            <div class="relative" onclick="event.stopImmediatePropagation();">
                <div class="relative" onclick="event.stopImmediatePropagation();">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                        </svg>
                    </div>
                    <input name="e_exp_date" id="e_exp_date" datepicker datepicker-format="dd/mm/yyyy"
                        type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Select date">
                </div>
            </div>
        </div>
        <div class="sm:col-span-2">
            <x-text-input for="qty" id="e_qty" type="number" name="e_qty" label="Qty"
                placeholder="Type qty here.." />
        </div>
        <div class="sm:col-span-2 hidden">
            <x-text-input for="uuid" id="e_uuid" type="text" name="e_uuid" label="uuid"
                placeholder="Type uuid here.." />
        </div>


        <x-slot:labelBtn>
            Update
        </x-slot:labelBtn>
    </x-modal-form>

    <!-- Delete modal -->
    <div id="deleteModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <form action="{{ route('warehouse.receiving.sessionDestroy') }}" method="DELETE">
            @csrf
            <div class="sm:col-span-2 hidden">
                <x-text-input for="uuid" id="d_uuid" type="text" name="e_uuid" label="uuid"
                    placeholder="Type uuid here.." />
            </div>
            <x-modal-confirmation data-modal-hide="deleteModal">
                <x-slot:text>
                    Are you sure want to delete this category ?
                </x-slot:text>
            </x-modal-confirmation>
        </form>
    </div>

    <!-- Confirmation modal -->
    <div id="confirmationSubmit" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <form action="{{ route('warehouse.receiving.store') }}" method="POST">
            @csrf
            @foreach (session('sessionReceiving', []) as $key => $data)
            <div class="sm:col-span-2 hidden">
                <x-text-input for="product" id="product" type="text" name="product_id[{{ $key }}]" label="Product" value="{{ $data['product_id'] }}"
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
                <x-text-input for="sloc" id="sloc" type="text" name="sloc_id[{{ $key }}]" label="sloc" value="{{ $data['sloc_id'] }}"
                    placeholder="Type sloc here.." />
            </div>
            <div class="sm:col-span-2 hidden">
                <x-text-input for="sbin" id="sbin" type="text" name="sbin_id[{{ $key }}]" label="sbin" value="{{ $data['sbin_id'] }}"
                    placeholder="Type sbin here.." />
            </div>
            <div class="sm:col-span-2 hidden">
                <x-text-input for="prod_date" id="prod_date" type="text" name="prod_date[{{ $key }}]" label="Prod date" value="{{ $data['prod_date'] }}"
                    placeholder="Type prod_date here.." />
            </div>
            <div class="sm:col-span-2 hidden">
                <x-text-input for="exp_date" id="exp_date" type="text" name="exp_date[{{ $key }}]" label="Exp date" value="{{ $data['exp_date'] }}"
                    placeholder="Type exp date here.." />
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


            let locations = @json($sloc)

            let storageBins = @json($sbin);

            // Fungsi untuk menangani event keyboard pada input produk
            function onKeyUpProduct(e) {
                let keyword = e.target.value;
                let dropdownEl = document.querySelector("#dropdownProduct");
                dropdownEl.classList.remove("hidden");
                let filteredProducts = products.filter((p) =>
                    p.product_name.toLowerCase().includes(keyword.toLowerCase())
                );

                renderOptionsProduct(filteredProducts, dropdownEl);
            }

            function onKeyUpEProduct(e) {
                let keyword = e.target.value;
                let dropdownEl = document.querySelector("#e_dropdownProduct");
                dropdownEl.classList.remove("hidden");
                let filteredProducts = products.filter((p) =>
                    p.product_name.toLowerCase().includes(keyword.toLowerCase())
                );

                renderOptionsProduct(filteredProducts, dropdownEl);
            }

            // Fungsi untuk menangani event keyboard pada input lokasi penyimpanan
            function onKeyUpSloc(e) {
                let keyword = e.target.value;
                let dropdownEl = document.querySelector("#dropdownSloc");
                dropdownEl.classList.remove("hidden");
                let filteredLocations = locations.filter((l) =>
                    l.nama_sloc.toLowerCase().includes(keyword.toLowerCase())
                );

                renderOptionsSloc(filteredLocations, dropdownEl);
            }
            function onKeyUpESloc(e) {
                let keyword = e.target.value;
                let dropdownEl = document.querySelector("#e_dropdownSloc");
                dropdownEl.classList.remove("hidden");
                let filteredLocations = locations.filter((l) =>
                    l.nama_sloc.toLowerCase().includes(keyword.toLowerCase())
                );

                renderOptionsSloc(filteredLocations, dropdownEl);
            }

            document.addEventListener('DOMContentLoaded', () => {
                // Attach keyup event listener
                document.getElementById('StorageBin').addEventListener('keyup', onKeyUpStorageBin);
            });


            // Fungsi untuk menangani event keyboard pada input storage bin
            function onKeyUpStorageBin(e) {
                let keyword = e.target.value;
                let dropdownEl = document.querySelector("#dropdownStorageBin");
                dropdownEl.classList.remove("hidden");
                var slocId = document.getElementById('SlocId').value;
                if (slocId) {
                    fetch(`/sbin/${slocId}/sloc`)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            let filteredBins = data.filter((b) =>
                                b.kode_bin.toLowerCase().includes(keyword.toLowerCase())
                            );
                            renderOptionsSbin(filteredBins, dropdownEl);
                        })
                        .catch(error => console.error('Error fetching storage bins:', error));
                }
            }
            function onKeyUpEStorageBin(e) {
                let keyword = e.target.value;
                let dropdownEl = document.querySelector("#e_dropdownStorageBin");
                dropdownEl.classList.remove("hidden");
                var slocId = document.getElementById('SlocId').value;
                if (slocId) {
                    fetch(`/sbin/${slocId}/sloc`)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            let filteredBins = data.filter((b) =>
                                b.kode_bin.toLowerCase().includes(keyword.toLowerCase())
                            );
                            renderOptionsSbin(filteredBins, dropdownEl);
                        })
                        .catch(error => console.error('Error fetching storage bins:', error));
                }
            }

            // Fungsi untuk merender opsi dropdown
            function renderOptionsProduct(options, dropdownEl) {
                let newHtml = ``;

                options.forEach((option) => {
                    newHtml += `<div
                        onclick="selectOption('${option.product_name}', '${dropdownEl.id}', '${option.id}')"
                        class="p-2.5 border-b border-gray-200 text-stone-600 cursor-pointer hover:bg-slate-100 transition-colors"
                    >
                        ${option.product_name}
                    </div>`;
                });

                dropdownEl.innerHTML = newHtml;
            }

            function renderOptionsSloc(options, dropdownEl) {
                let newHtml = ``;

                options.forEach((option) => {
                    newHtml += `<div
                        onclick="selectOption('${option.nama_sloc}', '${dropdownEl.id}', '${option.id}')"
                        class="p-2.5 border-b border-gray-200 text-stone-600 cursor-pointer hover:bg-slate-100 transition-colors"
                    >
                        ${option.nama_sloc}
                    </div>`;
                });

                dropdownEl.innerHTML = newHtml;
            }
            function renderOptionsSbin(options, dropdownEl) {
                let newHtml = ``;

                options.forEach((option) => {
                    newHtml += `<div
                        onclick="selectOption('${option.kode_bin}', '${dropdownEl.id}', '${option.id}')"
                        class="p-2.5 border-b border-gray-200 text-stone-600 cursor-pointer hover:bg-slate-100 transition-colors"
                    >
                        ${option.kode_bin}
                    </div>`;
                });

                dropdownEl.innerHTML = newHtml;
            }

            // Fungsi untuk memilih opsi dropdown
            function selectOption(selectedOption, dropdownId, id) {
                hideDropdown(dropdownId);
                let inputId = dropdownId.replace("dropdown", "");
                console.log(inputId);
                let input = document.querySelector(`#${inputId}`);
                let idInput = document.querySelector(`#${inputId}Id`);
                console.log(id);
                input.value = selectedOption;
                idInput.value = id;
            }



            // Fungsi untuk menyembunyikan dropdown
            function hideDropdown(dropdownId) {
                let dropdownEl = document.querySelector(`#${dropdownId}`);
                dropdownEl.classList.add("hidden");
            }

            // Sembunyikan dropdown saat dokumen diklik
            document.addEventListener("click", () => {
                hideDropdown("dropdownProduct");
                hideDropdown("dropdownSloc");
                hideDropdown("dropdownStorageBin");
            });

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

                document.addEventListener('click', function(event) {
                    // Periksa apakah yang diklik adalah tombol dengan kelas 'edit_expense'
                    if (event.target.classList.contains('edit-rfs')) {
                        // Temukan elemen tr terdekat dari tombol yang diklik
                        var row = event.target.closest('tr');

                        // Ambil nilai dari setiap kolom dalam baris tabel
                        var product_id = row.querySelector('.product_id').innerText;
                        var product_name = row.querySelector('.product_name').innerText;
                        var batch = row.querySelector('.batch').innerText;
                        var qty = row.querySelector('.qty').innerText;
                        var sloc_id = row.querySelector('.sloc_id').innerText;
                        var nama_sloc = row.querySelector('.nama_sloc').innerText;
                        var sbin_id = row.querySelector('.sbin_id').innerText;
                        var kode_bin = row.querySelector('.kode_bin').innerText;
                        var prod_date = row.querySelector('.prod_date').innerText;
                        var exp_date = row.querySelector('.exp_date').innerText;
                        var uuid = row.querySelector('.uuid').innerText;

                        // Masukkan nilai-nilai tersebut ke dalam elemen-elemen input dalam modal
                        document.getElementById('e_Product').value = product_name;
                        document.getElementById('e_ProductId').value = product_id;
                        document.getElementById('e_batch').value = batch;
                        document.getElementById('e_qty').value = qty;
                        document.getElementById('e_Sloc').value = nama_sloc;
                        document.getElementById('e_SlocId').value = sloc_id;
                        document.getElementById('e_StorageBin').value = kode_bin;
                        document.getElementById('e_StorageBinId').value = sbin_id;
                        document.getElementById('e_prod_date').value = prod_date;
                        document.getElementById('e_exp_date').value = exp_date;
                        document.getElementById('e_uuid').value = uuid;

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
