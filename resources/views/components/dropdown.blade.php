@props(['align' => 'right'])
@php
    switch ($align) {
        case 'left':
            $alignmentClasses = 'ltr:origin-top-left rtl:origin-top-right start-0';
            break;
        case 'top':
            $alignmentClasses = 'origin-top';
            break;
        case 'right':
        default:
            $alignmentClasses = 'ltr:origin-top-right rtl:origin-top-left end-0';
            break;
    }
@endphp

<div x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false" class="relative">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>
    <div x-show="open" x-cloak x-transition class="{{ $alignmentClasses }} absolute m-1">
        {{ $content }}
    </div>
</div>
