<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Lazy;
use Illuminate\Database\Eloquent\Collection;

#[Lazy]
class Lists extends Component
{
    public Collection $posts;
    public array $postsToShow = [];
    public int $user_id = 0;
    public int $postPerPage = 10;
    public int $page = 1;

    public function mount(int $user_id = 0): void
    {
        $this->user_id = $user_id;
        $this->posts = $this->getPosts();
        $this->getPostToShow($this->postPerPage);
    }
    #[On('post-delete')]
    public function deletePost($post_id)
    {
        $this->postsToShow = array_filter($this->postsToShow, function ($post) use ($post_id) {
            return $post->id !== $post_id;
        });
        Post::find($post_id)->delete();
    }
    #[On("post-created")]
    public function newPost($post_id)
    {
        array_unshift($this->postsToShow, Post::find($post_id));
    }
    public function getPostToShow(int $qty = 3)
    {
        if ($this->posts->count() <= 0) {
            $this->posts = $this->getPosts();
        }
        $post = $this->posts->splice(0, $qty);
        if ($post->count() > 0) {
            $this->postsToShow = array_merge($this->postsToShow, $post->all());
        }
    }
    public function getPosts(): Collection
    {
        $query = $this->user_id
            ? Post::where('user_id', $this->user_id)->latest()
            : Post::with('user')->latest();
        $offset = ($this->page - 1) * $this->postPerPage;
        $posts = $query->skip($offset)->take($this->postPerPage)->get();
        if ($posts->count() > 0) {
            $this->page++;
        }
        return $posts;
    }
    public function placeholder()
    {
        return view('livewire.placeholder.post-list');
    }
    public function render()
    {
        return view('livewire.post.lists');
    }
}
