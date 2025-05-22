<x-app-layout>
    @php
        $role = auth()->user()?->role;
    @endphp
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{-- <div class="p-4 sm:w-full md:w-full xl:w-1/2 max-sm:w-full"> --}}
    <div class="p-4">
        @if ($role === 'admin')
        <div class=" w-1/2">
            <livewire:charts/>
        </div>
        @elseif ($role === 'seller')
            <h1>You are a seller</h1>
        @elseif ($role === 'user')
            <div class="p-4 flex max-sm:block items-center gap-2 w-full">
                <div class="bg-gradient-to-r from-slate-800 to-indigo-900 rounded-lg shadow-lg p-8 w-fit">
                    <p class="text-lg text-white mb-8" id="advice"></p>
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
                        <div class="bg-white  border-x-2 py-4">
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
        @endif
    </div>

    <script>
        fetch('https://api.adviceslip.com/advice')
            .then(response => response.json())
            .then(data => {
                document.getElementById('advice').textContent = data.slip.advice
            })
            .catch(() => {
                document.getElementById('advice').textContent = __('Error fetching advice')
            })
    </script>
</x-app-layout>
