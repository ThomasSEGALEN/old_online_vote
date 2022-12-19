<x-app-layout>
    <x-slot name="header">
        <a
            href="{{ route('sessions.index') }}"
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
            {{ __('Créer une séance') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('sessionCreateSuccess'))
                    <div
                        class="bg-green-100 text-green-700 py-2 px-4 rounded mb-2"
                        role="alert"
                    >
                        <span class="block sm:inline">{{ session('sessionCreateSuccess') }}</span>
                    </div>
                    @endif
                    @if (session('sessionCreateFailure'))
                    <div
                        class="bg-red-100 text-red-700 py-2 px-4 rounded mb-2"
                        role="alert"
                    >
                        <span class="block sm:inline">{{ session('sessionCreateFailure') }}</span>
                    </div>
                    @endif
                    <form
                        id="sessionForm"
                        action="{{ route('sessions.store') }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >
                        @csrf
                        <div class="w-full flex flex-row justify-between">
                            <div class="flex flex-col w-1/2 -mx-3">
                                <div class="w-full px-3 mb-3 md:mb-6">
                                    <label
                                        class="block uppercase tracking-wide text-xs font-bold mb-2"
                                        for="titleInput"
                                    >
                                        Titre
                                    </label>
                                    <input
                                        class="@error ('title') is-invalid @enderror appearance-none block w-full bg-gray-100 rounded py-3 px-4 md:mb-0"
                                        id="titleInput"
                                        type="text"
                                        name="title"
                                        value="{{ old('title') }}"
                                    >
                                    @error ('title')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="w-full px-3 mb-3 md:mb-6">
                                    <label
                                        class="block uppercase tracking-wide text-xs font-bold mb-2"
                                        for="descriptionInput"
                                    >
                                        Description
                                    </label>
                                    <textarea
                                        class="@error ('description') is-invalid @enderror appearance-none block w-full bg-gray-100 rounded py-3 px-4 md:mb-0"
                                        id="descriptionInput"
                                        type="text"
                                        name="description"
                                    >{{ old('description') }}</textarea>
                                    @error ('description')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="flex flex-col md:flex-row">
                                    <div class="w-full md:w-1/2 px-3 md:mb-6">
                                        <label
                                            class="block uppercase tracking-wide text-xs font-bold mb-2"
                                            for="startDateInput"
                                        >
                                            Date de début
                                        </label>
                                        <input
                                            class="@error('start_date') is-invalid @enderror appearance-none block w-full bg-gray-100 rounded py-3 px-4 mb-3 md:mb-0"
                                            id="startDateInput"
                                            type="datetime-local"
                                            name="start_date"
                                            value="{{ old('start_date') }}"
                                        >
                                        @error('start_date')
                                        <span class="text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="w-full md:w-1/2 px-3 md:mb-6">
                                        <label
                                            class="block uppercase tracking-wide text-xs font-bold mb-2"
                                            for="endDateInput"
                                        >
                                            Date de fin
                                        </label>
                                        <input
                                            class="@error('end_date') is-invalid @enderror appearance-none block w-full bg-gray-100 rounded py-3 px-4 mb-3 md:mb-0"
                                            id="endDateInput"
                                            type="datetime-local"
                                            name="end_date"
                                            value="{{ old('end_date') }}"
                                        >
                                        @error('end_date')
                                        <span class="text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col w-1/2 h-full -mx-3">
                                <div class="w-full px-3 mb-3 md:mb-6">
                                    <span class="block uppercase tracking-wide text-xs font-bold">
                                        Utilisateurs
                                    </span>
                                    @foreach ($groups->sortBy('name') as $group)
                                    @if ($group->users->first())
                                    <div class="form-check flex flex-col mb-2">
                                        <span class="block uppercase tracking-wide text-xs font-bold my-2">
                                            {{ $group->name }} :
                                        </span>
                                        @foreach ($group->users->sortBy('first_name')->sortBy('last_name') as $user)
                                        <div>
                                            <input
                                                class="@error ('users') is-invalid @enderror form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                                id="userInput-{{ $user->id }}"
                                                type="checkbox"
                                                name="users[]"
                                                value="{{ $user->id }}"
                                                @if (is_array(old('users')) && in_array($user->id, old('users'))) checked @endif
                                            >
                                            <label
                                                class="form-check-label inline-block text-gray-800"
                                                for="userInput-{{ $user->id }}"
                                            >
                                                {{ $user->last_name }} {{ $user->first_name }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                    @endforeach
                                    @error ('users')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
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
                                onclick="window.location='{{ route('sessions.index') }}'"
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
