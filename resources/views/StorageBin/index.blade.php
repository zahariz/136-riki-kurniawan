<x-layouts.master>
    <x-slot:head>
        <title>{{ $title }} | Simerak Web App</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </x-slot:head>
    <div class="grid grid-cols-1 px-4 pt-6 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <x-breadcumb>
                <x-breadcumb-head route="/home" title="Dashboard" />
                <x-breadcumb-link route="#" current="true" :title="$title" />
            </x-breadcumb>
        </div>
    </div>

    <!-- Right Content -->
    <!-- Start block -->
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
                        <form action="{{ route('sbin') }}" method="GET" class="flex items-center">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative flex items-center justify-between">
                                <x-text-input class="w-full mr-2" type="text" id="simple-search" placeholder="Search" name="search" />
                                <x-button type="submit">Search</x-button>
                                <a href="{{ route('sbin') }}" type="button" id="reset-button" class="text-gray-600 hover:text-gray-700 dark:text-white underline text-sm ml-2">Reset</a>

                            </div>
                        </form>
                    </div>
                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <x-button type="button" id="createBinModalButton" data-modal-target="createBinModal"
                            data-modal-toggle="createBinModal" class="flex items-center">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Add bin
                        </x-button>

                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-4">Kode Bin</th>
                                <th scope="col" class="px-4 py-4">Storage Bin</th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr class="border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white kode_bin">
                                        {{ $row['kode_bin'] }}</th>
                                    <td class="px-4 py-3 max-w-[12rem] truncate nama_bin">{{ $row['nama_bin'] }}</td>
                                    <td class="px-4 py-3 flex items-center justify-end">
                                        <button id="{{ $row['nama_bin'] }}-dropdown-button"
                                            data-dropdown-toggle="{{ $row['nama_bin'] }}-dropdown"
                                            class="inline-flex items-center text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 dark:hover-bg-gray-800 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                            type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div id="{{ $row['nama_bin'] }}-dropdown"
                                            class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-1 text-sm"
                                                aria-labelledby="{{ $row['nama_bin'] }}-dropdown-button">
                                                <li>
                                                    <button type="button" data-modal-target="updateBinModal"
                                                        data-modal-toggle="updateBinModal"
                                                        class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200 edit-bin" data-sbin-id="{{ $row['id'] }}">
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
                                                        class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 text-red-500 dark:hover:text-red-400 delete-bin" data-sbin-id="{{ $row['id'] }}">
                                                        <svg class="w-4 h-4 mr-2" viewbox="0 0 14 15" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                fill="currentColor"
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
                {{ $data->links('pagination::tailwind') }}

            </div>
        </div>
    </section>
    <!-- End block -->
    <!-- Create modal -->
    <x-modal-form id="createBinModal" data-modal-hide="createBinModal" action="{{ route('sbin.store') }}" method="POST"
        title-modal="Create Bin">
        @csrf
        <div>
            <x-text-input for="kode_bin" type="text" name="kode_bin" id="kode_bin" label="Kode Bin"
                placeholder="Ex. MH0101" />
        </div>
        <div class="sm:col-span-2">
            <x-text-input for="nama_bin" type="text" name="nama_bin" id="nama_bin" label="Nama Bin"
                placeholder="Ex. Rak MH Ganjil Level 1" />
        </div>
        <x-slot:labelBtn>
            Create
        </x-slot:labelBtn>
    </x-modal-form>

    <!-- Update modal -->
    <x-modal-form id="updateBinModal" data-modal-hide="updateBinModal" action="" method="PUT"
        title-modal="Update Bin">
        @csrf
        <div>
            <x-text-input for="kode_bin" type="text" name="kode_bin" id="e_kode_bin" label="Kode Bin"
                placeholder="Ex. MH0101" />
        </div>
        <div class="sm:col-span-2">
            <x-text-input for="nama_bin" type="text" name="nama_bin" id="e_nama_bin" label="Nama Bin"
                placeholder="Ex. Rak MH Ganjil Level 1" />
        </div>
        <x-slot:labelBtn>
            Update
        </x-slot:labelBtn>
    </x-modal-form>

    <!-- Delete modal -->
    <div id="deleteModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <form id="actionDelete" action="" method="DELETE">
            @csrf
            <div class="sm:col-span-2 hidden">
                <x-text-input for="id" id="d_id" type="text" name="id" label="id"
                    placeholder="Type id here.." />
            </div>
        <x-modal-confirmation data-modal-hide="deleteModal">
            <x-slot:text>
                Are you sure want to delete this category ?
            </x-slot:text>
        </x-modal-confirmation>
        </form>
    </div>
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

                document.addEventListener('click', function(event) {
                    // Periksa apakah yang diklik adalah tombol dengan kelas 'edit_expense'
                    if (event.target.classList.contains('edit-bin')) {
                        // Temukan elemen tr terdekat dari tombol yang diklik
                        var row = event.target.closest('tr');
                        var sbinId = event.target.dataset.sbinId;

                        // Ambil nilai dari setiap kolom dalam baris tabel
                        var kode_bin = row.querySelector('.kode_bin').innerText;
                        var nama_bin = row.querySelector('.nama_bin').innerText;

                        // Masukkan nilai-nilai tersebut ke dalam elemen-elemen input dalam modal
                        document.getElementById('e_kode_bin').value = kode_bin;
                        document.getElementById('e_nama_bin').value = nama_bin;
                        document.getElementById('updateBinModal').querySelector('form').action = `/sbin/${sbinId}/update`;


                    }
                    if(event.target.classList.contains('delete-bin')) {
                        var row = event.target.closest('tr');

                        // Ambil nilai dari setiap kolom dalam baris tabel

                        var sbinId = event.target.dataset.sbinId;
                        document.getElementById('actionDelete').action = `/sbin/${sbinId}/destroy`;


                        // Masukkan nilai-nilai tersebut ke dalam elemen-elemen input dalam modal
                        document.getElementById('d_id').value = sbinId;
                    }




                });
            });
        </script>
    </x-slot:js>
</x-layouts.master>
