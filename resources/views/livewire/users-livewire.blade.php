<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users management') }}
        </h2>
    </x-slot>
    <div class="p-4">
        <div class="flex justify-between">
            <livewire:users-add-livewire />
            <div class="flex align-middle gap-2">
                <input type="text" placeholder="{{ __('Search') }}" wire:model.live="search"
                    class="rounded-md dark:bg-slate-800 focus:outline-none focus:ring-0 p-3 border-0">
                <button class="rounded-md text-slate-50 bg-indigo-600 dark:bg-slate-800 p-2" wire:click="toogleView">
                    @if ($cards)
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    @endif
                    @if (!$cards)
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                        </svg>
                    @endif
                </button>
            </div>
        </div>

        <div>
            @if ($isModalOpen)
                @switch($modalType)
                    @case('view')
                        <div class="fixed inset-0 flex items-center justify-center bg-black/50 z-50" x-data="{ open: true }"
                            @click.away="open = false" x-show="open">
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-md">
                                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 text-center mb-4">
                                    Información del Usuario
                                </h2>
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <span class="font-medium text-gray-700 dark:text-gray-300">Nombre:</span>
                                        <span class="text-gray-900 dark:text-gray-100">{{ $userToView->name }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="font-medium text-gray-700 dark:text-gray-300">Apellido:</span>
                                        <span class="text-gray-900 dark:text-gray-100">{{ $userToView->lastname }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="font-medium text-gray-700 dark:text-gray-300">Correo
                                            electrónico:</span>
                                        <span class="text-gray-900 dark:text-gray-100">{{ $userToView->email }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="font-medium text-gray-700 dark:text-gray-300">Dirección:</span>
                                        <span class="text-gray-900 dark:text-gray-100">{{ $userToView->address }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="font-medium text-gray-700 dark:text-gray-300">Teléfono:</span>
                                        <span class="text-gray-900 dark:text-gray-100">{{ $userToView->phone }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="font-medium text-gray-700 dark:text-gray-300">Rol:</span>
                                        <span
                                            class="text-gray-900 dark:text-gray-100">{{ Str::ucfirst($userToView->role) }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="font-medium text-gray-700 dark:text-gray-300">Género:</span>
                                        <span
                                            class="text-gray-900 dark:text-gray-100">{{ $userToView->gender = 'male' ? 'Masculino' : 'Femenino' }}</span>
                                    </div>
                                </div>
                                <div class="mt-6 flex justify-end">
                                    <button wire:click="toogleModal"
                                        class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-200 hover:bg-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                                        Cerrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    @break

                    @case('delete')
                        <div class="fixed inset-0 flex items-center justify-center bg-black/50 z-50" x-data="{ open: true }"
                            @click.away="open = false" x-show="open">
                            <form wire:submit.prevent='deleteUser'
                                class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center text-center z-50">
                                <div class="bg-slate-50 dark:bg-slate-800 rounded-lg p-6 lg:w-1/5 sm:w-1/2 md:w-10/16">
                                    <h2 class="text-xl font-bold mb-8">¿Estás seguro?</h2>
                                    <div class="mt-4 space-x-2 flex justify-center ">
                                        <button wire:click="deleteUser({{ $deleteId }})" type="button"
                                            class=" flex text-black dark:text-white hover:bg-indigo-950 bg-indigo-600 px-4 py-2 justify-center items-center rounded-md">
                                            Eliminar
                                        </button>
                                        <br>
                                        <button wire:click="toogleModal" type="button"
                                            class="bg-cyan-950 text-white px-4 py-2 rounded-md cursor-pointer hover:bg-gray-900">
                                            Cerrar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @break

                    @case('update')
                        <form wire:submit.prevent='updateUser'
                            class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
                            <div class="bg-slate-50 dark:bg-slate-800 rounded-lg p-6 lg:w-1/3 sm:w-11/12 md:w-10/12">
                                <h2 class="text-xl font-bold mb-4">Añadir un usuario</h2>

                                <div class="py-2">
                                    <p class="text-sm">Nombres</p>
                                    <input type="text" wire:model="name"
                                        class="rounded-xl focus:ring-0 p-3 border-0 bg-slate-200 dark:bg-slate-700 w-full"
                                        placeholder="John">
                                    @error('name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="py-2">
                                    <p class="text-sm">Apellidos</p>
                                    <input type="text" wire:model="lastname"
                                        class="rounded-xl focus:ring-0 p-3 border-0 bg-slate-200 dark:bg-slate-700 w-full"
                                        placeholder="Doe">
                                    @error('lastname')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="py-2">
                                    <p class="text-sm">Email</p>
                                    <input type="text" wire:model="email"
                                        class="rounded-xl focus:ring-0 p-3 border-0 bg-slate-200 dark:bg-slate-700 w-full"
                                        placeholder="example@example.com">
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="py-2">
                                    <p class="text-sm">Dirección</p>
                                    <input type="text" wire:model="address"
                                        class="rounded-xl focus:ring-0 p-3 border-0 bg-slate-200 dark:bg-slate-700 w-full"
                                        placeholder="Avenida La Paz 412">
                                    @error('address')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="py-2">
                                    <p class="text-sm">Teléfono</p>
                                    <input type="text" wire:model="phone"
                                        class="rounded-xl focus:ring-0 p-3 border-0 bg-slate-200 dark:bg-slate-700 w-full"
                                        placeholder="+56997914187">
                                    @error('phone')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="pt-4 flex space-x-4 items-baseline">
                                    <p class="text-sm">Género</p>
                                    <select wire:model="gender" id="gender"
                                        class="rounded-xl focus:ring-0 p-3 border-0 bg-slate-200 dark:bg-slate-700 w-1/2">
                                        <option value="" disabled selected>Seleccione el
                                            género</option>
                                        @if ($gender == 'male')
                                            <option value="male" selected>Masculino</option>
                                            <option value="female">Femenino</option>
                                        @else
                                            <option value="male">Masculino</option>
                                            <option value="female" selected>Femenino</option>
                                        @endif
                                    </select>

                                    <p class="text-sm">Rol</p>
                                    <select wire:model="role" id="role"
                                        class="rounded-xl focus:ring-0 p-3 border-0 bg-slate-200 dark:bg-slate-700 w-1/2">
                                        <option value="" selected>{{ __('Select role') }}</option>
                                        <option value="admin">{{ __('Admin') }}</option>
                                        <option value="seller">{{ __('Seller') }}</option>
                                        <option value="user">{{ __('User') }}</option>
                                    </select>

                                </div>
                                @error('gender')
                                    <p class="text-red-500 text-sm mt-1 pt-2">{{ $message }}</p>
                                @enderror
                                @error('role')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                <div class="py-2">
                                    <p class="text-sm pb-1">Foto</p>
                                    <div class="flex items-center space-x-6">
                                        <div class="shrink-0">
                                            <img id="preview_img" class="h-16 w-16 object-cover rounded-md"
                                                src="{{ $photo_path ? $photo_path : 'https://avatar.iran.liara.run/public/boy?username=Ash' }}" />
                                            <!-- src="{{ $photo_path ? $photo_path->temporaryUrl() : 'https://avatar.iran.liara.run/public/boy?username=Ash' }}" /> -->
                                        </div>
                                        <label class="block">
                                            <span class="sr-only">Choose profile photo</span>
                                            <input type="file" wire:model="photo_path"
                                                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-slate-700 file:text-slate-50 hover:file:bg-violet-100 hover:file:text-slate-700" />
                                        </label>
                                    </div>
                                    @error('photo_path')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mt-4 space-x-2 flex justify-end">
                                    <button type="button" wire:click="updateUser({{ $id }})"
                                        class="bg-indigo-700 text-white px-4 py-2 rounded-md cursor-pointer hover:bg-indigo-900">
                                        Guardar
                                    </button>
                                    <br>
                                    <button type="button" wire:click="toogleModal"
                                        class="bg-cyan-950 text-white px-4 py-2 rounded-md cursor-pointer hover:bg-gray-900">
                                        Cerrar
                                    </button>
                                </div>
                            </div>
                        </form>
                    @break
                @endswitch
            @endif
        </div>

        @if ($cards)
            <div class="grid lg:grid-cols-5 md:grid-cols-2 sm:grid-cols-1 gap-4 pt-4" wire:poll.1s>
                @foreach ($users as $user)
                    <div>
                        <!-- Card start -->
                        <div
                            class="max-w-sm mx-auto bg-slate-50 dark:bg-gray-500 rounded-lg overflow-hidden transition ease-in-out duration-150">
                            <div class="border-b px-4 pb-6">
                                <div class="text-center my-4">
                                    <img class="h-32 w-32 rounded-full border-4 border-white dark:border-gray-800 mx-auto my-4"
                                        alt=""
                                        src="{{ $user->photo_path ? asset('storage/' . $user->photo_path) : 'https://i.pravatar.cc/300?u=' . $user->id }}">
                                    @if ($user->status == 1)
                                        <span
                                            class="rounded-full bg-green-200 px-3 py-1 text-xs font-semibold text-green-900">Activo
                                        </span>
                                    @else
                                        <span
                                            class="rounded-full bg-red-200 px-3 py-1 text-xs font-semibold text-red-900">Inactivo
                                        </span>
                                    @endif
                                    <div class="py-2">
                                        <h3 class="font-bold text-2xl  dark:text-white mb-1">
                                            {{ $user->name . ' ' . $user->lastname }}
                                        </h3>
                                        <div class="inline-flex items-center">
                                            {{ $user->email }}
                                        </div>
                                        <div class="flex justify-center pt-2">
                                            <p class="italic">{{ Str::ucfirst($user->role) }}</p>
                                        </div>

                                    </div>
                                </div>
                                <div class="flex gap-2 justify-center">
                                    <button wire:click="viewUser({{ $user->id }})"
                                        class="flex text-slate-50 hover:bg-indigo-950 bg-indigo-600 w-16 h-8 justify-center items-center rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" class="size-4">
                                            <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                            <path fill-rule="evenodd"
                                                d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>


                                    <button wire:click="confirmUpdate({{ $user->id }})"
                                        class=" flex text-slate-50 hover:bg-indigo-950 bg-indigo-600 w-16 h-8 justify-center items-center rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" class="size-4">
                                            <path
                                                d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                        </svg>
                                    </button>

                                    @if ($user->id !== auth()->id())
                                        <button wire:click="confirmDelete({{ $user->id }})"
                                            class="flex items-centerw-28 p-3 bg-indigo-600  hover:bg-indigo-950 text-slate-50 w-16 h-8 justify-center items-center rounded-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="size-4">
                                                <path fill-rule="evenodd"
                                                    d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <!-- Card end -->
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        @else
            <div class="p-4">
                <div class="overflow-y-hidden rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-indigo-700 text-left text-sm text-gray-100">
                                    <th class="p-5">Nombre completo</th>
                                    <th class="p-5">Rol</th>
                                    <th class="p-5">Email</th>
                                    <th class="p-5">Estado</th>
                                    <th class="p-5">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="dark:text-slate-100">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="bg-slate-50 dark:bg-gray-500 p-5 text-sm">
                                            <div class="flex items-center">
                                                <div class="h-10 w-10 flex-shrink-0">
                                                    <img class="h-full w-full rounded-full"
                                                        src="{{ $user->photo_path ? asset('storage/' . $user->photo_path) : 'https://i.pravatar.cc/300?u=' . $user->id }}"
                                                        alt="" />
                                                </div>
                                                <div class="ml-3">
                                                    <p class="whitespace-no-wrap">
                                                        {{ $user->name . ' ' . $user->lastname }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="bg-slate-50 dark:bg-gray-500 p-5 text-sm">
                                            <p class="whitespace-no-wrap">
                                                {{ Str::ucfirst($user->role) }}
                                            </p>
                                        </td>
                                        <td class="bg-slate-50 dark:bg-gray-500 p-5 text-sm">
                                            <p class="whitespace-no-wrap">{{ $user->email }}</p>
                                        </td>

                                        <td class="bg-slate-50 dark:bg-gray-500 p-5 text-sm">
                                            @if ($user->status == 1)
                                                <span
                                                    class="rounded-full bg-green-200 px-3 py-1 text-xs font-semibold text-green-900">Activo
                                                </span>
                                            @else
                                                <span
                                                    class="rounded-full bg-red-200 px-3 py-1 text-xs font-semibold text-red-900">Inactivo
                                                </span>
                                            @endif
                                        </td>
                                        <td class="bg-slate-50 dark:bg-gray-500">
                                            <div class="flex gap-2">
                                                <button wire:click="viewUser({{ $user->id }})"
                                                    class="flex text-slate-50 hover:bg-indigo-950 bg-indigo-600 w-16 h-8 justify-center items-center rounded-md">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="size-4">
                                                        <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                                        <path fill-rule="evenodd"
                                                            d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                                <button wire:click="confirmUpdate({{ $user->id }})"
                                                    class=" flex text-slate-50 hover:bg-indigo-950 bg-indigo-600 w-16 h-8 justify-center items-center rounded-md">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="size-4">
                                                        <path
                                                            d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                                    </svg>
                                                </button>
                                                @if ($user->id !== auth()->id())
                                                    <button wire:click="confirmDelete({{ $user->id }})"
                                                        class="flex items-centerw-28 p-3 bg-indigo-600  hover:bg-indigo-950 text-slate-50 w-16 h-8 justify-center items-center rounded-md">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            fill="currentColor" class="size-4">
                                                            <path fill-rule="evenodd"
                                                                d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
    <livewire:toast-message />
</div>
