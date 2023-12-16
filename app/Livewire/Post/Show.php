<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;

class Show extends Component
{
    public ?Post $post = null;
    public bool $reacted = false;
    public function mount(Post $post = null): void
    {
        $this->post = $post;
        $this->reacted = $post->reactedBy(auth()->user()->id);
    }
    public function react()
    {
        if ($this->reacted) {
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
        $this->reacted = !$this->reacted;
    }
    public function render()
    {
        return view('livewire.post.show');
    }
}
