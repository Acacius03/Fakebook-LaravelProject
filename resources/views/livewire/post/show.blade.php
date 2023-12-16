<div class="rounded-lg border bg-white">
    <div class="mx-5 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="/user/{{ $post->user_id }}" wire:navigate>
                    <figure class="h-10 w-10 rounded-full">
                        <x-avatar :image="$post->user->profile_photo"></x-avatar>
                    </figure>
                </a>
                <div class="leading-none">
                    <a href="/user/{{ $post->user_id }}" wire:navigate class="font-bold hover:underline">
                        {{ $post->user->name }}
                    </a> <br>
                    <small class="font-semibold text-neutral-600">
                        {{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
                    </small>
                </div>
            </div>
            <div class="flex">
                <button class="flex-center-center h-8 w-8 overflow-hidden rounded-full text-2xl">
                    <i class="fa-solid fa-ellipsis"></i>
                </button>
                <button class="flex-center-center h-8 w-8 overflow-hidden rounded-full text-2xl">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>
        @if ($post->body)
            <p class="mt-2 text-justify text-base">
                {{ $post->body }}
            </p>
        @endif
    </div>
    @foreach ($post->postMedias()->get() as $image)
        <figure class="h-[400px] bg-gray-200">
            <img class="object-contain" src="{{ asset('storage/' . $image->file) }}" alt="picture">
        </figure>
    @endforeach
    <div class="mx-5 flex justify-between px-4 py-1 text-base text-neutral-600">
        <span>{{ $post->reactions()->count() }} Likes</span>
        <span>No shares</span>
    </div>
    <div class="mx-5 grid grid-cols-3 border-t text-base text-neutral-600">
        <button class="post-interactives" wire:click="react">
            <i class="{{ $reacted ? 'fa-solid fa-thumbs-up' : 'fa-regular fa-thumbs-up' }} ' text-blue-700"></i>
            <span>Like</span>
        </button>
        <button class="post-interactives">
            <i class="fa-regular fa-comment"></i>
            <span>Comment</span>
        </button>
        <button class="post-interactives">
            <i class="fa-regular fa-share-from-square"></i>
            <span>Share</span>
        </button>
    </div>
</div>
