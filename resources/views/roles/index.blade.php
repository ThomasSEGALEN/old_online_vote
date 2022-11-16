<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rôles') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('roleViewFailure'))
                    <div class="bg-red-100 text-red-700 py-2 px-4 rounded my-4" role="alert">
                        <span class="block sm:inline">{{ session('roleViewFailure') }}</span>
                    </div>
                    @endif
                    @if (session('roleDeleteSuccess'))
                    <div class="bg-green-100 text-green-700 py-2 px-4 rounded my-4" role="alert">
                        <span class="block sm:inline">{{ session('roleDeleteSuccess') }}</span>
                    </div>
                    @endif
                    @if (session('roleDeleteFailure'))
                    <div class="bg-red-100 text-red-700 py-2 px-4 rounded my-4" role="alert">
                        <span class="block sm:inline">{{ session('roleDeleteFailure') }}</span>
                    </div>
                    @endif
                    @can ('create', \App\Models\Role::class)
                    <a href="{{ route('roles.create') }}" class="inline-flex justify-center items-center p-2 text-base font-medium text-gray-500 bg-gray-50 rounded-lg hover:text-gray-900 hover:bg-gray-100">
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>
                        <span>Créer un rôle</span>
                    </a>
                    @endcan
                    <div class="flex flex-col">
                        @foreach ($roles as $role)
                        @if (auth()->user()->can('view', $role))
                        <li><a href="{{ route('roles.show', $role) }}">{{ $role->name }}</a></li>
                        @else
                        <li>{{ $role->name }}</li>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
