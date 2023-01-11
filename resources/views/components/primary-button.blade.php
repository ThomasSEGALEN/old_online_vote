<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-indigo-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-400 focus:bg-indigo-400 focus:outline-none focus:border-indigo-400 focus:ring focus:ring-indigo-300 focus:ring-opacity-50 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
