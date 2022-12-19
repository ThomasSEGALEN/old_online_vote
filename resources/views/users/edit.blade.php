<x-app-layout>
    <x-slot name="header">
        <a
            href="{{ route('users.show', $user) }}"
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
            {{ __('Modifier un utilisateur') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @error ('userUpdateSuccess')
                    <div
                        class="bg-green-100 text-green-700 py-2 px-4 rounded mb-2"
                        role="alert"
                    >
                        <span class="block sm:inline">{{ $message }}</span>
                    </div>
                    @enderror
                    @error ('userUpdateFailure')
                    <div
                        class="bg-red-100 text-red-700 py-2 px-4 rounded mb-2"
                        role="alert"
                    >
                        <span class="block sm:inline">{{ $message }}</span>
                    </div>
                    @enderror
                    <form
                        id="userForm"
                        action="{{ route('users.update', $user) }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >
                        @csrf
                        @method('PUT')
                        <div class="w-full flex flex-row justify-between">
                            <div class="flex flex-col w-1/2 -mx-3">
                                <div class="w-full px-3 mb-3">
                                    <span class="block uppercase tracking-wide text-xs font-bold mb-2">
                                        Civilité
                                    </span>
                                    <div class="@error ('title') is-invalid @enderror flex flex-col md:flex-row">
                                        @foreach ($titles as $title)
                                        <input
                                            class="form-check-input appearance-none h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                            id="titleInput-{{ $title->id }}"
                                            type="radio"
                                            name="title"
                                            value="{{ $title->id }}"
                                            @if ($user->title_id === $title->id) checked @endif
                                        />
                                        <label
                                            class="mr-5"
                                            for="titleInput-{{ $title->id }}"
                                        >
                                            {{ $title->long_name }}
                                        </label>
                                        @endforeach
                                        @error ('title')
                                        <span class="text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full px-3 mb-3">
                                    <label
                                        class="block uppercase tracking-wide text-xs font-bold mb-2"
                                        for="lastNameInput"
                                    >
                                        Nom
                                    </label>
                                    <input
                                        class="@error ('lastName') is-invalid @enderror appearance-none block w-full bg-gray-100 rounded py-3 px-4 md:mb-0"
                                        id="lastNameInput"
                                        type="text"
                                        name="lastName"
                                        value="{{ $user->last_name }}"
                                    >
                                    @error ('lastName')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="w-full px-3 mb-3">
                                    <label
                                        class="block uppercase tracking-wide text-xs font-bold mb-2"
                                        for="firstNameInput"
                                    >
                                        Prénom
                                    </label>
                                    <input
                                        class="@error ('firstName') is-invalid @enderror appearance-none block w-full bg-gray-100 rounded py-3 px-4 md:mb-0"
                                        id="firstNameInput"
                                        type="text"
                                        name="firstName"
                                        value="{{ $user->first_name }}"
                                    >
                                    @error ('firstName')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="w-full px-3 mb-3">
                                    <label
                                        class="block uppercase tracking-wide text-xs font-bold mb-2"
                                        for="emailInput"
                                    >
                                        Adresse mail
                                    </label>
                                    <input
                                        class="@error ('email') is-invalid @enderror appearance-none block w-full bg-gray-100 rounded py-3 px-4 md:mb-0"
                                        id="emailInput"
                                        type="email"
                                        name="email"
                                        value="{{ $user->email }}"
                                    >
                                    @error ('email')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div
                                    class="w-full px-3 mb-3"
                                    x-data="{ show: true }"
                                >
                                    <label
                                        class="block uppercase tracking-wide text-xs font-bold mb-2"
                                        for="passwordInput"
                                    >
                                        Mot de passe
                                    </label>
                                    <div class="relative">
                                        <input
                                            class="@error ('password') is-invalid @enderror appearance-none block w-full bg-gray-100 rounded py-3 px-4 md:mb-0"
                                            id="passwordInput"
                                            name="password"
                                            :type="show ? 'password' : 'text'"
                                        >
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                            <svg
                                                class="w-5 h-5"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 576 512"
                                                :class="{'hidden': !show, 'block': show }"
                                                @click="show = !show"
                                            >
                                                <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM432 256c0 79.5-64.5 144-144 144s-144-64.5-144-144s64.5-144 144-144s144 64.5 144 144zM288 192c0 35.3-28.7 64-64 64c-11.5 0-22.3-3-31.6-8.4c-.2 2.8-.4 5.5-.4 8.4c0 53 43 96 96 96s96-43 96-96s-43-96-96-96c-2.8 0-5.6 .1-8.4 .4c5.3 9.3 8.4 20.1 8.4 31.6z"/>
                                            </svg>
                                            <svg
                                                class="w-5 h-5"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 640 512"
                                                :class="{'hidden': show, 'block': !show }"
                                                @click="show = !show"
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
                                    <label
                                        class="block uppercase tracking-wide text-xs font-bold mb-2"
                                        for="avatarInput"
                                    >
                                        Avatar
                                    </label>
                                    <input
                                        class="@error ('avatar') is-invalid @enderror appearance-none block w-full"
                                        id="avatarInput"
                                        type="file"
                                        name="avatar"
                                    >
                                    @error ('avatar')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex flex-col w-1/2 h-full -mx-3">
                                <div class="w-full px-3 mb-10 md:mb-4">
                                    <span class="block uppercase tracking-wide text-xs font-bold mb-2">
                                        Rôles
                                    </span>
                                    <div class="h-48 px-1 overflow-y-auto">
                                        @foreach ($roles as $role)
                                        <div class="@error ('role') is-invalid @enderror form-check flex flex-row">
                                            <input
                                                class="form-check-input appearance-none h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                                id="roleInput-{{ $role->id }}"
                                                type="radio"
                                                name="role"
                                                value="{{ $role->id }}"
                                                @if ($user->role->id === $role->id) checked @endif
                                            >
                                            <label
                                                class="form-check-label inline-block text-gray-800"
                                                for="roleInput-{{ $role->id }}"
                                            >
                                                {{ $role->name }}
                                            </label>
                                        </div>
                                        @endforeach
                                        @error ('role')
                                        <span class="text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full px-3 mb-3">
                                    <span class="block uppercase tracking-wide text-xs font-bold mb-2">
                                        Groupes
                                    </span>
                                    <div class="h-48 px-1 overflow-y-auto">
                                        @foreach ($groups as $group)
                                        <div class="form-check flex flex-row">
                                            <input
                                                class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                                id="groupInput-{{ $group->id }}"
                                                type="checkbox"
                                                name="groups[]"
                                                value="{{ $group->id }}"
                                                @if ($user->groups->contains('id', $group->id)) checked @endif
                                            >
                                            <label
                                                class="form-check-label inline-block text-gray-800"
                                                for="groupInput-{{ $group->id }}"
                                            >
                                                {{ $group->name }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
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
                                onclick="window.location='{{ route('users.show', $user) }}'"
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
