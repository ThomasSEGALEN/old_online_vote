<x-app-layout>
    <x-slot name="header">
        <a
            href="{{ route('roles.index') }}"
            class="inline-flex justify-center items-center mr-2"
        >
            <svg
                class="w-5 h-5"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 448 512"
            >
                <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/>
            </svg>
        </a>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un rôle') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-12 px-8">
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                @if (session('roleCreateSuccess'))
                <div
                    class="bg-green-100 text-green-700 py-2 px-4 rounded mb-2"
                    role="alert"
                >
                    <span class="block sm:inline">{{ session('roleCreateSuccess') }}</span>
                </div>
                @endif
                @if (session('roleCreateFailure'))
                <div
                    class="bg-red-100 text-red-700 py-2 px-4 rounded mb-2"
                    role="alert"
                >
                    <span class="block sm:inline">{{ session('roleCreateFailure') }}</span>
                </div>
                @endif
                <form
                    id="roleForm"
                    action="{{ route('roles.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf
                    <div class="w-full flex flex-row justify-between">
                        <div class="flex flex-col md:w-1/3 w-full -mx-3">
                            <div class="w-full px-3 mb-3">
                                <x-input-label
                                    class="font-bold mb-2"
                                    for="nameInput"
                                >
                                    {{ __('Nom') }}
                                </x-input-label>
                                <x-text-input
                                    class="@error ('name') is-invalid @enderror block w-full"
                                    id="nameInput"
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    required
                                />
                                @error ('name')
                                <x-input-error :messages="$message" />
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="w-full mb-3">
                        <span class="block font-bold mb-2">
                            {{ __('Permissions') }}
                        </span>
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead class="bg-white border-b">
                                    <tr class="border-b bg-gray-100">
                                        <th scope="col" class="text-md font-bold text-gray-900 px-6 py-4 text-left">
                                            {{ __('Nom') }}
                                        </th>
                                        <th scope="col" class="text-md font-bold text-gray-900 px-6 py-4 text-left">
                                            {{ __('Lister') }}
                                        </th>
                                        <th scope="col" class="text-md font-bold text-gray-900 px-6 py-4 text-left">
                                            {{ __('Consulter') }}
                                        </th>
                                        <th scope="col" class="text-md font-bold text-gray-900 px-6 py-4 text-left">
                                            {{ __('Créer') }}
                                        </th>
                                        <th scope="col" class="text-md font-bold text-gray-900 px-6 py-4 text-left">
                                            {{ __('Modifier') }}
                                        </th>
                                        <th scope="col" class="text-md font-bold text-gray-900 px-6 py-4 text-left">
                                            {{ __('Supprimer') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white border-b">
                                        <td class="text-md text-gray-900 font-bold px-6 py-4">
                                            {{ __('Utilisateurs') }}
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::USERS_VIEW_ANY }}"
                                                type="checkbox"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::USERS_VIEW_ANY }}"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::USERS_VIEW }}"
                                                type="checkbox"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::USERS_VIEW }}"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::USERS_CREATE }}"
                                                type="checkbox"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::USERS_CREATE }}"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::USERS_UPDATE }}"
                                                type="checkbox"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::USERS_UPDATE }}"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::USERS_DELETE }}"
                                                type="checkbox"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::USERS_DELETE }}"
                                            ></x-checkbox-input>
                                        </td>
                                    </tr>
                                    <tr class="border-b bg-gray-100">
                                        <td class="text-md text-gray-900 font-bold px-6 py-4">
                                            {{ __('Rôles') }}
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::ROLES_VIEW_ANY }}"
                                                type="checkbox"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::ROLES_VIEW_ANY }}"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::ROLES_VIEW }}"
                                                type="checkbox"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::ROLES_VIEW }}"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::ROLES_CREATE }}"
                                                type="checkbox"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::ROLES_CREATE }}"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::ROLES_UPDATE }}"
                                                type="checkbox"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::ROLES_UPDATE }}"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::ROLES_DELETE }}"
                                                type="checkbox"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::ROLES_DELETE }}"
                                            ></x-checkbox-input>
                                        </td>
                                    </tr>
                                    <tr class="border-b bg-white">
                                        <td class="text-md text-gray-900 font-bold px-6 py-4">
                                            {{ __('Groupes') }}
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::GROUPS_VIEW_ANY }}"
                                                type="checkbox"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::GROUPS_VIEW_ANY }}"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::GROUPS_VIEW }}"
                                                type="checkbox"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::GROUPS_VIEW }}"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::GROUPS_CREATE }}"
                                                type="checkbox"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::GROUPS_CREATE }}"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::GROUPS_UPDATE }}"
                                                type="checkbox"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::GROUPS_UPDATE }}"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::GROUPS_DELETE }}"
                                                type="checkbox"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::GROUPS_DELETE }}"
                                            ></x-checkbox-input>
                                        </td>
                                    </tr>
                                    <tr class="border-b bg-gray-100">
                                        <td class="text-md text-gray-900 font-bold px-6 py-4">
                                            {{ __('Groupes') }}
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::SESSIONS_VIEW_ANY }}"
                                                type="checkbox"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::SESSIONS_VIEW_ANY }}"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::SESSIONS_VIEW }}"
                                                type="checkbox"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::SESSIONS_VIEW }}"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::SESSIONS_CREATE }}"
                                                type="checkbox"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::SESSIONS_CREATE }}"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::SESSIONS_UPDATE }}"
                                                type="checkbox"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::SESSIONS_UPDATE }}"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::SESSIONS_DELETE }}"
                                                type="checkbox"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::SESSIONS_DELETE }}"
                                            ></x-checkbox-input>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mb-2 space-x-2">
                        <button
                            class="bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-4 rounded"
                            type="submit"
                        >
                            Envoyer
                        </button>
                        <button
                            class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded"
                            type="button"    
                            onclick="window.location='{{ route('roles.index') }}'"
                        >
                            Annuler
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
