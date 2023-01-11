<x-app-layout>
    <x-slot name="header">
        <a
            href="{{ route('sessions.show', $vote->session) }}"
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
            {{ __($vote->title) }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative p-6 bg-white border-b border-gray-200">
                    <div class="absolute top-4 right-4">
                        @can ('update', $vote)
                        <a
                            href="{{ route('votes.edit', $vote) }}"
                            class="inline-flex justify-center items-center p-2 text-base font-medium text-gray-500 bg-gray-50 rounded-lg hover:text-gray-900 hover:bg-gray-100"
                        >
                            <svg
                                class="w-5 h-5"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512"
                            >
                                <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.8 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/>
                            </svg>
                        </a>
                        @endcan
                        @can ('delete', $vote)
                        <form
                            class="inline-flex justify-center items-center p-2 text-base font-medium text-gray-500 bg-gray-50 rounded-lg hover:text-gray-900 hover:bg-gray-100"
                            id="voteForm"
                            action="{{ route('votes.destroy', $vote) }}"
                            method="POST"
                            enctype="multipart/form-data"
                        >
                            @csrf
                            @method('DELETE')
                            <input
                                type="hidden"
                                name="_method"
                                value="DELETE"
                            >
                            <button type="submit">
                                <svg
                                    class="w-5 h-5"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512"
                                >
                                    <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                </svg>
                            </button>
                        </form>
                        @endcan
                    </div>
                    <a
                        class="bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-4 rounded"
                        href="{{ route('votes.export', $vote) }}"
                    >
                        Export PDF
                    </a>
                    <form
                        id="voteForm"    
                        action="{{ route('votes.status', $vote) }}"
                        method="GET"
                        enctype="multipart/form-data"
                    >
                        @csrf
                        <span>Statut : @if ($vote->status === \App\Models\Vote::CLOSE) Fermé @else Ouvert @endif</span>
                        <button
                            class="bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-4 rounded"
                            type="submit"
                        >
                            @if ($vote->status === \App\Models\Vote::OPEN) Fermer @else Ouvrir @endif
                        </button>
                    </form>
                    <span>Réponses :</span>
                    @foreach ($vote->answers as $answer)
                    <li>{{ $answer->name }} : {{ $vote->results->where('answer_id', $answer->id)->count() }}</li>
                    @endforeach
                    @foreach ($answers as $answer)
                    <form
                        class="inline-flex"
                        id="voteForm-{{ $answer->id }}"    
                        action="{{ route('votes.answer', [$vote, $answer]) }}"
                        method="GET"
                        enctype="multipart/form-data"
                    >
                        @csrf
                        <button
                            class="bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-4 rounded"
                            type="submit"
                        >
                            {{ $answer->name }}
                        </button>
                    </form>
                    @endforeach
                    @if (session('answerCreateSuccess'))
                    <div
                        class="bg-green-100 text-green-700 py-2 px-4 rounded"
                        role="alert"
                    >
                        <span class="block sm:inline">{{ session('answerCreateSuccess') }}</span>
                    </div>
                    @endif
                    @if (session('answerCreateFailure'))
                    <div
                        class="bg-red-100 text-red-700 py-2 px-4 rounded"
                        role="alert"
                    >
                        <span class="block sm:inline">{{ session('answerCreateFailure') }}</span>
                    </div>
                    @endif
                    <div>{!! $chart->container() !!}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="{{ $chart->cdn() }}"></script>
        
{{ $chart->script() }}