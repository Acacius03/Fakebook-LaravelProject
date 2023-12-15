@props(['user' => []])
<a href="/user/{{ $user->id }}" class ='flex items-center gap-3 p-3 hover:bg-neutral-300/90' wire:navigate>
    <figure class="h-10 w-10 rounded-full">
        <x-avatar :image="$user->profile_photo"></x-avatar>
    </figure>
    <span class="mr-auto font-bold dark:text-white">{{ $user->name }}</span>
</a>
