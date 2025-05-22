<div>
    @php
        $role = auth()->user()?->role;
    @endphp
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{-- <div class="p-4 sm:w-full md:w-full xl:w-1/2 max-sm:w-full"> --}}
    <div class="flex justify-center items-start p-4 ">
        @if ($role === 'admin')
            <div class=" w-1/2">
                <div class="p-4 bg-slate-50 dark:bg-slate-800 rounded-xl shadow">
                    <h2 class="text-xl mb-4">{{ __('Monthly sales') }}</h2>

                    <div id="sales-chart" wire:ignore style="height: 350px;"></div>

                    <script>
                        const isDark = document.documentElement.classList.contains('dark');
                        document.addEventListener('DOMContentLoaded', function() {
                            const chart = new ApexCharts(document.querySelector("#sales-chart"), {
                                chart: {
                                    type: 'line',
                                    height: 350,
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
                    </script>
                </div>
            </div>
            <div class="w-[500px] h-[500px] rounded-full overflow-hidden">
                <img src="{{ $imageUrl }}" alt="Nature" class="w-full h-full object-fill">
            </div>
        @elseif ($role === 'seller')
            <h1>You are a seller</h1>
        @elseif ($role === 'user')
            <div class="p-4 flex max-sm:block items-center gap-2 w-full">
                <div class="flex">
                    <div class="bg-gradient-to-r from-slate-800 to-indigo-900 rounded-lg shadow-lg p-8 w-fit">
                        <p class="text-lg text-white mb-8">{{ $advice }} </p>
                        <a href="https://api.adviceslip.com/"
                            class="bg-white hover:bg-gray-200 text-indigo-700 font-bold py-2 px-4 rounded">
                            {{ __('Use this API') }}
                        </a>
                    </div>
                    <div class="text-center w-1/6 max-sm:w-full max-sm:pt-4">
                        <div class="block rounded-t-md overflow-hidden  text-center ">
                            <div class="bg-gradient-to-r from-slate-800 to-indigo-900 text-white py-2">
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
                <div class="w-[500px] h-[500px] rounded-full overflow-hidden">
                    <img src="{{ $imageUrl }}" alt="Nature" class="w-full h-full object-fill">
                </div>

            </div>
            <h2 class="text-xl font-semibold">{{ __('Order History') }}</h2>
            @foreach ($orders as $order)
                <div class="p-4 border-b">
                    <p>{{ __('Order #:id', ['id' => $order->id]) }}</p>
                    <p>{{ __('Status') }}: {{ __(ucfirst($order->status)) }}</p>
                    <ul class="list-disc ml-4">
                        @foreach ($order->items as $item)
                            <div>
                                <p>{{ $item['title'] }}</p>
                                <p>{{ $item['price'] }}</p>
                                <p>{{ $item['quantity'] }}</p>
                                <img src="{{ $item['thumbnail'] }}" alt="{{ $item['title'] }}">
                            </div>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        @endif
    </div>
    <livewire:toast-message />
</div>
