<?php

namespace App\Livewire\Post;

use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Models\Post;
use App\Models\PostMedia;

use Livewire\Component;

class Create extends Component
{
    use WithFileUploads;

    #[Validate('nullable|string|max:5000')]
    public string $body = '';

    #[Validate('nullable|sometimes|image|max:1024')]
    public $image;

    public function createPost()
    {
        if (!$this->body && !$this->image) {
            return redirect()->back()->withErrors(['body' => 'Either a text or an image is required.']);
        }

        $post = Post::create([
            'body' => $this->body,
            'user_id' => auth()->user()->id,
        ]);

        if ($this->image) {
            $path = $this->image->store('post_images', 'public');
            PostMedia::create([
                'post_id' => $post->id,
                'file_type' => 'image',
                'file' => $path,
            ]);
        }
        $this->reset();
        $this->dispatch('post-created', post: $post);
    }
    public function render()
    {
        return view('livewire.post.create');
    }
}
