@props(['value' => ''])

<textarea {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-400 focus:ring focus:ring-indigo-300 focus:ring-opacity-50']) !!}>{{ $slot }}</textarea>