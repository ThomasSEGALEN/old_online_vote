<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un vote') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('voteCreateSuccess'))
                    <div class="bg-green-100 text-green-700 py-2 px-4 rounded mb-2" role="alert">
                        <span class="block sm:inline">{{ session('voteCreateSuccess') }}</span>
                    </div>
                    @endif
                    @if (session('voteCreateFailure'))
                    <div class="bg-red-100 text-red-700 py-2 px-4 rounded mb-2" role="alert">
                        <span class="block sm:inline">{{ session('voteCreateFailure') }}</span>
                    </div>
                    @endif
                    <form action="{{ route('votes.store', $session) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="w-full flex flex-row justify-between">
                            <div class="flex flex-col w-1/2 -mx-3">
                                <div class="w-full px-3 mb-3 md:mb-6">
                                    <label class="block uppercase tracking-wide text-xs font-bold mb-2" for="titleInput">
                                        Titre
                                    </label>
                                    <input
                                        class="@error ('title') is-invalid @enderror appearance-none block w-full bg-gray-100 rounded py-3 px-4 md:mb-0"
                                        id="titleInput" type="text" name="title" value="{{ old('title') }}">
                                    @error ('title')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="w-full px-3 mb-3 md:mb-6">
                                    <label class="block uppercase tracking-wide text-xs font-bold mb-2" for="descriptionInput">
                                        Description
                                    </label>
                                    <textarea class="@error ('description') is-invalid @enderror appearance-none block w-full bg-gray-100 rounded py-3 px-4 md:mb-0" id="descriptionInput" type="text" name="description">{{ old('description') }}</textarea>
                                    @error ('description')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex flex-col w-1/2 h-full -mx-3">
                                <div class="w-full px-3 mb-3 md:mb-6">
                                    <label class="block uppercase tracking-wide text-xs font-bold mb-2">
                                        Scrutin
                                    </label>
                                    @foreach ($types->sortBy('name') as $type)
                                    <div class="@error ('type_id') is-invalid @enderror form-check flex flex-row">
                                        <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        id="typeInput-{{ $type->id }}" type="radio" name="type_id" value="{{ $type->id }}" @if ($type->id === App\Models\VoteType::PUBLIC) checked @endif>
                                        <label class="form-check-label inline-block text-gray-800" for="typeInput-{{ $type->id }}">
                                            {{ $type->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                    @error ('type_id')
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
                                onclick="window.location='{{ route('sessions.show', $session) }}'">
                                Annuler
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
