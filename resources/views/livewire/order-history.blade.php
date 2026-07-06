<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My orders') }}
        </h2>
    </x-slot>

    @php
        $statuses = ['pending', 'completed'];
    @endphp

    <div class="flex justify-center px-4 sm:px-6 lg:px-8 py-6">
        <div class="w-full max-w-screen-xl">
            @foreach ($statuses as $status)
                @if (($status === 'pending' && $counters['pending'] > 0) || ($status === 'completed' && $counters['completed'] > 0))
                    <div class="mb-10 last:mb-0">
                        <!-- Status Header -->
                        <div class="flex items-center gap-4 mb-5">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 rounded-full 
                                    {{ $status === 'pending' ? 'bg-amber-400' : 'bg-emerald-400' }}">
                                </div>
                                <h2 class="text-xl font-bold text-gray-800 dark:text-white capitalize">
                                    {{ __($status) }}
                                </h2>
                                <span class="px-3 py-0.5 text-sm font-medium rounded-full bg-gray-100 dark:bg-slate-700 text-gray-600 dark:text-gray-300">
                                    {{ $orders->where('status', $status)->count() }}
                                </span>
                            </div>
                            <div class="flex-1 h-px bg-gradient-to-r from-gray-200 dark:from-slate-700 to-transparent"></div>
                        </div>

                        <!-- Orders Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 sm:gap-5">
                            @foreach ($orders->where('status', $status) as $order)
                                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 
                                    border border-gray-100 dark:border-slate-700 
                                    hover:border-indigo-200 dark:hover:border-indigo-800
                                    flex flex-col h-auto min-h-[180px]">
                                    
                                    <!-- Order Header -->
                                    <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100 dark:border-slate-700">
                                        <div class="flex items-center gap-3">
                                            <span class="text-sm font-bold text-gray-800 dark:text-white">
                                                #{{ $order->id }}
                                            </span>
                                            <span class="text-xs px-2.5 py-0.5 rounded-full font-medium
                                                {{ $order->status === 'pending' 
                                                    ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300' 
                                                    : 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300' 
                                                }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </div>
                                        <span class="text-xs text-gray-400 dark:text-gray-500">
                                            {{ $order->created_at->format('d/m/Y') }}
                                        </span>
                                    </div>

                                    <!-- Items -->
                                    <div class="flex-1 px-4 py-3 space-y-2">
                                        @foreach ($order->items as $item)
                                            <div class="flex items-center gap-3 group hover:bg-gray-50 dark:hover:bg-slate-700/50 rounded-lg p-1.5 transition-colors duration-150">
                                                <img src="{{ $item['thumbnail'] }}" 
                                                    alt="{{ $item['title'] }}"
                                                    class="w-12 h-12 object-cover rounded-lg shadow-sm flex-shrink-0">
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-gray-800 dark:text-gray-200 truncate">
                                                        {{ $item['title'] }}
                                                    </p>
                                                    <div class="flex items-center gap-2 text-xs">
                                                        <span class="font-semibold text-indigo-600 dark:text-indigo-400">
                                                            ${{ number_format($item['price'], 2) }}
                                                        </span>
                                                        <span class="text-gray-400 dark:text-gray-500">×</span>
                                                        <span class="text-gray-600 dark:text-gray-400">
                                                            {{ $item['quantity'] }}
                                                        </span>
                                                        @if ($item['quantity'] > 1)
                                                            <span class="text-gray-400 dark:text-gray-500 text-[10px]">
                                                                ({{ '$' . number_format($item['price'] * $item['quantity'], 2) }})
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Total -->
                                    <div class="px-4 py-3 border-t border-gray-100 dark:border-slate-700 bg-gray-50 dark:bg-slate-700/30 rounded-b-xl">
                                        <div class="flex justify-between items-center">
                                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                {{ __('Total') }}
                                            </span>
                                            <span class="text-base font-bold text-indigo-600 dark:text-indigo-400">
                                                ${{ number_format($order->total_price, 2) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <livewire:toast-message />
</div>

<style>
/* Transiciones suaves */
* {
    transition: border-color 0.2s ease, background-color 0.2s ease;
}

/* Mejora la legibilidad en modo oscuro */
.dark .bg-gray-50 {
    background-color: rgba(30, 41, 59, 0.3);
}

/* Ajuste de altura para tarjetas vacías */
.min-h-\[180px\] {
    min-height: 180px;
}

/* Responsive para pantallas muy pequeñas */
@media (max-width: 480px) {
    .grid {
        grid-template-columns: 1fr;
    }
}
</style>