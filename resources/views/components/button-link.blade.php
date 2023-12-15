@props(['icon' => null, 'text' => ''])
<a {!! $attributes->merge([
    'class' => ' px-3 py-2 font-bold rounded flex gap-3 h-12 items-center w-full hover:bg-neutral-300/90',
]) !!} wire:navigate>
    <span
        class= 'flex h-9 w-9 items-center justify-center overflow-hidden rounded-full bg-neutral-200 text-xl dark:bg-neutral-600 dark:text-neutral-300'>
        <i class="{{ $icon }}"></i>
    </span>
    {{ $text }}
</a>
