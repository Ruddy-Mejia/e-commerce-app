<div class="p-4 bg-slate-200 dark:bg-gray-600 rounded shadow">
    <h3 class="flex gap-2 text-lg font-semibold text-gray-800 dark:text-white mb-3">
        {{ __('Your cart') }}
    </h3>

    @forelse ($cart as $id => $item)
        <div class="flex justify-between items-center mb-2">
            <div>
                <p class="font-medium">{{ $item['title'] }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    ${{ $item['price'] }} x {{ $item['quantity'] }}
                </p>
            </div>
            <button wire:click="remove({{ $id }})" class="text-red-500 hover:underline text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                {{-- {{ __('Delete') }} --}}
            </button>
        </div>
    @empty
        <p class="text-gray-500 dark:text-gray-400">{{ __('Your cart is empty') }}</p>
    @endforelse

    @if (count($cart))
        <div class="mt-4 border-t pt-2 text-right text-indigo-600 dark:text-indigo-400">
            <strong>{{ __('Total' . ': ') }} ${{ $this->total }}</strong>
        </div>

        @auth
            {{-- <button class="mt-2 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                {{ __('Finalize your purchase') }}
            </button> --}}
            <button wire:click="placeOrder" class="mt-2 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                {{ __('Place Order') }}
            </button>
        @else
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">{{ __('Login to buy!') }}</p>
        @endauth
    @endif
</div>
