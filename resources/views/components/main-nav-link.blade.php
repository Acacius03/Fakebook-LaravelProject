@props(['active' => false])
@php
    $classes = $active ? 'text-blue-700 relative before:w-full before:bg-blue-700 before:h-[3px] before:absolute before:-bottom-[4px] before:left-0' : 'hover:bg-neutral-300/90 dark:hover:bg-neutral-700/75';
@endphp
<a {{ $attributes->merge(['class' => "relative rounded-lg cursor-pointer my-1 flex items-center justify-center $classes"]) }}
    wire:navigate>
    {{ $slot }}
</a>
