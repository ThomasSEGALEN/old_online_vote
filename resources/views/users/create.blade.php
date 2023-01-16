<x-app-layout>
    <x-slot name="header">
        <a
            href="{{ route('users.index') }}"
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
            {{ __('Créer un utilisateur') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-12 px-8">
        <div class="bg-white shadow-sm rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                @if (session('userCreateSuccess'))
                <div
                    class="inline-block bg-green-100 text-green-700 py-2 px-4 rounded mb-2"
                    role="alert"
                >
                    <span class="block sm:inline">{{ session('userCreateSuccess') }}</span>
                </div>
                @endif
                @if (session('userCreateFailure'))
                <div
                    class="inline-block bg-red-100 text-red-700 py-2 px-4 rounded mb-2"
                    role="alert"
                >
                    <span class="block sm:inline">{{ session('userCreateFailure') }}</span>
                </div>
                @endif
                <form
                    id="userForm"
                    action="{{ route('users.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf
                    <div class="w-full flex flex-col md:flex-row md:justify-between">
                        <div class="flex flex-col md:w-1/2 w-full -mx-3">
                            <div class="w-full px-3 mb-3">
                                <span class="block font-bold mb-2">
                                    {{ __('Civilité') }}
                                </span>
                                <div class="@error ('title') is-invalid @enderror flex flex-col md:flex-row">
                                    @foreach ($titles as $title)
                                    <div class="flex flex-row px-1">
                                        <x-radio-input
                                            id="titleInput-{{ $title->id }}"
                                            type="radio"
                                            name="title"
                                            value="{{ $title->id }}"
                                            :checked="$title->id === App\Models\UserTitle::MAN"
                                            required
                                        />
                                        <x-input-label
                                            class="mr-5"
                                            for="titleInput-{{ $title->id }}"
                                        >
                                            {{ __($title->long_name) }}
                                        </x-input-label>
                                    </div>
                                    @endforeach
                                    @error ('title')
                                    <x-input-error :messages="$message" />
                                    @enderror
                                </div>
                            </div>
                            <div class="w-full px-3 mb-3">
                                <x-input-label
                                    class="font-bold mb-2"
                                    for="lastNameInput"
                                >
                                    {{ __('Nom') }}
                                </x-input-label>
                                <x-text-input
                                    class="@error ('lastName') is-invalid @enderror block w-full"
                                    id="lastNameInput"
                                    type="text"
                                    name="lastName"
                                    value="{{ old('lastName') }}"
                                    required
                                />
                                @error ('lastName')
                                <x-input-error :messages="$message" />
                                @enderror
                            </div>
                            <div class="w-full px-3 mb-3">
                                <x-input-label
                                    class="font-bold mb-2"
                                    for="firstNameInput"
                                >
                                    {{ __('Prénom') }}
                                </x-input-label>
                                <x-text-input
                                    class="@error ('firstName') is-invalid @enderror block w-full"
                                    id="firstNameInput"
                                    type="text"
                                    name="firstName"
                                    value="{{ old('firstName') }}"
                                    required
                                />
                                @error ('firstName')
                                <x-input-error :messages="$message" />
                                @enderror
                            </div>
                            <div class="w-full px-3 mb-3">
                                <x-input-label
                                    class="font-bold mb-2"
                                    for="emailInput"
                                >
                                    {{ __('Adresse mail') }}
                                </x-input-label>
                                <x-text-input
                                    class="@error ('email') is-invalid @enderror block w-full"
                                    id="emailInput"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                />
                                @error ('email')
                                <x-input-error :messages="$message" />
                                @enderror
                            </div>
                            <div
                                class="w-full px-3 mb-3" 
                                x-data="{ show: true }"
                            >
                            <x-input-label
                                class="font-bold mb-2"
                                for="passwordInput"
                            >
                                {{ __('Mot de passe') }}
                            </x-input-label>
                                <div class="relative">
                                    <x-text-input
                                        class="@error ('password') is-invalid @enderror block w-full"
                                        id="passwordInput"
                                        name="password"
                                        value="{{ old('password') }}"
                                        ::type="show ? 'password' : 'text'"
                                        required
                                    />
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <svg
                                            class="w-5 h-5"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 576 512"
                                            fill="#111827"
                                            :class="{'hidden': !show, 'block': show }"
                                            x-on:click="show = !show"
                                        >
                                            <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM432 256c0 79.5-64.5 144-144 144s-144-64.5-144-144s64.5-144 144-144s144 64.5 144 144zM288 192c0 35.3-28.7 64-64 64c-11.5 0-22.3-3-31.6-8.4c-.2 2.8-.4 5.5-.4 8.4c0 53 43 96 96 96s96-43 96-96s-43-96-96-96c-2.8 0-5.6 .1-8.4 .4c5.3 9.3 8.4 20.1 8.4 31.6z"/>
                                        </svg>
                                        <svg
                                            class="w-5 h-5"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 640 512"
                                            fill="#111827"
                                            :class="{'hidden': show, 'block': !show }"
                                            x-on:click="show = !show"
                                        >
                                            <path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c5.2-11.8 8-24.8 8-38.5c0-53-43-96-96-96c-2.8 0-5.6 .1-8.4 .4c5.3 9.3 8.4 20.1 8.4 31.6c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zm223.1 298L373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5z"/>
                                        </svg>
                                    </div>
                                </div>
                                @error ('password')
                                <span class="text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full px-3 mb-3">
                                <x-input-label
                                    class="font-bold mb-2"
                                    for="avatarInput"
                                >
                                    {{ __('Avatar') }}
                                </x-input-label>
                                <input
                                    class="@error ('avatar') is-invalid @enderror block focus:outline-none"
                                    id="avatarInput"
                                    type="file"
                                    name="avatar"
                                >
                                @error ('avatar')
                                <span class="text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-col md:w-1/2 w-full h-full -mx-3">
                            <div class="px-3 mb-10 md:mb-4">
                                <span class="block font-bold mb-2">
                                    {{ __('Rôles') }}
                                </span>
                                <div class="max-h-48 px-1 overflow-y-auto">
                                    @foreach ($roles as $role)
                                    <div class="@error ('role') is-invalid @enderror form-check flex flex-row">
                                        <x-radio-input
                                            id="roleInput-{{ $role->id }}"
                                            type="radio"
                                            name="role"
                                            value="{{ $role->id }}"
                                            :checked="$role->id === App\Models\Role::USER"
                                            required
                                        />
                                        <x-input-label
                                            class="mr-5"
                                            for="roleInput-{{ $role->id }}"
                                        >
                                            {{ __($role->name) }}
                                        </x-input-label>
                                    </div>
                                    @endforeach
                                    @error ('role')
                                    <x-input-error :messages="$message" />
                                    @enderror
                                </div>
                            </div>
                            <div class="w-full px-3 mb-3">
                                <span class="block font-bold mb-2">
                                    {{ __('Groupes') }}
                                </span>
                                <div class="max-h-48 px-1 overflow-y-auto">
                                    @foreach ($groups as $group)
                                    <div class="form-check flex flex-row">
                                        <x-checkbox-input
                                            id="groupInput-{{ $group->id }}"
                                            type="checkbox"
                                            name="groups[]"
                                            value="{{ $group->id }}"
                                        />
                                        <x-input-label
                                            class="mr-5"
                                            for="groupInput-{{ $group->id }}"
                                        >
                                            {{ __($group->name) }}
                                        </x-input-label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 space-x-2">
                        <x-primary-button type="submit">
                            {{ __('Envoyer') }}
                        </x-primary-button>
                        <x-secondary-button onclick="window.location='{{ route('users.index') }}'">
                            {{ __('Annuler') }}
                        </x-secondary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
