<div>
    <!-- Cart Floating Button -->
    <div x-data="{ open: false }" class="fixed bottom-5 right-5 z-50">
        <button @click="open = !open" 
            class="bg-indigo-600 text-white p-3 rounded-full shadow-lg hover:bg-indigo-700 transition-colors duration-200 hover:scale-105 transform">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
            </svg>
        </button>

        <div x-show="open" @click.outside="open = false"
            class="fixed bottom-20 right-5 w-80 bg-white dark:bg-gray-800 rounded-lg shadow-xl p-4 z-50 border border-gray-100 dark:border-gray-700">
            @livewire('cart')
        </div>
    </div>

    <!-- Header -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product list') }}
        </h2>
    </x-slot>

    <!-- Filters Section -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md border border-gray-100 dark:border-slate-700 mx-4 sm:mx-6 lg:mx-8 mt-6">
        <div class="p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
                <!-- Search -->
                <div class="w-full sm:w-auto flex-1">
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" 
                            placeholder="{{ __('Search products...') }}" 
                            wire:model.live="search"
                            class="w-full pl-10 pr-4 py-2.5 rounded-lg bg-gray-50 dark:bg-slate-700 border-0 focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 text-gray-800 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-500">
                    </div>
                </div>

                <!-- Filters -->
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <!-- Category Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.outside="open = false"
                            class="flex items-center gap-2 px-4 py-2.5 bg-gray-50 dark:bg-slate-700 hover:bg-gray-100 dark:hover:bg-slate-600 rounded-lg text-gray-700 dark:text-gray-200 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                            <span class="text-sm font-medium">{{ __('Categories') }}</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        
                        <div x-show="open" 
                            class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-xl z-20 overflow-hidden">
                            <ul class="py-2 max-h-60 overflow-y-auto">
                                <li>
                                    <button wire:click="$set('selectedCategory', '')" @click="open = false"
                                        class="block w-full text-left px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-colors duration-150">
                                        <span class="font-medium">{{ __('All Categories') }}</span>
                                    </button>
                                </li>
                                @foreach ($categories as $category)
                                    <li>
                                        <button wire:click="$set('selectedCategory', @js($category['slug']))" @click="open = false"
                                            class="block w-full text-left px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-colors duration-150">
                                            {{ $category['name'] }}
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Sort Button -->
                    <button wire:click="toggleSort"
                        class="flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors duration-200 hover:shadow-md">
                        <span class="text-sm font-medium">{{ __('Sort') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 16 16">
                            @if ($sortPrice === 'asc')
                                <path d="M12.438 1.668V7H11.39V2.684h-.051l-1.211.859v-.969l1.262-.906h1.046z" />
                                <path fill-rule="evenodd" d="M11.36 14.098c-1.137 0-1.708-.657-1.762-1.278h1.004c.058.223.343.45.773.45.824 0 1.164-.829 1.133-1.856h-.059c-.148.39-.57.742-1.261.742-.91 0-1.72-.613-1.72-1.758 0-1.148.848-1.835 1.973-1.835 1.09 0 2.063.636 2.063 2.687 0 1.867-.723 2.848-2.145 2.848zm.062-2.735c.504 0 .933-.336.933-.972 0-.633-.398-1.008-.94-1.008-.52 0-.927.375-.927 1 0 .64.418.98.934.98" />
                                <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293z" />
                            @else
                                <path fill-rule="evenodd" d="M11.36 7.098c-1.137 0-1.708-.657-1.762-1.278h1.004c.058.223.343.45.773.45.824 0 1.164-.829 1.133-1.856h-.059c-.148.39-.57.742-1.261.742-.91 0-1.72-.613-1.72-1.758 0-1.148.848-1.836 1.973-1.836 1.09 0 2.063.637 2.063 2.688 0 1.867-.723 2.848-2.145 2.848zm.062-2.735c.504 0 .933-.336.933-.972 0-.633-.398-1.008-.94-1.008-.52 0-.927.375-.927 1 0 .64.418.98.934.98" />
                                <path d="M12.438 8.668V14H11.39V9.684h-.051l-1.211.859v-.969l1.262-.906h1.046zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293z" />
                            @endif
                        </svg>
                        @if ($sortPrice === 'asc')
                            <span class="text-xs opacity-75">{{ __('Low to High') }}</span>
                        @else
                            <span class="text-xs opacity-75">{{ __('High to Low') }}</span>
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="px-4 sm:px-6 lg:px-8 py-6">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 sm:gap-6">
            @forelse ($products as $product)
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 
                    border border-gray-100 dark:border-slate-700 
                    hover:border-indigo-200 dark:hover:border-indigo-800
                    hover:scale-[1.02] transform flex flex-col h-full">
                    
                    <!-- Product Image -->
                    <div class="relative pt-4 px-4">
                        <div class="bg-gray-50 dark:bg-slate-700/50 rounded-lg p-3 h-40 flex items-center justify-center">
                            <img src="{{ $product['thumbnail'] }}" 
                                alt="{{ $product['title'] }}"
                                class="w-full h-32 object-contain mix-blend-multiply dark:mix-blend-normal">
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="flex-1 px-4 pt-3 pb-4 flex flex-col">
                        <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200 line-clamp-2 min-h-[40px]">
                            {{ $product['title'] }}
                        </h3>
                        
                        <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2 mt-1 min-h-[32px]">
                            {{ $product['description'] }}
                        </p>

                        <div class="mt-3 pt-3 border-t border-gray-100 dark:border-slate-700">
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-indigo-600 dark:text-indigo-400">
                                    ${{ number_format($product['price'], 2) }}
                                </span>
                                @if(isset($product['rating']))
                                    <span class="text-xs text-gray-400 dark:text-gray-500 flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        {{ number_format($product['rating'], 1) }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Add to Cart Button -->
                        <button wire:click="$dispatch('addToCart', { payload: {{ $product['id'] }} })"
                            class="mt-3 w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg text-sm font-medium 
                                flex items-center justify-center gap-2 transition-colors duration-200 hover:shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            {{ __('Add to cart') }}
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center">
                    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md p-8 border border-gray-100 dark:border-slate-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400 text-lg">
                            {{ __('No products found') }}
                        </p>
                        <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">
                            {{ __('Try adjusting your search or filters') }}
                        </p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Pagination -->
    <div class="px-4 sm:px-6 lg:px-8 pb-6">
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md border border-gray-100 dark:border-slate-700 p-4">
            {{ $products->links() }}
        </div>
    </div>

    <livewire:toast-message />
</div>

<style>
/* Transiciones suaves */
* {
    transition: border-color 0.2s ease, background-color 0.2s ease, box-shadow 0.2s ease;
}

/* Mejora la legibilidad en modo oscuro */
.dark .bg-gray-50 {
    background-color: rgba(30, 41, 59, 0.5);
}

/* Líneas truncadas */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Altura mínima para consistencia */
.min-h-[40px] {
    min-height: 40px;
}
.min-h-[32px] {
    min-height: 32px;
}

/* Responsive para pantallas muy pequeñas */
@media (max-width: 480px) {
    .grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
}
</style>