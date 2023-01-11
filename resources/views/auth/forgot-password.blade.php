<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            {{-- <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a> --}}
        </x-slot>
        <h2 class="flex justify-center mb-8 font-bold text-xl text-black leading-tight">
            {{ __('Mot de passe oublié') }}
        </h2>
        <p class="mb-4 text-md text-gray-900">
            {{ __("Indiquez-nous votre adresse mail et nous vous enverrons un lien de réinitialisation du mot de passe qui vous permettra d'en choisir un nouveau.") }}
        </p>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div>
                <x-input-label for="email" :value="__('Adresse mail')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Envoyer') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
