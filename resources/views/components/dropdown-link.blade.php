<a {{ $attributes->merge(['class' => 'block w-full p-4 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out']) }}
    wire:navigate>{{ $slot }}
</a>
