<div class="flex flex-col gap-3">
    @foreach ($posts as $post)
        <livewire:post.show :$post />
    @endforeach
</div>
