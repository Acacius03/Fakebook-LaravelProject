@props(['user_id' => 0, 'name' => '', 'photo' => null])
<div class="flex max-h-[360px] flex-col gap-2 overflow-hidden rounded-md border border-neutral-300 bg-white shadow">
    <a href="/user/{{ $user_id }}">
        <figure class="h-[200px] flex-grow overflow-hidden bg-red-300">
            <x-avatar :image="$photo" :id="$user_id"></x-avatar>
        </figure>
    </a>
    <div class="px-5 text-base">
        <p class="font-bold">{{ $name }}</p>
    </div>
    <div class="mt-auto flex flex-col gap-2 p-4 pt-0">
        <livewire:friend-button :friend_id="$user_id" />
        <button class="h-9 bg-neutral-400">Remove</button>
    </div>
</div>
