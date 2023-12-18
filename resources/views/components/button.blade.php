@props(['icon' => 'question', 'text' => 'Button', 'type' => null])
<button {!! $attributes->merge([
    'class' => 'cursor-pointer flex gap-3 h-12 items-center w-full hover:bg-neutral-300/90',
]) !!}>
    <span
        class= 'flex-center-center h-9 w-9 overflow-hidden rounded-full bg-neutral-200 text-xl dark:bg-neutral-600 dark:text-neutral-300'>
        <i class="{{ $icon }}"></i>
    </span>
    {{ $text }}
    @if (Str::lower($type) == 'menu')
        <span class="ml-auto mr-3 text-xl">
            <i class="fa-solid fa-chevron-right"></i>
        </span>
    @elseif (Str::lower($type) == 'toggle')
        <div class="toggle ml-auto h-9 w-16 rounded-full bg-neutral-200 p-1">
            <div class="h-7 w-7 rounded-full bg-white transition-all"></div>
        </div>
    @endif
</button>
