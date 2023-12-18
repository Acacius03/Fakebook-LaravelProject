<?php

namespace App\Livewire;

use Livewire\Component;

class FriendButton extends Component
{
    public int $friend_id;
    public bool $isFriend = true;
    public bool $requestedFriend = false;
    public bool $isRequested = false;

    public function mount(int $friend_id)
    {
        $this->friend_id = $friend_id;
        $this->isFriend = auth()->user()->friends()->where("id", $friend_id)->exists();
        $this->requestedFriend = auth()->user()->friendRequestsSent()->where('friend_id', $this->friend_id)->exists();
        $this->isRequested = auth()->user()->friendRequestsReceived()->where('user_id', $this->friend_id)->exists();
    }
    public function makeFriendRequest()
    {
        auth()->user()->friendRequestsSent()->create([
            'user_id' => auth()->user()->id,
            'friend_id' => $this->friend_id
        ]);
        $this->requestedFriend = true;
    }
    public function deleteFriendRequest()
    {
        auth()->user()
            ->friendRequestsSent()
            ->where('friend_id', $this->friend_id)
            ->delete();
        $this->requestedFriend = false;
    }
    public function acceptFriendRequest()
    {
        auth()->user()
            ->friendRequestsReceived()
            ->where('user_id', $this->friend_id)
            ->update(['accepted_at' => now()]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.friend-button');
    }
}
