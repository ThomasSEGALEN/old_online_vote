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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
                            <div class="flex flex-col w-1/3 -mx-3">
                                <div class="w-full px-3 mb-3 md:mb-6">
                                    <label
                                        class="block uppercase tracking-wide text-xs font-bold mb-2"
                                        for="nameInput"
                                    >
                                        Nom
                                    </label>
                                    <input
                                        class="@error ('name') is-invalid @enderror appearance-none block w-full bg-gray-100 rounded py-3 px-4 md:mb-0"
                                        id="nameInput"
                                        type="text"
                                        name="name"
                                        value="{{ old('name') }}"
                                    >
                                    @error ('name')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex flex-col w-2/3 h-full -mx-3">
                                <div class="w-full px-3 mb-3 md:mb-6">
                                    <span class="block uppercase tracking-wide text-xs font-bold">
                                        Permissions
                                    </span>
                                    @foreach ($permissions as $key => $permission)
                                    @if ($key === \App\Models\Permission::USERS_VIEW_ANY - 1)
                                    <span class="block uppercase tracking-wide text-xs font-bold my-2">
                                        Utilisateurs :
                                    </span>
                                    @endif
                                    @if ($key === \App\Models\Permission::ROLES_VIEW_ANY - 1)
                                    <span class="block uppercase tracking-wide text-xs font-bold my-2">
                                        Rôles :
                                    </span>
                                    @endif
                                    @if ($key === \App\Models\Permission::GROUPS_VIEW_ANY - 1)
                                    <span class="block uppercase tracking-wide text-xs font-bold my-2">
                                        Groupes :
                                    </span>
                                    @endif
                                    @if ($key === \App\Models\Permission::SESSIONS_VIEW_ANY - 1)
                                    <span class="block uppercase tracking-wide text-xs font-bold my-2">
                                        Sessions :
                                    </span>
                                    @endif
                                    <div class="form-check flex flex-row">
                                        <input
                                            class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                            id="permissionInput-{{ $permission->id }}"
                                            type="checkbox"
                                            name="permissions[]"
                                            value="{{ $permission->id }}"
                                            @if ($permission->id === \App\Models\Permission::USERS_VIEW_ANY || $permission->id === \App\Models\Permission::ROLES_VIEW_ANY || $permission->id === \App\Models\Permission::GROUPS_VIEW_ANY || $permission->id === \App\Models\Permission::SESSIONS_VIEW_ANY) checked @endif
                                        >
                                        <label
                                            class="form-check-label inline-block text-gray-800"
                                            for="permissionInput-{{ $permission->id }}"
                                        >
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
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
    </div>
</x-app-layout>
