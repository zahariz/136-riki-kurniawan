<x-layouts.master>
    <x-slot:head>
        <title>{{ $title }} | Simerak Web App</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

   <div class="grid gird-cols-1 px-4 pt-2 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
    <!-- Right Content -->
    <div class="col-span-full">
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="mb-4 text-xl font-semibold dark:text-white">{{$title}}</h3>
            <form action="{{ route('warehouse.stock-report.filter') }}" method="GET">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product</label>
                        <div class="relative">
                            <input id="Product" type="text" name="product_name" placeholder="Type sku product here.."
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                onkeyup="onKeyUpProduct(event)" />
                            <input id="product_id" type="hidden" name="product" placeholder="Type sku product here.."
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                />
                            <div id="dropdownProduct"
                                class="w-full h-60 border border-gray-300 rounded-md bg-white absolute z-10 overflow-y-auto hidden">
                            </div>
                        </div>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <x-text-input for="batch" id="batch" type="text" name="batch" label="Batch" placeholder="Type batch here.."/>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Storage Location</label>
                        <div class="relative">
                            <input id="Sloc" type="text" name="nama_sloc" placeholder="Type location here.."
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                onkeyup="onKeyUpSloc(event)" />
                            <input id="sloc_id" type="hidden" name="sloc" placeholder="Type location here.."
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                />
                            <div id="dropdownSloc"
                                class="w-full h-60 border border-gray-300 rounded-md bg-white absolute z-10 overflow-y-auto hidden">
                            </div>
                        </div>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Storage Bin</label>

                        <div class="relative">
                            <input id="Sbin" type="text" name="nama_bin" placeholder="Type location here.."
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                onkeyup="onKeyUpSbin(event)" />
                            <input id="sbin_id" type="hidden" name="sbin" placeholder="Type location here.."
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                />
                            <div id="dropdownSbin"
                                class="w-full h-60 border border-gray-300 rounded-md bg-white absolute z-10 overflow-y-auto hidden">
                            </div>
                        </div>
                    </div>
                    <div class="col-span-6 sm:col-span-3 flex items-end">
                        <x-button label="Login" type="submit">Submit</x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

    <x-slot:js>
        <script>

            let products = @json($products);
            let locations = @json($sloc);
            let storageBins = @json($sbin);
            function onKeyUpProduct(e) {
                let keyword = e.target.value;
                let dropdownEl = document.querySelector("#dropdownProduct");
                dropdownEl.classList.remove("hidden");
                let filteredProducts = products.filter((p) =>
                    p.product_name.toLowerCase().includes(keyword.toLowerCase())
                );

                renderOptionsProduct(filteredProducts, dropdownEl);
            }

            function renderOptionsProduct(options, dropdownEl) {
                let newHtml = ``;

                options.forEach((option) => {
                    newHtml += `<div
                        onclick="selectOptionProduct('${option.product_name}', '${dropdownEl.id}', '${option.id}')"
                        class="p-2.5 border-b border-gray-200 text-stone-600 cursor-pointer hover:bg-slate-100 transition-colors"
                    >
                        ${option.product_name}
                    </div>`;
                });

                dropdownEl.innerHTML = newHtml;
            }

            function selectOptionProduct(selectedOption, dropdownId, productId, ) {
                hideDropdown(dropdownId);
                let inputId = dropdownId.replace("dropdown", "");
                console.log(inputId);
                let input = document.querySelector(`#${inputId}`);
                let product_id = document.getElementById("product_id");
                input.value = selectedOption;
                product_id.value = productId;
            }

            function onKeyUpSloc(e) {
                let keyword = e.target.value;
                let dropdownEl = document.querySelector("#dropdownSloc");
                dropdownEl.classList.remove("hidden");
                let filteredlocations = locations.filter((p) =>
                    p.nama_sloc.toLowerCase().includes(keyword.toLowerCase())
                );

                renderOptionsSloc(filteredlocations, dropdownEl);
            }

            function renderOptionsSloc(options, dropdownEl) {
                let newHtml = ``;

                options.forEach((option) => {
                    newHtml += `<div
                        onclick="selectOptionSloc('${option.nama_sloc}', '${dropdownEl.id}', '${option.id}')"
                        class="p-2.5 border-b border-gray-200 text-stone-600 cursor-pointer hover:bg-slate-100 transition-colors"
                    >
                        ${option.nama_sloc}
                    </div>`;
                });

                dropdownEl.innerHTML = newHtml;
            }

            function selectOptionSloc(selectedOption, dropdownId, slocId, ) {
                hideDropdown(dropdownId);
                let inputId = dropdownId.replace("dropdown", "");
                console.log(inputId);
                let input = document.querySelector(`#${inputId}`);
                let sloc_id = document.getElementById("sloc_id");
                input.value = selectedOption;
                sloc_id.value = slocId;
            }

            function onKeyUpSbin(e) {
                let keyword = e.target.value;
                let dropdownEl = document.querySelector("#dropdownSbin");
                dropdownEl.classList.remove("hidden");
                let filteredStorageBin = storageBins.filter((p) =>
                    p.kode_bin.toLowerCase().includes(keyword.toLowerCase())
                );

                renderOptionsSbin(filteredStorageBin, dropdownEl);
            }

            function renderOptionsSbin(options, dropdownEl) {
                let newHtml = ``;

                options.forEach((option) => {
                    newHtml += `<div
                        onclick="selectOptionSbin('${option.kode_bin}', '${dropdownEl.id}', '${option.id}')"
                        class="p-2.5 border-b border-gray-200 text-stone-600 cursor-pointer hover:bg-slate-100 transition-colors"
                    >
                        ${option.kode_bin}
                    </div>`;
                });

                dropdownEl.innerHTML = newHtml;
            }

            function selectOptionSbin(selectedOption, dropdownId, sbinId, ) {
                hideDropdown(dropdownId);
                let inputId = dropdownId.replace("dropdown", "");
                console.log(inputId);
                let input = document.querySelector(`#${inputId}`);
                let sbin_id = document.getElementById("sbin_id");
                input.value = selectedOption;
                sbin_id.value = sbinId;
            }

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
            });

        </script>
    </x-slot:js>
</x-layouts.master>
