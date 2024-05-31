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
                    <form action="{{ route('user.update', $data['id']) }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-6 gap-6 p-3">

                            <div class="col-span-6 sm:col-span-3">
                                <x-text-input for="name" id="name" type="text" autocomplete="off" name="name"
                                    label="Name" placeholder="Type name here.." value="{{ $data['name'] }}">
                                    @error('name')
                                        <x-slot:message>{{ $message }}</x-slot:message>
                                    @enderror
                                </x-text-input>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <x-text-input for="username" id="username" type="text" autocomplete="off" name="username"
                                    label="Username" placeholder="Type username here.." value="{{ $data['username'] }}">
                                    @error('username')
                                        <x-slot:message>{{ $message }}</x-slot:message>
                                    @enderror
                                </x-text-input>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <x-select-input for="role_id" autocomplete="off" id="role_id" type="text"
                                    name="role_id" label="Role" >
                                    @foreach ($role as $row)
                                    <option value="{{ $row['id'] }}" {{ $row['id'] == $data['role_id'] ? 'selected' : '' }}>{{ $row['role_name'] }}</option>
                                    @endforeach

                                    @error('qty')
                                        <x-slot:message>{{ $message }}</x-slot:message>
                                    @enderror
                                </x-select-input>
                            </div>
                            <div class="col-span-6 sm:col-span-3 flex items-end">
                                <button type="submit" class="flex items-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Save</button>
                            </div>
                        </div>
                    </form>

            </div>
        </div>
    </section>
    <!-- End block -->

    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
        <div class="mx-auto max-w-screen-3xl px-4 lg:px-12">

            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <h5 id="drawer-label"
                    class="inline-flex items-center text-sm font-semibold text-gray-500 p-6 uppercase dark:text-gray-400">
                    Change Password</h5>
                    <form action="{{ route('user.update.password', $data['id']) }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-6 gap-6 p-3">

                            <div class="col-span-6 sm:col-span-3">
                                <x-text-input for="password" id="password" type="password" autocomplete="off" name="password"
                                    label="Password" placeholder="Type password here.." >
                                    @error('password')
                                        <x-slot:message>{{ $message }}</x-slot:message>
                                    @enderror
                                </x-text-input>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <x-text-input for="confirm-password" id="confirm-password" type="password" autocomplete="off" name="confirm-password"
                                    label="Confirm Password" placeholder="Type confirm password here..">
                                    @error('confirm-password')
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
    </section>

    <x-slot:js>
        <script>
            document.addEventListener("DOMContentLoaded", function() {




                document.addEventListener('click', function(event) {


                    if(event.target.classList.contains('delete-user')) {
                        var row = event.target.closest('tr');

                        // Ambil nilai dari setiap kolom dalam baris tabel

                        var userId = event.target.dataset.userId;
                        document.getElementById('actionDelete').action = `/user/${userId}/destroy`;


                        // Masukkan nilai-nilai tersebut ke dalam elemen-elemen input dalam modal
                        document.getElementById('d_id').value = userId;
                    }


                });

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
