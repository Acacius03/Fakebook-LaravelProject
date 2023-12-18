<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\Route;

class Show extends Component
{
    public int $id;
    public ?Post $post = null;
    public function mount(Post $post = null, int $id): void
    {
        $this->post = $post;
        $this->id = $id;
    }
    public function delete()
    {
        $this->dispatch('post-delete', post_id: $this->post->id);
    }
    public function react()
    {
        if ($this->post->reactedBy(auth()->user()->id)) {
            $this->post->reactions()
                ->where('user_id', auth()->user()->id)
                ->delete();
        } else {
            $this->post->reactions()
                ->create([
                    'user_id' => auth()->user()->id,
                    'reactions' => 'like'
                ]);
        }
    }
    public function render()
    {
        return view('livewire.post.show');
    }
}
