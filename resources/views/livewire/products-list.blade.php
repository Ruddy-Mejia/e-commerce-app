<div>
    <div x-data="{ open: false }" class="fixed bottom-5 right-5 z-50">
        <button @click="open = !open" class="bg-indigo-600 text-white p-3 rounded-full shadow-lg hover:bg-indigo-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
            </svg>
        </button>

        <div x-show="open" @click.outside="open = false"
         class="fixed bottom-20 right-5 w-80 bg-white dark:bg-gray-800 rounded-lg shadow p-4 z-50">
            @livewire('cart')
        </div>
    </div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product list') }}
        </h2>
    </x-slot>
    <div class="flex justify-between p-4 gap-2">
        <input type="text" placeholder="{{ __('Search') }}" wire:model.live="search"
            class="rounded-md dark:bg-slate-800 focus:outline-none focus:ring-0 p-3 border-0">
        <div class="flex items-center gap-2">
            <p class="text-sm text-slate-400">{{ __('Order by price') }}</p>
            <button wire:click="toggleSort"
                class="flex items-center gap-2 p-4 rounded-md bg-indigo-600 hover:bg-indigo-700 text-white">
                @if ($sortPrice === 'asc')
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5" fill="currentColor"
                        class="bi bi-sort-numeric-down" viewBox="0 0 16 16">
                        <path d="M12.438 1.668V7H11.39V2.684h-.051l-1.211.859v-.969l1.262-.906h1.046z" />
                        <path fill-rule="evenodd"
                            d="M11.36 14.098c-1.137 0-1.708-.657-1.762-1.278h1.004c.058.223.343.45.773.45.824 0 1.164-.829 1.133-1.856h-.059c-.148.39-.57.742-1.261.742-.91 0-1.72-.613-1.72-1.758 0-1.148.848-1.835 1.973-1.835 1.09 0 2.063.636 2.063 2.687 0 1.867-.723 2.848-2.145 2.848zm.062-2.735c.504 0 .933-.336.933-.972 0-.633-.398-1.008-.94-1.008-.52 0-.927.375-.927 1 0 .64.418.98.934.98" />
                        <path
                            d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293z" />
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5" fill="currentColor"
                        class="bi bi-sort-numeric-down-alt" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11.36 7.098c-1.137 0-1.708-.657-1.762-1.278h1.004c.058.223.343.45.773.45.824 0 1.164-.829 1.133-1.856h-.059c-.148.39-.57.742-1.261.742-.91 0-1.72-.613-1.72-1.758 0-1.148.848-1.836 1.973-1.836 1.09 0 2.063.637 2.063 2.688 0 1.867-.723 2.848-2.145 2.848zm.062-2.735c.504 0 .933-.336.933-.972 0-.633-.398-1.008-.94-1.008-.52 0-.927.375-.927 1 0 .64.418.98.934.98" />
                        <path
                            d="M12.438 8.668V14H11.39V9.684h-.051l-1.211.859v-.969l1.262-.906h1.046zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293z" />
                    </svg>
                @endif
            </button>
        </div>
    </div>
    <div class="flex flex-col md:flex-row">
        <div class="px-4">
            <div class="w-full md:w-auto">
                <div class="relative">
                    <button
                        class="w-full md:w-auto flex justify-between items-center p-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow-md focus:outline-none"
                        onclick="document.getElementById('categoryMenu').classList.toggle('hidden')">
                        {{ __('Categories') }}
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="categoryMenu"
                        class="absolute z-10 mt-2 w-full md:w-48 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg hidden">
                        <ul class="py-2">
                            <li>
                                <button wire:click="$set('selectedCategory', '')"
                                    class="block w-full text-left px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-indigo-100 dark:hover:bg-gray-800">
                                    {{ __('All') }}
                                </button>
                            </li>
                            @foreach ($categories as $category)
                                <li>
                                    <button wire:click="$set('selectedCategory', @js($category['slug']))"
                                        class="block w-full text-left px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-indigo-100 dark:hover:bg-gray-800">
                                        {{ $category['name'] }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>


            <div class="pt-4 gap-6 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6">
                @forelse ($products as $product)
                    {{-- Product card start --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                        <img src="{{ $product['thumbnail'] }}" alt="{{ $product['title'] }}"
                            class="w-full h-40 object-contain rounded">
                        <h3 class="mt-2 text-lg font-semibold text-gray-800 dark:text-gray-100">
                            {{ $product['title'] }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-2">
                            {{ $product['description'] }}
                        </p>
                        <p class="mt-2 font-bold text-indigo-600 dark:text-indigo-400">
                            ${{ $product['price'] }}
                        </p>
                        <button wire:click="$dispatch('addToCart', { payload: {{ $product['id'] }} })"
                            class="mt-2 w-full bg-indigo-600 text-white py-2 px-4 rounded hover:bg-indigo-700 text-sm flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>


                            {{ __('Add to cart') }}
                        </button>
                    </div>

                    {{-- Product card end --}}
                @empty
                    <p class="col-span-full text-center text-gray-500 dark:text-gray-400">
                        {{ __('No products found') }}
                    </p>
                @endforelse
            </div>
        </div>
    </div>
    <div class="p-6 relative z-10">
        {{ $products->links() }}
    </div>
    <livewire:toast-message />
</div>
