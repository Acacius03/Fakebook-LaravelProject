<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;

class SearchUser extends Component
{
    #[Validate('required|string|max:255')]
    public string $search = '';

    public function searchUser() {
        $this->validate();
        session()->flash('status', 'Post successfully updated.');
        $this->reset();
        return back();
    }

    public function render()
    {
        return view('livewire.search-user');
    }
}
