<div>
    @if ($type == 'success')
        <div x-data="{ show: @entangle('message').defer !== '' }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition
            class="fixed top-5 right-5 z-50 bg-green-500 py-4 px-6 rounded text-white">
            {{ $message }}
        </div>
    @elseif ($type == 'error')
        <div x-data="{ show: @entangle('message').defer !== '' }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition
            class="fixed top-5 right-5 z-50 bg-red-500 py-4 px-6 rounded text-white">
            {{ $message }}
        </div>
    @elseif ($type == 'warning')
        <div x-data="{ show: @entangle('message').defer !== '' }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition
            class="fixed top-5 right-5 z-50 bg-yellow-500 py-4 px-6 rounded text-white">
            {{ $message }}
        </div>
    @endif
</div>
