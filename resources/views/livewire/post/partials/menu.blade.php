<x-dropdown>
    <x-slot name="trigger">
        <button class="h-8 w-8 overflow-hidden rounded-full text-2xl hover:bg-gray-200 dark:hover:bg-gray-400">
            <i class="fa-solid fa-ellipsis"></i>
        </button>
    </x-slot>
    <x-slot name="content">
        <div class="w-96 rounded-md border bg-white p-2 font-semibold shadow-lg">
            <button class="post-interactives w-full px-3 text-start">
                <i class="fa-solid fa-pencil text-xl"></i>
                <span class="ml-3">Edit Post</span>
            </button>
            <button wire:click="delete" class="post-interactives w-full px-3 text-start">
                <i class="fa-solid fa-trash-can text-xl"></i>
                <span class="ml-3">Delete Post</span>
            </button>
        </div>
    </x-slot>
</x-dropdown>
