<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My orders') }}
    </x-slot>
    @php
        $statuses = ['pending', 'completed'];
    @endphp

    <div class="flex justify-center">
        <div class="bg-white dark:bg-slate-700 items-center rounded-xl my-8 w-full max-w-screen-xl">
            <div class="p-4 sm:p-8 space-y-8">
                @foreach ($statuses as $status)
                    <div class="space-y-4">
                        @if ($status === 'pending' && $counters['pending'] > 0 )
                            <div class="border-4 border-gray-500 px-2 rounded-full w-fit">
                                <h2 class="text-xl capitalize font-light">{{ __($status) }}</h2>
                            </div>
                        @elseif ($status === 'completed' && $counters['completed'] > 0 )
                            <div class="border-4 border-green-500 px-2 rounded-full w-fit">
                                <h2 class="text-xl capitalize font-light">{{ __($status) }}</h2>
                            </div>
                        @endif

                        <div class="flex gap-4 overflow-x-auto pb-2">
                            @foreach ($orders->where('status', $status) as $order)
                                <div
                                    class="bg-slate-100 dark:bg-slate-800 rounded-lg w-64 sm:w-72 md:w-80 flex-shrink-0 h-[450px] overflow-hidden">
                                    <div class="p-4 overflow-y-auto h-full">
                                        <p class="text-lg sm:text-xl font-semibold mb-2">{{ 'Order #' . $order->id }}
                                        </p>

                                        @foreach ($order->items as $item)
                                            <div
                                                class="flex justify-between items-center border-b border-slate-500 py-2">
                                                <div class="text-xs sm:text-sm">
                                                    <p>{{ $item['title'] }}</p>
                                                    <p>{{ '$' . $item['price'] . ' x ' . $item['quantity'] }}</p>
                                                </div>
                                                <img src="{{ $item['thumbnail'] }}" alt="{{ $item['title'] }}"
                                                    class="w-14 h-14 sm:w-16 sm:h-16 object-cover rounded">
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
                @endforeach
            </div>
        </div>
    </div>
    <livewire:toast-message />

</div>
