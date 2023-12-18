<div class="mb-10 flex flex-col gap-3">
    @foreach ($postsToShow as $id => $post)
        <livewire:post.show :$post :wire:key="$id" :id="$id" />
    @endforeach
    <div class="h-10 w-full" x-intersect.margin.20vh="$wire.getPostToShow"></div>
</div>
