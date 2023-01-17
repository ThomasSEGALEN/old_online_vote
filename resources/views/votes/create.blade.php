<x-app-layout>
    <x-slot name="header">
        <a
            href="{{ route('sessions.show', $session) }}"
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
            {{ __('Créer un vote') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-12 px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                @if (session('voteCreateSuccess'))
                <div
                    class="inline-block bg-green-100 text-green-700 py-2 px-4 rounded mb-2"
                    role="alert"
                >
                    <span class="block sm:inline">{{ session('voteCreateSuccess') }}</span>
                </div>
                @endif
                @if (session('voteCreateFailure'))
                <div
                    class="inline-block bg-red-100 text-red-700 py-2 px-4 rounded mb-2"
                    role="alert"
                >
                    <span class="block sm:inline">{{ session('voteCreateFailure') }}</span>
                </div>
                @endif
                <form
                    id="voteForm"
                    action="{{ route('votes.store', $session) }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf
                    <div class="w-full flex flex-row justify-between">
                        <div class="flex flex-col w-1/2 -mx-3">
                            <div class="w-full px-3 mb-3">
                                <x-input-label
                                    class="font-bold mb-2"
                                    for="nameInput"
                                >
                                    {{ __('Titre') }}
                                </x-input-label>
                                <x-text-input
                                    class="@error ('title') is-invalid @enderror block w-full"
                                    id="titleInput"
                                    name="title"
                                    value="{{ old('title') }}"
                                    required
                                ></x-text-input>
                                @error('title')
                                <x-input-error :messages="$message" />
                                @enderror
                            </div>
                            <div class="w-full px-3 mb-3">
                                <x-input-label
                                    class="font-bold mb-2"
                                    for="descriptionInput"
                                >
                                    {{ __('Description') }}
                                </x-input-label>
                                <x-textarea
                                    class="@error ('description') is-invalid @enderror block w-full rounded py-3 px-4 md:mb-0"
                                    id="descriptionInput"
                                    name="description"
                                >{{ old('description') }}</x-textarea>
                                @error('description')
                                <x-input-error :messages="$message" />
                                @enderror
                            </div>
                            <div class="flex flex-col mb-3" id="dynamic_field">
                                <div class="w-full px-3 mb-3">
                                    <x-input-label
                                        class="font-bold mb-2"
                                        for="answerInput-1"
                                    >
                                        {{ __('Réponse 1') }}
                                    </x-input-label>
                                    <div class="flex flex-row items-center">
                                        <x-text-input
                                            class="@error ('answers') is-invalid @enderror block w-full"
                                            id="answerInput-1"
                                            name="answers[]"
                                            value="{{ old('answers')[0] ?? '' }}"
                                        ></x-text-input>
                                        <input
                                            id="colorInput-1"
                                            type="color"
                                            name="colors[]"
                                        >
                                        <button
                                            type="button"
                                            name="add"
                                            id="add"
                                            class="inline-flex items-center"
                                        >
                                            <svg
                                                class="w-5 h-5 mr-2"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 448 512"
                                            >
                                                <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    @error('answers')
                                    <x-input-error :messages="$message" />
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col w-1/2 h-full -mx-3">
                            <div class="w-full px-3 mb-3">
                                <span class="font-bold mb-2">
                                    Scrutin
                                </span>
                                @foreach ($types as $type)
                                <div class="@error ('type') is-invalid @enderror flex flex-row">
                                    <x-radio-input
                                        id="typeInput-{{ $type->id }}"
                                        name="type"
                                        value="{{ $type->id }}"
                                        :checked="$type->id === App\Models\VoteType::PUBLIC"
                                    ></x-radio-input>
                                    <x-input-label
                                        class="inline-block text-gray-800"
                                        for="typeInput-{{ $type->id }}"
                                    >
                                        {{ $type->name }}
                                    </x-input-label>
                                </div>
                                @endforeach
                                @error('type')
                                <x-input-error :messages="$message" />
                                @enderror
                            </div>
                            <div class="w-full px-3 mb-3">
                                <span class="font-bold mb-2">
                                    Jeu de réponses
                                </span>
                                @foreach ($answers as $key => $answer)
                                <div class="@error ('answer') is-invalid @enderror flex flex-row">
                                    <x-checkbox-input
                                        id="answerInput-{{ $answer }}"
                                        name="answer"
                                        value="{{ $answer }}"
                                    ></x-checkbox-input>
                                    <x-input-label
                                        class="inline-block text-gray-800"
                                        for="answerInput-{{ $answer }}"
                                    >
                                        {{ $answer }}
                                    </x-input-label>
                                </div>
                                @endforeach
                                @error('answer')
                                <x-input-error :messages="$message" />
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 space-x-2">
                        <x-primary-button type="submit">
                            {{ __('Envoyer') }}
                        </x-primary-button>
                        <x-secondary-button onclick="window.location='{{ route('sessions.index') }}'">
                            {{ __('Annuler') }}
                        </x-secondary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>


<script type="module">
    $(document).ready(function(){      
      var postURL = "<?php echo url('addmore'); ?>";
      var i=1;  


      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<div id="input'+i+'" class="w-full px-3 mb-3"><label class="block text-md font-bold mb-2" for="answerInput-1">Réponse '+i+'</label><div class="flex flex-row items-center"><input type="text" class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-400 focus:ring focus:ring-indigo-300 focus:ring-opacity-50" id="answerInput-1" name="answers[]" value="{{ old('answers')['+i+'] ?? '' }}" required><input id="colorInput-1" type="color" name="colors[]"><button type="button" name="remove" id="'+i+'" class="inline-flex items-center remove"><svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg></button></div></div>');
      });  


      $(document).on('click', '.remove', function(){  
           var button_id = $(this).attr("id");   
           $('#input'+button_id+'').remove();
           i--;
      });  


      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });


      $('#submit').click(function(){            
           $.ajax({  
                url:postURL,  
                method:"POST",  
                data:$('#voteForm').serialize(),
                type:'json',
                success:function(data)  
                {
                    if(data.error){
                        printErrorMsg(data.error);
                    }else{
                        i=1;
                        $('.dynamic-added').remove();
                        $('#voteForm')[0].reset();
                        $(".print-success-msg").find("ul").html('');
                        $(".print-success-msg").css('display','block');
                        $(".print-error-msg").css('display','none');
                        $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
                    }
                }  
           });  
      });  
    });  
</script>