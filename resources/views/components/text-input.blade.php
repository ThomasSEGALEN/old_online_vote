@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['type' => 'text', 'class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-400 focus:ring focus:ring-indigo-300 focus:ring-opacity-50']) !!}>
