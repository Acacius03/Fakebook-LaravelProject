<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;

class Lists extends Component
{
    public Collection $posts;
    #[On('post-created')]
    public function mount(int $user_id = 0): void
    {
        if ($user_id) {
            $this->getUserPosts($user_id);
        } else {
            $this->getAllPosts();
        }
    }
    public function getUserPosts(int $user_id = 0): void
    {
        $this->posts = Post::where('user_id', $user_id)
            ->latest()
            ->get();
    }
    public function getAllPosts(): void
    {
        $this->posts = Post::with('user')
            ->latest()
            ->get();
    }
    public function render()
    {
        return view('livewire.post.lists');
    }
}
