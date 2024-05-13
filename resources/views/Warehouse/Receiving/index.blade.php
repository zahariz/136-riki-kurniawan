<x-layouts.master>
    <x-slot name="head">
        <title>{{ $title }} | Simerak Web App</title>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ URL::to('css/custom.css') }}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

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
            <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <h3 class="mb-4 text-xl font-semibold dark:text-white">{{$title}}</h3>
                <form>
                    <div class="grid grid-cols-6 gap-6">
                        <!-- Dropdown Product -->
                        <div class="col-span-6 sm:col-span-3">
                          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product</label>
                          <div class="relative" onclick="event.stopImmediatePropagation();">
                              <input
                                  id="Product"
                                  type="text"
                                  name="product"
                                  placeholder="Type sku product here.."
                                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                  onkeyup="onKeyUpProduct(event)"
                              />
                              <div
                                  id="dropdownProduct"
                                  class="w-full h-60 border border-gray-300 rounded-md bg-white absolute z-10 overflow-y-auto hidden"
                              ></div>
                          </div>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                          <x-text-input for="batch" id="batch" type="text" name="batch" label="Batch" placeholder="Type batch number here.."/>
                        </div>
                        <!-- Dropdown Storage Location -->
                        <div class="col-span-6 sm:col-span-3">
                          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Storage Location</label>
                          <div class="relative" onclick="event.stopImmediatePropagation();">
                              <input
                                  id="Sloc"
                                  type="text"
                                  name="sloc"
                                  placeholder="Type storage location code here.."
                                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                  onkeyup="onKeyUpSloc(event)"
                              />
                              <div
                                  id="dropdownSloc"
                                  class="w-full h-60 border border-gray-300 rounded-md bg-white absolute z-10 overflow-y-auto hidden"
                              ></div>
                          </div>
                        </div>
                        <!-- Dropdown Storage Bin -->
                        <div class="col-span-6 sm:col-span-3">
                          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Storage Bin</label>
                          <div class="relative" onclick="event.stopImmediatePropagation();">
                              <input
                                  id="StorageBin"
                                  type="text"
                                  name="storageBin"
                                  placeholder="Type storage bin here.."
                                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                  onkeyup="onKeyUpStorageBin(event)"
                              />
                              <div
                                  id="dropdownStorageBin"
                                  class="w-full h-60 border border-gray-300 rounded-md bg-white absolute z-10 overflow-y-auto hidden"
                              ></div>
                          </div>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Production Date</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                   <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                      <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div>
                                <input datepicker datepicker-format="dd/mm/yyyy" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                              </div>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Expired Date</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                   <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                      <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div>
                                <input datepicker datepicker-format="dd/mm/yyyy" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                              </div>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-text-input for="qty" id="qty" type="number" name="qty" label="Qty" placeholder="Type qty here.."/>
                        </div>
                        <div class="col-span-6 sm:col-span-3 flex items-end">
                            <x-button onclick="generateTable()" label="Login">Save</x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <x-slot name="js">
        <script>
             // Data untuk dropdown
            let products = [
                { name: "Product 1", code: "P1" },
                { name: "Product 2", code: "P2" },
                // Tambahkan data produk lainnya sesuai kebutuhan
            ];

            let locations = [
                { name: "Location 1", code: "L1" },
                { name: "Location 2", code: "L2" },
                // Tambahkan data lokasi lainnya sesuai kebutuhan
            ];

            let storageBins = [
                { name: "Bin 1", code: "B1" },
                { name: "Bin 2", code: "B2" },
                // Tambahkan data storage bin lainnya sesuai kebutuhan
            ];

            // Fungsi untuk menangani event keyboard pada input produk
            function onKeyUpProduct(e) {
                let keyword = e.target.value;
                let dropdownEl = document.querySelector("#dropdownProduct");
                dropdownEl.classList.remove("hidden");
                let filteredProducts = products.filter((p) =>
                    p.name.toLowerCase().includes(keyword.toLowerCase())
                );

                renderOptions(filteredProducts, dropdownEl);
            }

            // Fungsi untuk menangani event keyboard pada input lokasi penyimpanan
            function onKeyUpSloc(e) {
                let keyword = e.target.value;
                let dropdownEl = document.querySelector("#dropdownSloc");
                dropdownEl.classList.remove("hidden");
                let filteredLocations = locations.filter((l) =>
                    l.name.toLowerCase().includes(keyword.toLowerCase())
                );

                renderOptions(filteredLocations, dropdownEl);
            }

            // Fungsi untuk menangani event keyboard pada input storage bin
            function onKeyUpStorageBin(e) {
                let keyword = e.target.value;
                let dropdownEl = document.querySelector("#dropdownStorageBin");
                dropdownEl.classList.remove("hidden");
                let filteredBins = storageBins.filter((b) =>
                    b.name.toLowerCase().includes(keyword.toLowerCase())
                );

                renderOptions(filteredBins, dropdownEl);
            }

            // Fungsi untuk merender opsi dropdown
            function renderOptions(options, dropdownEl) {
                let newHtml = ``;

                options.forEach((option) => {
                    newHtml += `<div
                        onclick="selectOption('${option.name}', '${dropdownEl.id}')"
                        class="p-2.5 border-b border-gray-200 text-stone-600 cursor-pointer hover:bg-slate-100 transition-colors"
                    >
                        ${option.name}
                    </div>`;
                });

                dropdownEl.innerHTML = newHtml;
            }

            // Fungsi untuk memilih opsi dropdown
            function selectOption(selectedOption, dropdownId) {
                hideDropdown(dropdownId);
                let inputId = dropdownId.replace("dropdown", "");
                console.log(inputId);
                let input = document.querySelector(`#${inputId}`);
                input.value = selectedOption;
            }

            // Sembunyikan dropdown saat dokumen diklik
            document.addEventListener("click", () => {
                hideDropdown("dropdownProduct");
                hideDropdown("dropdownSloc");
                hideDropdown("dropdownStorageBin");
            });

            // Fungsi untuk menyembunyikan dropdown
            function hideDropdown(dropdownId) {
                let dropdownEl = document.querySelector(`#${dropdownId}`);
                dropdownEl.classList.add("hidden");
            }




        </script>
    </x-slot>
</x-layouts.master>
