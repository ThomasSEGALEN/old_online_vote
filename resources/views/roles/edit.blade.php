<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier un rôle') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('roleUpdateSuccess'))
                    <div class="bg-green-100 text-green-700 py-2 px-4 rounded my-4" role="alert">
                        <span class="block sm:inline">{{ session('roleUpdateSuccess') }}</span>
                    </div>
                    @endif
                    @if (session('roleUpdateFailure'))
                    <div class="bg-red-100 text-red-700 py-2 px-4 rounded my-4" role="alert">
                        <span class="block sm:inline">{{ session('roleUpdateFailure') }}</span>
                    </div>
                    @endif
                    <form action="{{ route('roles.update', $role) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="w-full flex flex-row justify-between">
                            <div class="flex flex-col w-1/3 -mx-3">
                                <div class="w-full px-3 mb-3 md:mb-6">
                                    <label class="block uppercase tracking-wide text-xs font-bold mb-2" for="nameInput">
                                        Nom
                                    </label>
                                    <input
                                        class="@error('name') is-invalid @enderror appearance-none block w-full bg-gray-100 rounded py-3 px-4 md:mb-0"
                                        id="nameInput" type="text" name="name" value="{{ $role->name }}">
                                    @error('name')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex flex-col w-2/3 h-full -mx-3">
                                <div class="w-full px-3 mb-3 md:mb-6">
                                    <label class="block uppercase tracking-wide text-xs font-bold mb-2">
                                        Permissions
                                    </label>
                                    @foreach ($permissions as $key => $permission)
                                    @if ($key === \App\Models\Permission::USERS_VIEW_ANY - 1)
                                    <label class="block uppercase tracking-wide text-xs font-bold mb-2">
                                        Utilisateurs :
                                    </label>
                                    @endif
                                    @if ($key === \App\Models\Permission::ROLES_VIEW_ANY - 1)
                                    <label class="block uppercase tracking-wide text-xs font-bold mb-2">
                                        Rôles :
                                    </label>
                                    @endif
                                    @if ($key === \App\Models\Permission::GROUPS_VIEW_ANY - 1)
                                    <label class="block uppercase tracking-wide text-xs font-bold mb-2">
                                        Groupes :
                                    </label>
                                    @endif
                                    <div class="form-check flex flex-row">
                                        <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        id="permissionInput-{{ $permission->id }}" type="checkbox" name="permission_id[]" value="{{ $permission->id }}" @foreach ($role->permissions as $rolePermission) @if ($permission->id === $rolePermission->id) checked @endif @endforeach>
                                        <label class="form-check-label inline-block text-gray-800" for="permissionInput-{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 space-x-2">
                            <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-4 rounded">
                                Envoyer
                            </button>
                            <button type="button" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded"
                                onclick="window.location='{{ route('roles.show', $role) }}'">
                                Annuler
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
