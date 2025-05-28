<div>
    @php
        $role = auth()->user()?->role;
    @endphp
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div>
        @if ($role === 'admin')
            <div class="p-8 grid gap-8 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2">
                <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2">
                    <div class="flex items-center justify-center">
                        <div class="text-center w-1/2">
                            <div class="block rounded-t-md overflow-hidden  text-center">
                                <div
                                    class="bg-gradient-to-r from-sky-200 to-blue-300 dark:from-slate-800 dark:to-blue-950 dark:text-white text-black py-2">
                                    {{ now()->format('F') }}
                                </div>
                                <div class="bg-white border-x-2">
                                    <span class="text-5xl font-bold text-slate-700">
                                        {{ now()->format('d') }}
                                    </span>
                                </div>
                                <div class="text-center bg-white rounded-b-md border-2 border-t-0">
                                    <span class="text-sm text-slate-700">
                                        {{ now()->format('l') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex flex-col justify-between bg-gradient-to-r from-blue-300 to-indigo-300 dark:from-blue-950 dark:to-indigo-950  rounded-lg shadow-lg p-8">
                        <div class="flex justify-between">
                            <div class="dark:text-white text-black">
                                <div class="text-lg ">{{ __('Weather in Calama') }}</div>
                                <div>{{ 'Condition: ' . $condition }}</div>
                                <div class="text-sm">{{ 'Temperature: ' . $temperature }}</div>
                            </div>
                            @if ($icon)
                                <img src="https:{{ $icon }}" alt="Weather icon" class="w-24 h-24">
                            @endif
                        </div>
                        <a target="_blank" href="https://www.weatherapi.com/"
                            class="bg-white hover:bg-gray-200 text-indigo-950 font-bold py-2 px-4 rounded w-fit">
                            {{ __('Use this API') }}
                        </a>
                    </div>
                    <div
                        class="flex flex-col justify-between bg-gradient-to-r dark:from-slate-800 dark:to-blue-950 from-sky-200 to-blue-300 rounded-lg shadow-lg p-8">
                        <p class="text-lg dark:text-white text-black mb-8">{{ 'Some advice: ' . $advice }} </p>
                        <a target="_blank" href="https://api.adviceslip.com/"
                            class="bg-white hover:bg-gray-200 text-blue-950 font-bold py-2 px-4 rounded w-fit">
                            {{ __('Use this API') }}
                        </a>
                    </div>
                    <div
                        class="flex flex-col justify-between bg-gradient-to-r from-blue-300 to-indigo-300 dark:from-blue-950 dark:to-indigo-950  rounded-lg shadow-lg p-8">
                        <p class="text-lg dark:text-white text-black mb-8">{{ 'Some joke: ' . $joke }} </p>
                        <a target="_blank" href="https://sv443.net/jokeapi/v2/#getting-started"
                            class="bg-white hover:bg-gray-200 text-indigo-950 font-bold py-2 px-4 rounded w-fit">
                            {{ __('Use this API') }}
                        </a>
                    </div>
                </div>
                <div class="p-4 bg-slate-50 dark:bg-slate-800 rounded-xl shadow">
                    <h2 class="text-xl mb-4">{{ __('Monthly sales') }}</h2>
                    <div id="sales-chart" wire:ignore class="h-[350px]"></div>
                </div>
                <div class="p-4 bg-slate-50 dark:bg-slate-800 rounded-xl shadow">
                    <h2 class="text-xl mb-4">{{ __('Top products') }}</h2>
                    <div id="top-products-chart" wire:ignore class="h-[350px]"></div>
                </div>
                <div class="p-4 bg-slate-50 dark:bg-slate-800 rounded-xl shadow">
                    <h2 class="text-xl mb-4">{{ __('New users per month') }}</h2>
                    <div id="new-users-chart" class="w-full h-96 mt-8"></div>
                </div>
            </div>
        @elseif ($role === 'seller')
            <div class="p-8 grid gap-8 max-sm:grid-cols-1 grid-cols-2">
                <div class="grid grid-cols-2 gap-2">
                    <div class="flex items-center justify-center">
                        <div class="text-center w-1/4 max-sm:w-full max-sm:pt-4">
                            <div class="block rounded-t-md overflow-hidden  text-center">
                                <div
                                    class="bg-gradient-to-r from-sky-200 to-blue-300 dark:from-slate-800 dark:to-blue-950 dark:text-white text-black py-2">
                                    {{ now()->format('F') }}
                                </div>
                                <div class="bg-white border-x-2">
                                    <span class="text-5xl font-bold text-slate-700">
                                        {{ now()->format('d') }}
                                    </span>
                                </div>
                                <div class="text-center bg-white rounded-b-md border-2 border-t-0">
                                    <span class="text-sm text-slate-700">
                                        {{ now()->format('l') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex flex-col justify-between bg-gradient-to-r from-blue-300 to-indigo-300 dark:from-blue-950 dark:to-indigo-950  rounded-lg shadow-lg p-8">
                        <div class="flex justify-between">
                            <div class="dark:text-white text-black">
                                <div class="text-lg ">{{ __('Weather in Calama') }}</div>
                                <div>{{ 'Condition: ' . $condition }}</div>
                                <div class="text-sm">{{ 'Temperature: ' . $temperature }}</div>
                            </div>
                            @if ($icon)
                                <img src="https:{{ $icon }}" alt="Weather icon" class="w-24 h-24">
                            @endif
                        </div>
                        <a target="_blank" href="https://www.weatherapi.com/"
                            class="bg-white hover:bg-gray-200 text-indigo-950 font-bold py-2 px-4 rounded w-fit">
                            {{ __('Use this API') }}
                        </a>
                    </div>
                    <div
                        class="flex flex-col justify-between bg-gradient-to-r dark:from-slate-800 dark:to-blue-950 from-sky-200 to-blue-300 rounded-lg shadow-lg p-8">
                        <p class="text-lg dark:text-white text-black mb-8">{{ 'Some advice: ' . $advice }} </p>
                        <a target="_blank" href="https://api.adviceslip.com/"
                            class="bg-white hover:bg-gray-200 text-blue-950 font-bold py-2 px-4 rounded w-fit">
                            {{ __('Use this API') }}
                        </a>
                    </div>
                    <div
                        class="flex flex-col justify-between bg-gradient-to-r from-blue-300 to-indigo-300 dark:from-blue-950 dark:to-indigo-950  rounded-lg shadow-lg p-8">
                        <p class="text-lg dark:text-white text-black mb-8">{{ 'Some joke: ' . $joke }} </p>
                        <a target="_blank" href="https://sv443.net/jokeapi/v2/#getting-started"
                            class="bg-white hover:bg-gray-200 text-indigo-950 font-bold py-2 px-4 rounded w-fit">
                            {{ __('Use this API') }}
                        </a>
                    </div>
                </div>
                <div class="p-4 bg-slate-50 dark:bg-slate-800 rounded-xl shadow">
                    <h2 class="text-xl mb-4">{{ __('Top products') }}</h2>
                    <div id="top-products-chart" wire:ignore class="h-[350px]"></div>
                </div>
            </div>
        @elseif ($role === 'user')
            <div class="p-8 grid gap-8 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                <div class="grid grid-cols-2 gap-2">
                    <div class="flex items-center justify-center">
                        <div class="text-center lg:w-1/2 md:w-1/2 sm:w-full max-sm:w-full max-sm:pt-4">
                            <div class="block rounded-t-md overflow-hidden  text-center">
                                <div
                                    class="bg-gradient-to-r from-sky-200 to-blue-300 dark:from-slate-800 dark:to-blue-950 dark:text-white text-black py-2">
                                    {{ now()->format('F') }}
                                </div>
                                <div class="bg-white border-x-2">
                                    <span class="text-5xl font-bold text-slate-700">
                                        {{ now()->format('d') }}
                                    </span>
                                </div>
                                <div class="text-center bg-white rounded-b-md border-2 border-t-0">
                                    <span class="text-sm text-slate-700">
                                        {{ now()->format('l') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex flex-col justify-between bg-gradient-to-r from-blue-300 to-indigo-300 dark:from-blue-950 dark:to-indigo-950  rounded-lg shadow-lg p-8">
                        <div class="flex justify-between">
                            <div class="dark:text-white text-black">
                                <div class="text-lg ">{{ __('Weather in Calama') }}</div>
                                <div>{{ 'Condition: ' . $condition }}</div>
                                <div class="text-sm">{{ 'Temperature: ' . $temperature }}</div>
                            </div>
                            @if ($icon)
                                <img src="https:{{ $icon }}" alt="Weather icon" class="w-24 h-24">
                            @endif
                        </div>
                        <a target="_blank" href="https://www.weatherapi.com/"
                            class="bg-white hover:bg-gray-200 text-indigo-950 font-bold py-2 px-4 rounded w-fit">
                            {{ __('Use this API') }}
                        </a>
                    </div>
                    <div
                        class="flex flex-col justify-between bg-gradient-to-r dark:from-slate-800 dark:to-blue-950 from-sky-200 to-blue-300 rounded-lg shadow-lg p-8">
                        <p class="text-lg dark:text-white text-black mb-8">{{ 'Some advice: ' . $advice }} </p>
                        <a target="_blank" href="https://api.adviceslip.com/"
                            class="bg-white hover:bg-gray-200 text-blue-950 font-bold py-2 px-4 rounded w-fit">
                            {{ __('Use this API') }}
                        </a>
                    </div>
                    <div
                        class="flex flex-col justify-between bg-gradient-to-r from-blue-300 to-indigo-300 dark:from-blue-950 dark:to-indigo-950  rounded-lg shadow-lg p-8">
                        <p class="text-lg dark:text-white text-black mb-8">{{ 'Some joke: ' . $joke }} </p>
                        <a target="_blank" href="https://sv443.net/jokeapi/v2/#getting-started"
                            class="bg-white hover:bg-gray-200 text-indigo-950 font-bold py-2 px-4 rounded w-fit">
                            {{ __('Use this API') }}
                        </a>
                    </div>
                </div>
                <div class="p-4 bg-slate-50 dark:bg-slate-800 rounded-xl shadow">
                    <h2 class="text-xl mb-4">{{ __('Last three orders') }}</h2>
                    <div class="flex gap-2 overflow-x-hidden pb-2">
                        @foreach ($orders as $order)
                            <div
                                class="bg-slate-100 dark:bg-slate-800 rounded-lg w-1/3 flex-shrink-0 h-[450px] overflow-hidden">
                                <div class="p-4 overflow-y-auto h-full">
                                    <p class="text-lg sm:text-xl font-semibold mb-2">{{ 'Order #' . $order->id }}
                                    </p>

                                    @foreach ($order->items as $item)
                                        <div class="flex justify-between items-center border-b border-slate-500 py-2">
                                            <div class="text-xs sm:text-sm">
                                                <p>{{ $item['title'] }}</p>
                                                <p>{{ '$' . $item['price'] . ' x ' . $item['quantity'] }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                    <p class="font-semibold text-base sm:text-lg mt-4">
                                        {{ __('Total:') . ' $' . number_format($order->total_price, 2) }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="p-4 bg-slate-50 dark:bg-slate-800 rounded-xl shadow">
                    <h2 class="text-xl mb-4">{{ __('Orders status') }}</h2>
                    <div id="orders-status" class="w-full h-96 mt-8"></div>
                </div>
            </div>

        @endif
        <livewire:toast-message />
        <script>
            const isDark = document.documentElement.classList.contains('dark');
            document.addEventListener('DOMContentLoaded', function() {
                const chart = new ApexCharts(document.querySelector("#sales-chart"), {
                    chart: {
                        type: 'line',
                        height: 400,
                        foreColor: '#697477',
                    },
                    tooltip: {
                        theme: isDark ? 'dark' : 'light',
                        style: {
                            fontSize: '14px',
                            fontFamily: undefined
                        },
                        custom: function({
                            series,
                            seriesIndex,
                            dataPointIndex,
                            w
                        }) {
                            const value = series[seriesIndex][dataPointIndex];
                            const category = w.globals.labels[dataPointIndex];
                            return `<div style=" color:${isDark ? '#f3f4f6' : '#333'}; padding:8px; border-radius:4px;">
                                                <strong>${category}</strong><br>
                                                Sales: $${value.toLocaleString()}
                                            </div>`;
                        }
                    },
                    series: [{
                        name: "Sales",
                        data: @json($chartData['totals']),
                    }],
                    xaxis: {
                        categories: @json($chartData['months'])
                    },
                });

                chart.render();
            });
            document.addEventListener('DOMContentLoaded', function() {
                const data = @json($mostSoldData);
                const chart = new ApexCharts(document.querySelector("#top-products-chart"), {
                    chart: {
                        type: 'bar',
                        height: 400,
                        foreColor: '#697477',
                    },
                    tooltip: {
                        theme: isDark ? 'dark' : 'light',
                        style: {
                            fontSize: '14px',
                            fontFamily: undefined
                        },
                        custom: function({
                            series,
                            seriesIndex,
                            dataPointIndex,
                            w
                        }) {
                            const value = series[seriesIndex][dataPointIndex];
                            const category = w.globals.labels[dataPointIndex];
                            return `<div style=" color:${isDark ? '#f3f4f6' : '#333'}; padding:8px; border-radius:4px;">
                                                <strong>${category}</strong><br>
                                                Quantity: $${value.toLocaleString()}
                                            </div>`;
                        }
                    },
                    series: [{
                        name: "Quantity",
                        data: data.data
                    }],
                    xaxis: {
                        categories: data.labels
                    },
                });

                chart.render();
            });
            document.addEventListener('DOMContentLoaded', function() {
                const data = @json($usersPerMonthData);
                const chart = new ApexCharts(document.querySelector("#new-users-chart"), {
                    chart: {
                        type: 'line',
                        height: 400,
                        foreColor: '#697477',
                    },
                    tooltip: {
                        theme: isDark ? 'dark' : 'light',
                        style: {
                            fontSize: '14px',
                            fontFamily: undefined
                        },
                        custom: function({
                            series,
                            seriesIndex,
                            dataPointIndex,
                            w
                        }) {
                            const value = series[seriesIndex][dataPointIndex];
                            const category = w.globals.labels[dataPointIndex];
                            return `<div style=" color:${isDark ? '#f3f4f6' : '#333'}; padding:8px; border-radius:4px;">
                                                <strong>${category}</strong><br>
                                                New users: $${value.toLocaleString()}
                                            </div>`;
                        }
                    },
                    series: [{
                        name: 'New users',
                        data: data.data
                    }],
                    xaxis: {
                        categories: data.labels
                    }
                });

                chart.render();
            });
            document.addEventListener('DOMContentLoaded', function() {
                const data = @json(array_values($ordersStatus));
                const labels = @json(array_keys($ordersStatus));

                const chart = new ApexCharts(document.querySelector("#orders-status"), {
                    chart: {
                        type: 'donut',
                        height: 400,
                        foreColor: '#697477',
                    },
                    series: data,
                    labels: labels,
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 300
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                });

                chart.render();
            });
        </script>
    </div>
</div>
