<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Séances') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('sessionViewFailure'))
                    <div
                        class="bg-red-100 text-red-700 py-2 px-4 rounded mb-2"
                        role="alert"
                    >
                        <span class="block sm:inline">{{ session('sessionViewFailure') }}</span>
                    </div>
                    @endif
                    @if (session('sessionDeleteSuccess'))
                    <div
                        class="bg-green-100 text-green-700 py-2 px-4 rounded mb-2"
                        role="alert"
                    >
                        <span class="block sm:inline">{{ session('sessionDeleteSuccess') }}</span>
                    </div>
                    @endif
                    @if (session('sessionDeleteFailure'))
                    <div
                        class="bg-red-100 text-red-700 py-2 px-4 rounded mb-2"
                        role="alert"
                    >
                        <span class="block sm:inline">{{ session('sessionDeleteFailure') }}</span>
                    </div>
                    @endif
                    @can ('create', \App\Models\Session::class)
                    <a
                        href="{{ route('sessions.create') }}"
                        class="inline-flex justify-center items-center p-2 text-base font-medium text-gray-500 bg-gray-50 rounded-lg hover:text-gray-900 hover:bg-gray-100"
                    >
                        <svg
                            class="w-5 h-5 mr-2"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512"
                        >
                            <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
                        </svg>
                        <span>Créer une séance</span>
                    </a>
                    @endcan
                    <div class="flex flex-col">
                        @foreach ($sessions->sortByDesc('created_at') as $session)
                        @if (auth()->user()->can('view', $session))
                        <li><a href={{ route('sessions.show', $session) }}>{{ $session->title }}</a></li>
                        @else
                        <li>{{ $session->title }}</li>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
