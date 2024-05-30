<aside id="sidebar"
    class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 hidden w-64 h-full pt-16 font-normal duration-75 lg:flex transition-width"
    aria-label="Sidebar">
    <div
        class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
            <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                <ul class="pb-2 space-y-2">
                    <li>
                        <form action="index.html#" method="GET" class="lg:hidden">
                            <label for="mobile-search" class="sr-only">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="text" name="email" id="mobile-search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-200 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Search">
                            </div>
                        </form>
                    </li>
                    <x-side-link href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-primary-500 hover:bg-primary-700 text-white' : '' }}">
                        <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white {{ request()->routeIs('dashboard') ? ' text-white' : '' }}"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                        </svg>
                        <span class="ml-3" sidebar-toggle-item>Dashboard</span>
                    </x-side-link>
                    @if (Auth::user()->role_id == 1)
                    <x-side-link-group toggleName="master" title="Master Data" class="{{ request()->routeIs(['category', 'product', 'sbin', 'sloc', 'roles']) ? '' : 'hidden' }}">
                        <x-slot:svg>
                            <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                aria-hidden="true">
                                <path
                                    clip-rule="evenodd"
                                    fill-rule="evenodd"
                                    d="M.99 5.24A2.25 2.25 0 013.25 3h13.5A2.25 2.25 0 0119 5.25l.01 9.5A2.25 2.25 0 0116.76 17H3.26A2.267 2.267 0 011 14.74l-.01-9.5zm8.26 9.52v-.625a.75.75 0 00-.75-.75H3.25a.75.75 0 00-.75.75v.615c0 .414.336.75.75.75h5.373a.75.75 0 00.627-.74zm1.5 0a.75.75 0 00.627.74h5.373a.75.75 0 00.75-.75v-.615a.75.75 0 00-.75-.75H11.5a.75.75 0 00-.75.75v.625zm6.75-3.63v-.625a.75.75 0 00-.75-.75H11.5a.75.75 0 00-.75.75v.625c0 .414.336.75.75.75h5.25a.75.75 0 00.75-.75zm-8.25 0v-.625a.75.75 0 00-.75-.75H3.25a.75.75 0 00-.75.75v.625c0 .414.336.75.75.75H8.5a.75.75 0 00.75-.75zM17.5 7.5v-.625a.75.75 0 00-.75-.75H11.5a.75.75 0 00-.75.75V7.5c0 .414.336.75.75.75h5.25a.75.75 0 00.75-.75zm-8.25 0v-.625a.75.75 0 00-.75-.75H3.25a.75.75 0 00-.75.75V7.5c0 .414.336.75.75.75H8.5a.75.75 0 00.75-.75z"
                                ></path>
                            </svg>
                        </x-slot:svg>
                        <x-side-link href="{{ route('roles') }}" class="transition duration-75 rounded-lg pl-11 {{ request()->routeIs('roles') ? 'bg-primary-500 hover:bg-primary-700 text-white' : '' }}" title="Role" />
                        <x-side-link href="{{ route('category') }}" class="transition duration-75 rounded-lg pl-11 {{ request()->routeIs('category') ? 'bg-primary-500 hover:bg-primary-700 text-white' : '' }}" title="Category" />
                        <x-side-link href="{{ route('product') }}" class=" transition duration-75 rounded-lg pl-11 {{ request()->routeIs('product') ? 'bg-primary-500 hover:bg-primary-700 text-white' : '' }}" title="Product" />
                        <x-side-link href="{{ route('sloc') }}" class=" transition duration-75 rounded-lg pl-11 {{ request()->routeIs('sloc') ? 'bg-primary-500 hover:bg-primary-700 text-white' : '' }}" title="Storage Location" />
                        <x-side-link href="{{ route('sbin') }}" class=" transition duration-75 rounded-lg pl-11 {{ request()->routeIs('sbin') ? 'bg-primary-500 hover:bg-primary-700 text-white' : '' }}" title="Storage Bin" />
                    </x-side-link-group>
                    @endif

                    <x-side-link-group toggleName="warehouse" title="Warehouse" class="{{ request()->routeIs(['warehouse.stock-report', 'warehouse.receiving', 'warehouse.remove-from-storage', 'warehouse.*']) ? '' : 'hidden' }}">
                        <x-slot:svg>
                            <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                aria-hidden="true">
                                <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M8 8v1h4V8m4 7H4a1 1 0 0 1-1-1V5h14v9a1 1 0 0 1-1 1ZM2 1h16a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Z" />
                            </svg>
                        </x-slot:svg>
                        <x-side-link href="{{ route('warehouse.receiving') }}" class="transition duration-75 rounded-lg pl-11 {{ request()->routeIs(['warehouse.receiving','warehouse.receiving.*']) ? 'bg-primary-500 hover:bg-primary-700 text-white' : '' }}" title="Receiving" />
                        <x-side-link href="{{ route('warehouse.remove-from-storage') }}" class=" transition duration-75 rounded-lg pl-11 {{ request()->routeIs(['warehouse.remove-from-storage','warehouse.remove-from-storage.*']) ? 'bg-primary-500 hover:bg-primary-700 text-white' : '' }}" title="Remove From Storage" />
                        <x-side-link href="{{ route('warehouse.stock-report') }}" class=" transition duration-75 rounded-lg pl-11 {{ request()->routeIs(['warehouse.stock-report','warehouse.stock-report.*']) ? 'bg-primary-500 hover:bg-primary-700 text-white' : '' }}" title="Stock Report" />
                        <x-side-link href="{{ route('warehouse.history') }}" class=" transition duration-75 rounded-lg pl-11 {{ request()->routeIs(['warehouse.history','warehouse.history.*']) ? 'bg-primary-500 hover:bg-primary-700 text-white' : '' }}" title="History" />
                    </x-side-link-group>
                </ul>
                @if (Auth::user()->role_id == 1)

                <div class="pt-2 space-y-2">
                    <a href="{{ route('users') }}"
                        class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700 {{ request()->routeIs(['users', 'user.edit']) ? 'bg-primary-500 hover:bg-primary-700 text-white' : '' }}">
                        <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white {{ request()->routeIs(['users', 'user.edit']) ? ' text-white' : '' }}" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                </path>
                            </svg>
                        <span class="ml-3" sidebar-toggle-item>Users</span>
                    </a>

                </div>
                @endif

            </div>
        </div>

    </div>
</aside>
