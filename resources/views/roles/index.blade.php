<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-black leading-tight">
            {{ __('Rôles') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-12 px-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                @if (session('roleViewFailure'))
                <div
                    class="inline-block bg-red-100 text-red-700 py-2 px-4 rounded mb-2"
                    role="alert"
                >
                    <span class="block sm:inline">{{ session('roleViewFailure') }}</span>
                </div>
                @endif
                @if (session('roleDeleteSuccess'))
                <div
                    class="inline-block bg-green-100 text-green-700 py-2 px-4 rounded mb-2"
                    role="alert"
                >
                    <span class="block sm:inline">{{ session('roleDeleteSuccess') }}</span>
                </div>
                @endif
                @if (session('roleDeleteFailure'))
                <div
                    class="bg-red-100 text-red-700 py-2 px-4 rounded mb-2"
                    role="alert"
                >
                    <span class="block sm:inline">{{ session('roleDeleteFailure') }}</span>
                </div>
                @endif
                <div class="flex flex-wrap flex-row items-center justify-between">
                    <div>
                        @can ('create', \App\Models\Role::class)
                        <x-primary-button class="flex items-center my-2" onclick="window.location='{{ route('roles.create') }}'">
                            {{ __('Créer un rôle') }}
                        </x-primary-button>
                        @endcan
                    </div>
                    <form
                        class="flex items-center my-2"
                        action="{{ route('roles.index') }}"
                        method="GET"
                    >
                        <div class="relative">
                            <x-text-input
                                class="block w-full mr-3"
                                name="search"
                                placeholder="Recherche"
                            />                            
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="submit">
                                    <svg
                                        class="w-5 h-5"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512"
                                        fill="#111827"
                                    >
                                        <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352c79.5 0 144-64.5 144-144s-64.5-144-144-144S64 128.5 64 208s64.5 144 144 144z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="flex flex-col">
                    <div class="overflow-x-auto">
                        <div class="py-2 inline-block min-w-full">
                            <div class="overflow-hidden">
                                <table class="min-w-full">
                                    <thead class="bg-gray-100 border-b">
                                        <tr>
                                            <th scope="col" class="text-md font-bold text-gray-900 px-6 py-4 text-left">
                                                {{ __('#') }}
                                            </th>
                                            <th scope="col" class="text-md font-bold text-gray-900 px-6 py-4 text-left">
                                                {{ __('Nom') }}
                                            </th>
                                            <th scope="col" class="text-md font-bold text-gray-900 px-6 py-4 text-left">
                                                {{ __('Actions') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $role)
                                        <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                            <td class="text-md text-gray-900 font-bold px-6 py-4">
                                                {{ $role->id }}
                                            </td>
                                            <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                                {{ $role->name }}
                                            </td>
                                            <td class="flex space-x-5 px-6 py-4">
                                                <button
                                                    x-data=""
                                                    x-on:click.prevent="$dispatch('open-modal', 'roleShow-{{ $role->id }}')"
                                                >
                                                    <svg
                                                        class="w-5 h-5"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 576 512"
                                                        fill="#111827"
                                                    >
                                                        <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM432 256c0 79.5-64.5 144-144 144s-144-64.5-144-144s64.5-144 144-144s144 64.5 144 144zM288 192c0 35.3-28.7 64-64 64c-11.5 0-22.3-3-31.6-8.4c-.2 2.8-.4 5.5-.4 8.4c0 53 43 96 96 96s96-43 96-96s-43-96-96-96c-2.8 0-5.6 .1-8.4 .4c5.3 9.3 8.4 20.1 8.4 31.6z"/>
                                                    </svg>
                                                </button>
                                                <a href="{{ route('roles.edit', $role) }}">
                                                    <svg
                                                        class="w-5 h-5"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 512 512"
                                                        fill="#111827"
                                                    >
                                                        <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.8 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/>
                                                    </svg>
                                                </a>
                                                <button
                                                    x-data=""
                                                    x-on:click.prevent="$dispatch('open-modal', 'roleDelete-{{ $role->id }}')"
                                                >
                                                    <svg
                                                        class="w-5 h-5"    
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 448 512"
                                                        fill="#111827"
                                                    >
                                                        <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                        <x-modal
                                            name="roleShow-{{$role->id}}"
                                            focusable
                                        >
                                            <div class="p-6">
                                                <h2 class="flex justify-center text-lg font-medium text-gray-900 mb-8">
                                                    {{ __($role->name) }}
                                                </h2>
                                                <div class="mb-2">
                                                    <span class="block font-bold">
                                                        {{ __('Date de création') }}
                                                    </span>
                                                    <li>{{ $role->created_at }}</li>
                                                </div>
                                                <div class="mb-2">
                                                    <span class="block font-bold">
                                                        {{ __('Date de modification') }}
                                                    </span>
                                                    <li>{{ $role->updated_at }}</li>
                                                </div>
                                                @if ($role->permissions->first())
                                                <div class="mb-2">
                                                    <span class="block font-bold">
                                                        {{ __('Permissions') }}
                                                    </span>
                                                    <div class="max-h-48 overflow-y-auto">
                                                        @foreach ($role->permissions as $permission)
                                                        <li>{{ $permission->name }}</li>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @endif
                                                <div class="mt-6 flex justify-end space-x-4">
                                                    <x-secondary-button
                                                        type="button"
                                                        x-on:click="$dispatch('close')"
                                                    >
                                                        {{ __('Fermer') }}
                                                    </x-secondary-button>
                                                </div>
                                            </div>
                                        </x-modal>
                                        <x-modal
                                            name="roleDelete-{{ $role->id }}"
                                            focusable
                                        >
                                            <form
                                                method="POST"
                                                action="{{ route('roles.destroy', $role) }}"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <div class="p-6">
                                                    <h2 class="text-lg font-medium text-gray-900">
                                                        {{ __('Êtes-vous sûr de vouloir supprimer ce rôle ?') }}
                                                    </h2>
                                                    <p class="mt-1 text-sm text-gray-600">
                                                        {{ __('Une fois que ce rôle est supprimé, toutes ses données seront définitivement
                                                        effacées.') }}
                                                    </p>
                                                    <div class="mt-6 flex justify-end space-x-4">
                                                        <x-secondary-button
                                                            type="button"
                                                            x-on:click="$dispatch('close')"
                                                        >
                                                            {{ __('Annuler') }}
                                                        </x-secondary-button>
                                                        <x-primary-button type="submit">
                                                            {{ __('Supprimer') }}
                                                        </x-primary-button>
                                                    </div>
                                                </div>
                                            </form>
                                        </x-modal>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                 @if ($pagination)
                    {{ $roles->links() }}
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
