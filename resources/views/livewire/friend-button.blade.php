<div>
    @if ($isFriend)
        <button
            class="w-full rounded border border-blue-900 bg-blue-700 px-3 py-1 font-semibold text-white hover:bg-blue-900">
            Unfriend
        </button>
    @elseif ($requestedFriend)
        <button wire:click="deleteFriendRequest"
            class="w-full rounded border border-blue-900 bg-blue-700 px-3 py-1 font-semibold text-white hover:bg-blue-900">
            Delete Friend Request
        </button>
    @elseif ($isRequested)
        <button wire:click="acceptFriendRequest"
            class="w-full rounded border border-blue-900 bg-blue-700 px-3 py-1 font-semibold text-white hover:bg-blue-900">
            Confirm
        </button>
    @else
        <button wire:click="makeFriendRequest"
            class="w-full rounded border border-blue-900 bg-blue-700 px-3 py-1 font-semibold text-white hover:bg-blue-900">
            Add Friend
        </button>
    @endif
</div>
