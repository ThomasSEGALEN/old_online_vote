<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier un groupe') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('groupUpdateSuccess'))
                    <div class="bg-green-100 text-green-700 py-2 px-4 rounded my-4" role="alert">
                        <span class="block sm:inline">{{ session('groupUpdateSuccess') }}</span>
                    </div>
                    @endif
                    @if (session('groupUpdateFailure'))
                    <div class="bg-red-100 text-red-700 py-2 px-4 rounded my-4" role="alert">
                        <span class="block sm:inline">{{ session('groupUpdateFailure') }}</span>
                    </div>
                    @endif
                    <form action="{{ route('groups.update', $group) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="w-full flex flex-row justify-between">
                            <div class="flex flex-col w-1/3 -mx-3">
                                <div class="w-full px-3 mb-3 md:mb-6">
                                    <label class="block uppercase tracking-wide text-xs font-bold mb-2" for="nameInput">
                                        Nom
                                    </label>
                                    <input
                                        class="@error ('name') is-invalid @enderror appearance-none block w-full bg-gray-100 rounded py-3 px-4 md:mb-0"
                                        id="nameInput" type="text" name="name" value="{{ $group->name }}">
                                    @error ('name')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex flex-col w-2/3 h-full -mx-3">
                                <div class="w-full px-3 mb-3 md:mb-6">
                                    <label class="block uppercase tracking-wide text-xs font-bold mb-2">
                                        Utilisateurs
                                    </label>
                                    @foreach ($users->sortBy('first_name')->sortBy('last_name') as $user)
                                    <div class="@error ('user_id') is-invalid @enderror form-check flex flex-row">
                                        <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        id="userInput-{{ $user->id }}" type="checkbox" name="user_id[]" value="{{ $user->id }}" @if ($group->users->contains('id', $user->id)) checked @endif>
                                        <label class="form-check-label inline-block text-gray-800" for="userInput-{{ $user->id }}">
                                            {{ $user->last_name }} {{ $user->first_name }}
                                        </label>
                                    </div>
                                    @endforeach
                                    @error ('user_id')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 space-x-2">
                            <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-4 rounded">
                                Envoyer
                            </button>
                            <button type="button" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded"
                                onclick="window.location='{{ route('groups.show', $group) }}'">
                                Annuler
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
