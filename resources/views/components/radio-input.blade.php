@props(['disabled' => false, 'checked' => true])

<input {{ $disabled ? 'disabled' : '' }} {{ $checked ? 'checked' : '' }} {!! $attributes->merge(['type' => 'radio', 'class' => 'form-check-input appearance-none h-4 w-4 border border-gray-300 bg-white active:bg-indigo-500 active:border-indigo-500 focus:bg-indigo-500 focus:border-indigo-500 checked:bg-indigo-500 checked:border-indigo-500 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer']) !!}>