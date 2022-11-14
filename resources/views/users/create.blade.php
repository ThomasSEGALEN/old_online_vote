<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un utilisateur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('voteCreateSuccess'))
            <div class="bg-green-100 text-green-700 py-2 px-4 rounded my-4" role="alert">
                <span class="block sm:inline">{{ session('voteCreateSuccess') }}</span>
            </div> @endif
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="w-full flex flex-row justify-between">
                <div class="flex flex-col w-1/2 -mx-3">
                    <div class="w-full px-3 mb-3 md:mb-6">
                        <label class="block uppercase tracking-wide text-xs font-bold mb-2" for="roleInput">
                            Civilité
                        </label>
                        <input id="title_male" type="radio" name="title" value="1" checked />
                        <label for="title_male" class="mr-5">Monsieur</label>
                        <input id="title_female" type="radio" name="title" value="2" />
                        <label for="title_female">Madame</label>
                    </div>
                    <div class="w-full px-3 md:mb-6">
                        <label class="block uppercase tracking-wide text-xs font-bold mb-2" for="lastNameInput">
                            Nom
                        </label>
                        <input
                            class="@error('last_name') is-invalid @enderror appearance-none block w-full bg-gray-100 rounded py-3 px-4 mb-3 md:mb-0"
                            id="lastNameInput" type="text" name="last_name" value="{{ old('last_name') }}">
                        @error('last_name')
                        <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full px-3 md:mb-6">
                        <label class="block uppercase tracking-wide text-xs font-bold mb-2" for="firstNameInput">
                            Prénom
                        </label>
                        <input
                            class="@error('first_name') is-invalid @enderror appearance-none block w-full bg-gray-100 rounded py-3 px-4 mb-3 md:mb-0"
                            id="firstNameInput" type="text" name="first_name" value="{{ old('first_name') }}">
                        @error('first_name')
                        <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full px-3 md:mb-6">
                        <label class="block uppercase tracking-wide text-xs font-bold mb-2" for="emailInput">
                            Adresse mail
                        </label>
                        <input
                            class="@error('email') is-invalid @enderror appearance-none block w-full bg-gray-100 rounded py-3 px-4 mb-3 md:mb-0"
                            id="emailInput" type="email" name="email" value="{{ old('email') }}">
                        @error('email')
                        <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full px-3 md:mb-6">
                        <label class="block uppercase tracking-wide text-xs font-bold mb-2" for="passwordInput">
                            Mot de passe
                        </label>
                        <input
                            class="@error('password') is-invalid @enderror appearance-none block w-full bg-gray-100 rounded py-3 px-4 mb-3 md:mb-0"
                            id="passwordInput" type="password" name="password" value="{{ old('password') }}">
                        @error('password')
                        <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full px-3 md:mb-6">
                        <label class="block uppercase tracking-wide text-xs font-bold mb-2" for="avatarInput">
                            Avatar
                        </label>
                        <input
                            class="@error('avatar') is-invalid @enderror"
                            id="avatarInput" type="file" name="avatar" value="{{ old('avatar') }}">
                        @error('avatar')
                        <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-col w-1/2 h-full -mx-3">
                    <div class="flex flex-col w-full px-3 md:mb-6">
                        <label class="block uppercase tracking-wide text-xs font-bold mb-2" for="roleInput">
                            Rôles
                        </label>
                        @foreach ($roles as $role)
                        <div class="form-check flex flex-row">
                            <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                            id="roleInput" type="checkbox" name="role_id[]" value="{{ $role->id }}">
                            <label class="form-check-label inline-block text-gray-800" for="roleInput">
                                {{ ucfirst($role->name) }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                    <div class="w-full px-3 md:mb-6">
                        <label class="block uppercase tracking-wide text-xs font-bold mb-2" for="groupInput">
                            Groupes
                        </label>
                        TODO: Créer relation Users-Groups (MtM)
                        {{-- @foreach ($groups as $group)
                        <div class="form-check flex flex-row">
                            <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                            id="groupInput" type="checkbox" name="group_id[]" value="{{ $group->id }}">
                            <label class="form-check-label inline-block text-gray-800" for="groupInput">
                                {{ ucfirst($group->name) }}
                            </label>
                        </div>
                        @endforeach --}}
                    </div>
                </div>
            </div>
                <div class="mb-2 space-x-2">
                    <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-4 rounded">
                        Submit
                    </button>
                    <button type="button" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded"
                        onclick="window.location='{{ route('users.index') }}'">
                        Cancel
                    </button>
                </div>
            </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
