<x-layouts.master>
    <x-slot:head>
        <title>Dashboard | Simerak Web App</title>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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






    <div class="grid grid-cols-3 gap-4 p-3">
        <div class="rounded-lg border-gray-300 dark:border-gray-600 ">
            <div class="max-w-md w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6 m-3">
                <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
                  <div class="flex items-center">
                    <div class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center me-3">
                        <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true">
                        <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M8 8v1h4V8m4 7H4a1 1 0 0 1-1-1V5h14v9a1 1 0 0 1-1 1ZM2 1h16a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Z" />
                    </svg>
                    </div>
                    <div>
                      <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">Transaction </h5>
                      <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Transactions per week</p>
                    </div>
                  </div>
                  <div>

                  </div>
                </div>

                <div id="column-chart"></div>
                  <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                    <div class="flex justify-between items-center pt-5">
                      <!-- Button -->
                      <button
                        id="dropdownDefaultButton"
                        data-dropdown-toggle="lastDaysdropdown"
                        data-dropdown-placement="bottom"
                        class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                        type="button">
                        Last 7 days
                      </button>
                    </div>
                  </div>
              </div>
        </div>
        <div class="rounded-lg border-gray-300 dark:border-gray-600 ">
            <div class="max-w-md w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6 m-3">
                <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
                  <div class="flex items-center">
                    <div class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center me-3">
                        <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true">
                        <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M8 8v1h4V8m4 7H4a1 1 0 0 1-1-1V5h14v9a1 1 0 0 1-1 1ZM2 1h16a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Z" />
                    </svg>
                    </div>
                    <div>
                      <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">New Products </h5>
                      <p class="text-sm font-normal text-gray-500 dark:text-gray-400">New Products per month</p>
                    </div>
                  </div>
                  <div>

                  </div>
                </div>

                <div id="column-chart-products"></div>
                  <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                    <div class="flex justify-between items-center pt-5">
                      <!-- Button -->
                      <button
                        id="dropdownDefaultButton"
                        data-dropdown-toggle="lastDaysdropdown"
                        data-dropdown-placement="bottom"
                        class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                        type="button">
                        Last 1 months
                      </button>
                    </div>
                  </div>
              </div>
        </div>
        <div class="rounded-lg border-gray-300 dark:border-gray-600 ">
            <div class="max-w-md w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6 m-3">
                <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
                  <div class="flex items-center">
                    <div class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center me-3">
                        <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true">
                        <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M8 8v1h4V8m4 7H4a1 1 0 0 1-1-1V5h14v9a1 1 0 0 1-1 1ZM2 1h16a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Z" />
                    </svg>
                    </div>
                    <div>
                      <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">New Locations </h5>
                      <p class="text-sm font-normal text-gray-500 dark:text-gray-400">New Locations per month</p>
                    </div>
                  </div>
                  <div>

                  </div>
                </div>

                <div id="column-chart-locations"></div>
                  <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                    <div class="flex justify-between items-center pt-5">
                      <!-- Button -->
                      <button
                        id="dropdownDefaultButton"
                        data-dropdown-toggle="lastDaysdropdown"
                        data-dropdown-placement="bottom"
                        class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                        type="button">
                        Last 1 months
                      </button>
                    </div>
                  </div>
              </div>
        </div>

    </div>
    <div class="grid grid-cols gap-4 mb-4 p-3">
        <div class="shadow-lg rounded-lg border-gray-300 dark:border-gray-600 -3">
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
                        <th scope="col" class="px-4 py-4">Created By</th>
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
                            <td class="px-4 py-3 max-w-[12rem] truncate ">{{ $row['transaction']['user']['name'] }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <x-slot:js>
        <script>

            let sumIn = @json($sumIn);
            let sumOut = @json($sumOut);
            let countNewProducts = @json($countNewProducts);
            let countNewLocations = @json($countNewLocations);

            const daysOfWeek = [];
            for (let i = 6; i >= 0; i--) {
                const date = new Date();
                date.setDate(date.getDate() - i);
                daysOfWeek.push({
                date: date.toISOString().split('T')[0],
                day: date.toLocaleDateString('en-US', { weekday: 'short' })
                });
            }

            const options = {
            colors: ["#1A56DB", "#FDBA8C"],
            series: [
                {
                name: "IN",
                color: "#1A56DB",
                data: daysOfWeek.map(day => {
                const item = sumIn.find(d => d.date === day.date);
                    return {
                        x: day.day,
                        y: item ? item.total_qty : 0
                    };
                }),
                },
                {
                name: "OUT",
                color: "#FDBA8C",
                data:  daysOfWeek.map(day => {
                const item = sumOut.find(d => d.date === day.date);
                    return {
                        x: day.day,
                        y: item ? item.total_qty : 0
                    };
                }),
                },
            ],
            chart: {
                type: "bar",
                height: "320px",
                fontFamily: "Inter, sans-serif",
                toolbar: {
                show: false,
                },
            },
            plotOptions: {
                bar: {
                horizontal: false,
                columnWidth: "70%",
                borderRadiusApplication: "end",
                borderRadius: 8,
                },
            },
            tooltip: {
                shared: true,
                intersect: false,
                style: {
                fontFamily: "Inter, sans-serif",
                },
            },
            states: {
                hover: {
                filter: {
                    type: "darken",
                    value: 1,
                },
                },
            },
            stroke: {
                show: true,
                width: 0,
                colors: ["transparent"],
            },
            grid: {
                show: false,
                strokeDashArray: 4,
                padding: {
                left: 2,
                right: 2,
                top: -14
                },
            },
            dataLabels: {
                enabled: false,
            },
            legend: {
                show: false,
            },
            xaxis: {
                floating: false,
                labels: {
                show: true,
                style: {
                    fontFamily: "Inter, sans-serif",
                    cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                }
                },
                axisBorder: {
                show: false,
                },
                axisTicks: {
                show: false,
                },
            },
            yaxis: {
                show: false,
            },
            fill: {
                opacity: 1,
            },
            }

            const products = {
            colors: ["#1A56DB", "#FDBA8C"],
            series: [
                {
                name: "New Products",
                color: "#1A56DB",
                data: daysOfWeek.map(day => {
                    const item = countNewProducts.find(d => d.date === day.date);
                        return {
                            x: day.day,
                            y: item ? item.total_qty : 0
                        };
                    }),
                }

            ],
            chart: {
                type: "bar",
                height: "320px",
                fontFamily: "Inter, sans-serif",
                toolbar: {
                show: false,
                },
            },
            plotOptions: {
                bar: {
                horizontal: false,
                columnWidth: "70%",
                borderRadiusApplication: "end",
                borderRadius: 8,
                },
            },
            tooltip: {
                shared: true,
                intersect: false,
                style: {
                fontFamily: "Inter, sans-serif",
                },
            },
            states: {
                hover: {
                filter: {
                    type: "darken",
                    value: 1,
                },
                },
            },
            stroke: {
                show: true,
                width: 0,
                colors: ["transparent"],
            },
            grid: {
                show: false,
                strokeDashArray: 4,
                padding: {
                left: 2,
                right: 2,
                top: -14
                },
            },
            dataLabels: {
                enabled: false,
            },
            legend: {
                show: false,
            },
            xaxis: {
                floating: false,
                labels: {
                show: true,
                style: {
                    fontFamily: "Inter, sans-serif",
                    cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                }
                },
                axisBorder: {
                show: false,
                },
                axisTicks: {
                show: false,
                },
            },
            yaxis: {
                show: false,
            },
            fill: {
                opacity: 1,
            },
            }

            const locations = {
            colors: ["#1A56DB", "#FDBA8C"],
            series: [
                {
                name: "New Locations",
                color: "#1A56DB",
                data: daysOfWeek.map(day => {
                const item = countNewLocations.find(d => d.date === day.date);
                    return {
                        x: day.day,
                        y: item ? item.total_qty : 0
                    };
                }),
                }

            ],
            chart: {
                type: "bar",
                height: "320px",
                fontFamily: "Inter, sans-serif",
                toolbar: {
                show: false,
                },
            },
            plotOptions: {
                bar: {
                horizontal: false,
                columnWidth: "70%",
                borderRadiusApplication: "end",
                borderRadius: 8,
                },
            },
            tooltip: {
                shared: true,
                intersect: false,
                style: {
                fontFamily: "Inter, sans-serif",
                },
            },
            states: {
                hover: {
                filter: {
                    type: "darken",
                    value: 1,
                },
                },
            },
            stroke: {
                show: true,
                width: 0,
                colors: ["transparent"],
            },
            grid: {
                show: false,
                strokeDashArray: 4,
                padding: {
                left: 2,
                right: 2,
                top: -14
                },
            },
            dataLabels: {
                enabled: false,
            },
            legend: {
                show: false,
            },
            xaxis: {
                floating: false,
                labels: {
                show: true,
                style: {
                    fontFamily: "Inter, sans-serif",
                    cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                }
                },
                axisBorder: {
                show: false,
                },
                axisTicks: {
                show: false,
                },
            },
            yaxis: {
                show: false,
            },
            fill: {
                opacity: 1,
            },
            }

        if(document.getElementById("column-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("column-chart"), options);
        chart.render();
        }
        if(document.getElementById("column-chart-products") && typeof ApexCharts !== 'undefined') {
        const chartProduct = new ApexCharts(document.getElementById("column-chart-products"), products);
        chartProduct.render();
        }
        if(document.getElementById("column-chart-locations") && typeof ApexCharts !== 'undefined') {
        const chartProduct = new ApexCharts(document.getElementById("column-chart-locations"), locations);
        chartProduct.render();
        }

        </script>
    </x-slot:js>
</x-layouts.master>
