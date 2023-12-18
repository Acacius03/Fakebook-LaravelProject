<div x-data="{
    'reactCount': {{ $post->reactions()->count() }},
    'reacted': '{{ $post->reactedBy(auth()->user()->id) }}'
}" class="rounded-lg border-2 bg-white shadow-md dark:border-0">
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
            @include('livewire.post.partials.menu')
        </div>
        @if ($post->body)
            <p class="mt-2">{{ $post->body }}</p>
        @endif
    </div>
    @foreach ($post->postMedias()->get() as $image)
        <figure class="max-h-[680px] bg-black">
            <img class="mx-auto min-h-[340px]" src="{{ asset('storage/' . $image->file) }}" loading="lazy">
        </figure>
    @endforeach
    <div class="mx-5 flex h-11 items-center justify-between px-5 py-1 text-neutral-600">
        <span x-text="`${reactCount} Likes`"></span>
        <span>No shares</span>
    </div>
    <div class="mx-5 grid grid-cols-3 border-t py-1 text-neutral-600">
        <button
            @click.debounce.100ms="
            $wire.react();
            reacted=!reacted;
            reactCount += reacted ? 1 : -1
            "
            class="post-interactives">

            <i :class="reacted ? 'fa-solid fa-thumbs-up' : 'fa-regular fa-thumbs-up'" class="text-xl text-blue-700"></i>
            <span class="text-lg font-semibold">Like</span>
        </button>
        <button class="post-interactives">
            <i class="fa-regular fa-comment text-xl"></i>
            <span class="text-lg font-semibold">Comment</span>
        </button>
        <button class="post-interactives">
            <i class="fa-regular fa-share-from-square text-xl"></i>
            <span class="text-lg font-semibold">Share</span>
        </button>
    </div>
</div>
