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
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un vote') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('voteCreateSuccess'))
                    <div
                        class="bg-green-100 text-green-700 py-2 px-4 rounded mb-2"
                        role="alert"
                    >
                        <span class="block sm:inline">{{ session('voteCreateSuccess') }}</span>
                    </div>
                    @endif
                    @if (session('voteCreateFailure'))
                    <div
                        class="bg-red-100 text-red-700 py-2 px-4 rounded mb-2"
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
                                <div class="flex flex-col mb-3" id="dynamic_field">
                                    <div class="w-full md:w-1/2 px-3 md:mb-6">
                                        <label
                                            class="block uppercase tracking-wide text-xs font-bold mb-2"
                                            for="answerInput-1"
                                        >
                                            Réponse 1
                                        </label>
                                        <div class="flex flex-row mb-3 md:mb-0">
                                            <input
                                                class="@error ('answers') is-invalid @enderror appearance-none block w-full bg-gray-100 rounded py-3 px-4"
                                                id="answerInput-1"
                                                type="text"
                                                name="answers[]"
                                                value="{{ old('answers')[0] ?? '' }}"
                                            >
                                            <input
                                                id="colorInput-1"
                                                type="color"
                                                name="colors[]"
                                            >
                                            <button type="button" name="add" id="add" class="inline-flex justify-center items-center p-2">
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
                                        <span class="text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col w-1/2 h-full -mx-3">
                                <div class="w-full px-3 mb-3 md:mb-6">
                                    <span class="block uppercase tracking-wide text-xs font-bold mb-2">
                                        Scrutin
                                    </span>
                                    @foreach ($types as $type)
                                    <div class="@error ('type') is-invalid @enderror form-check flex flex-row">
                                        <input
                                            class="form-check-input appearance-none h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                            id="typeInput-{{ $type->id }}"
                                            type="radio"
                                            name="type"
                                            value="{{ $type->id }}"
                                            @if ($type->id === App\Models\VoteType::PUBLIC) checked @endif
                                        >
                                        <label
                                            class="form-check-label inline-block text-gray-800"
                                            for="typeInput-{{ $type->id }}"
                                        >
                                            {{ $type->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                    @error ('type')
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
                                onclick="window.location='{{ route('sessions.show', $session) }}'"
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


<script type="module">
    $(document).ready(function(){      
      var postURL = "<?php echo url('addmore'); ?>";
      var i=1;  


      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<div id="input'+i+'" class="w-full md:w-1/2 px-3 md:mb-6"><label class="block uppercase tracking-wide text-xs font-bold mb-2" for="answerInput-1">Réponse '+i+'</label><div class="flex flex-row mb-3 md:mb-0"><input class="appearance-none block w-full bg-gray-100 rounded py-3 px-4" id="answerInput-1" type="text" name="answers[]" value="{{ old('answers')['+i+'] ?? '' }}" required><input id="colorInput-1" type="color" name="colors[]"><button type="button" name="remove" id="'+i+'" class="inline-flex justify-center items-center p-2 remove"><svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg></button></div></div>');
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