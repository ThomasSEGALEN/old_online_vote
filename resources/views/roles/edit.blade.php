<x-app-layout>
    <x-slot name="header">
        <a
            href="{{ route('roles.index') }}"
            class="inline-flex justify-center items-center mr-2"
        >
            <svg
                class="w-5 h-5"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 448 512">
                <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/>
            </svg>
        </a>
        <h2 class="font-bold text-xl text-black leading-tight">
            {{ __('Modifier un rôle') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-12 px-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                @if (session('roleUpdateSuccess'))
                <div
                    class="inline-block bg-green-100 text-green-700 py-2 px-4 rounded mb-2"
                    role="alert"
                >
                    <span class="block sm:inline">{{ session('roleUpdateSuccess') }}</span>
                </div>
                @endif
                @if (session('roleUpdateFailure'))
                <div
                    class="inline-block bg-red-100 text-red-700 py-2 px-4 rounded mb-2"
                    role="alert"
                >
                    <span class="block sm:inline">{{ session('roleUpdateFailure') }}</span>
                </div>
                @endif
                <form
                    id="roleForm"
                    action="{{ route('roles.update', $role) }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @method('PUT')
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
                                    name="name"
                                    value="{{ $role->name }}"
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
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::USERS_VIEW_ANY }}"
                                                :checked="$role->permissions->contains('id', \App\Models\Permission::USERS_VIEW_ANY)"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::USERS_VIEW }}"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::USERS_VIEW }}"
                                                :checked="$role->permissions->contains('id', \App\Models\Permission::USERS_VIEW)"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::USERS_CREATE }}"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::USERS_CREATE }}"
                                                :checked="$role->permissions->contains('id', \App\Models\Permission::USERS_CREATE)"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::USERS_UPDATE }}"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::USERS_UPDATE }}"
                                                :checked="$role->permissions->contains('id', \App\Models\Permission::USERS_UPDATE)"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::USERS_DELETE }}"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::USERS_DELETE }}"
                                                :checked="$role->permissions->contains('id', \App\Models\Permission::USERS_DELETE)"
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
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::ROLES_VIEW_ANY }}"
                                                :checked="$role->permissions->contains('id', \App\Models\Permission::ROLES_VIEW_ANY)"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::ROLES_VIEW }}"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::ROLES_VIEW }}"
                                                :checked="$role->permissions->contains('id', \App\Models\Permission::ROLES_VIEW)"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::ROLES_CREATE }}"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::ROLES_CREATE }}"
                                                :checked="$role->permissions->contains('id', \App\Models\Permission::ROLES_CREATE)"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::ROLES_UPDATE }}"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::ROLES_UPDATE }}"
                                                :checked="$role->permissions->contains('id', \App\Models\Permission::ROLES_UPDATE)"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::ROLES_DELETE }}"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::ROLES_DELETE }}"
                                                :checked="$role->permissions->contains('id', \App\Models\Permission::ROLES_DELETE)"
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
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::GROUPS_VIEW_ANY }}"
                                                :checked="$role->permissions->contains('id', \App\Models\Permission::GROUPS_VIEW_ANY)"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::GROUPS_VIEW }}"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::GROUPS_VIEW }}"
                                                :checked="$role->permissions->contains('id', \App\Models\Permission::GROUPS_VIEW)"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::GROUPS_CREATE }}"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::GROUPS_CREATE }}"
                                                :checked="$role->permissions->contains('id', \App\Models\Permission::GROUPS_CREATE)"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::GROUPS_UPDATE }}"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::GROUPS_UPDATE }}"
                                                :checked="$role->permissions->contains('id', \App\Models\Permission::GROUPS_UPDATE)"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::GROUPS_DELETE }}"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::GROUPS_DELETE }}"
                                                :checked="$role->permissions->contains('id', \App\Models\Permission::GROUPS_DELETE)"
                                            ></x-checkbox-input>
                                        </td>
                                    </tr>
                                    <tr class="border-b bg-gray-100">
                                        <td class="text-md text-gray-900 font-bold px-6 py-4">
                                            {{ __('Séances') }}
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::SESSIONS_VIEW_ANY }}"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::SESSIONS_VIEW_ANY }}"
                                                :checked="$role->permissions->contains('id', \App\Models\Permission::SESSIONS_VIEW_ANY)"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::SESSIONS_VIEW }}"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::SESSIONS_VIEW }}"
                                                :checked="$role->permissions->contains('id', \App\Models\Permission::SESSIONS_VIEW)"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::SESSIONS_CREATE }}"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::SESSIONS_CREATE }}"
                                                :checked="$role->permissions->contains('id', \App\Models\Permission::SESSIONS_CREATE)"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::SESSIONS_UPDATE }}"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::SESSIONS_UPDATE }}"
                                                :checked="$role->permissions->contains('id', \App\Models\Permission::SESSIONS_UPDATE)"
                                            ></x-checkbox-input>
                                        </td>
                                        <td class="text-md text-gray-900 font-semibold px-6 py-4">
                                            <x-checkbox-input
                                                id="permissionInput-{{ \App\Models\Permission::SESSIONS_DELETE }}"
                                                name="permissions[]"
                                                value="{{ \App\Models\Permission::SESSIONS_DELETE }}"
                                                :checked="$role->permissions->contains('id', \App\Models\Permission::SESSIONS_DELETE)"
                                            ></x-checkbox-input>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-6 space-x-2">
                        <x-primary-button type="submit">
                            {{ __('Envoyer') }}
                        </x-primary-button>
                        <x-secondary-button onclick="window.location='{{ route('roles.index') }}'">
                            {{ __('Annuler') }}
                        </x-secondary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
