<x-app-layout>
    <x-slot name="header">
        <a
            href="{{ route('groups.index') }}"
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
        <h2 class="font-bold text-xl text-black leading-tight">
            {{ __('Modifier un groupe') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-12 px-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                @if (session('groupUpdateSuccess'))
                <div
                    class="inline-block bg-green-100 text-green-700 py-2 px-4 rounded mb-2"
                    role="alert"
                >
                    <span class="block sm:inline">{{ session('groupUpdateSuccess') }}</span>
                </div>
                @endif
                @if (session('groupUpdateFailure'))
                <div
                    class="inline-block bg-red-100 text-red-700 py-2 px-4 rounded mb-2"
                    role="alert"
                >
                    <span class="block sm:inline">{{ session('groupUpdateFailure') }}</span>
                </div>
                @endif
                <form
                    id="groupInput"
                    action="{{ route('groups.update', $group) }}"
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
                                    value="{{ $group->name }}"
                                    required
                                />
                                @error ('name')
                                <x-input-error :messages="$message" />
                                @enderror
                            </div>
                            <div class="w-full px-3 mb-3">
                                <span class="block font-bold mb-2">
                                    {{ __('Utilisateurs') }}
                                </span>
                                <div class="max-h-48 px-1 overflow-y-auto">
                                    @foreach ($users->sortBy('first_name')->sortBy('last_name') as $user)
                                    <div class="@error ('users') is-invalid @enderror flex flex-row">
                                        <x-checkbox-input
                                            id="userInput-{{ $user->id }}"
                                            name="users[]"
                                            value="{{ $user->id }}"
                                            :checked="$group->users->contains('id', $user->id)"
                                        ></x-checkbox-input>
                                        <x-input-label
                                            for="userInput-{{ $user->id }}"
                                        >
                                            {{ $user->last_name }} {{ $user->first_name }}
                                        </x-input-label>
                                    </div>
                                    @endforeach
                                </div>
                                @error ('users')
                                <span class="text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 space-x-2">
                        <x-primary-button type="submit">
                            {{ __('Envoyer') }}
                        </x-primary-button>
                        <x-secondary-button onclick="window.location='{{ route('groups.index') }}'">
                            {{ __('Annuler') }}
                        </x-secondary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
