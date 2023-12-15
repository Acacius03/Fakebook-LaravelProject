<x-app-layout>
    <div class="flex">
        <aside class="sticky top-[56px] h-screen w-full bg-white shadow-2xl">
            <nav class="max-w-90 h-full pl-4 pr-1 pt-4">
                <x-button :icon="'fa-solid fa-user-group'" :text="'Home'"></x-button>
                <x-button :icon="'fa-solid fa-user-plus'" :text="'Friend Request'" :type="'menu'"></x-button>
            </nav>
        </aside>
        <main x-data class="flex-grow px-10 py-7">
            @if ($friendRequestsSent->count() > 0)
                <div class="col-span-full flex w-full justify-between">
                    <h2 class="text-xl font-bold">Friend Request Sent</h2>
                </div>
                <div id="friendRequestSent" class="mt-2 grid grid-cols-6 gap-2">
                    @foreach ($friendRequestsSent as $friendRequest)
                        <div class="flex max-h-[360px] flex-col gap-2 overflow-hidden rounded-md border border-neutral-300 bg-white shadow"
                            x-data="{
                                'friendRequestSent': true,
                                addFriend: function() {
                                    axios.post('/addfriend{{ $friendRequest->friend_id }}/')
                                        .then(response => {
                                            console.log(response)
                                        })
                                        .catch(error => {
                                            console.error('Error fetching likes:', error);
                                        });
                                },
                                deleteFriend: function() {
                                    axios.post('/deletefriend{{ $friendRequest->friend_id }}/')
                                        .then(response => {
                                            console.log(response)
                                        })
                                        .catch(error => {
                                            console.error('Error fetching data:', error);
                                        });
                                }
                            }">
                            <a href="/user/{{ $friendRequest->friend_id }}">
                                <figure class="h-[200px] flex-grow overflow-hidden">
                                    <img src="/storage/profile_images/{{ $friendRequest->friend->profile_photo }}"
                                        alt="">
                                </figure>
                            </a>
                            <div class="px-5 text-base">
                                <p class="font-bold">{{ $friendRequest->friend->name }}</p>
                            </div>
                            <div class="mt-auto flex flex-col gap-2 p-4 pt-0">
                                <button class="h-9 bg-blue-700 text-white"
                                    x-on:click="friendRequestSent=!friendRequestSent; friendRequestSent?addFriend():deleteFriend()"
                                    x-text="friendRequestSent ? 'Cancel Friend Request' : 'Add Friend'"></button>
                                <button class="h-9 bg-neutral-400">Remove</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            @if ($friendRequestsReceived->count() > 0)
                <div id="friendRequestRecieved" class="mt-7 grid grid-cols-6 gap-2">
                    <div class="col-span-full flex w-full justify-between">
                        <h2 class="text-xl font-bold">Friend Request Received</h2>
                    </div>
                    @foreach ($friendRequestsReceived as $friendRequests)
                        <div class="class= flex max-h-[360px] flex-col gap-2 overflow-hidden rounded-md border border-neutral-300 bg-white shadow"
                            x-data="{
                                'friendAccepted': 'false',
                                friendRequestAccept: function() {
                                    axios.post('/friendRequest{{ $friendRequests->user_id }}/confirm')
                                        .then(response => {
                                            console.log(response)
                                        })
                                        .catch(error => {
                                            console.error('Error fetching data:', error);
                                        });
                                },
                                deleteFriendRequest: function() {
                                    axios.post('/deletefriend{{ $friendRequests->user_id }}/')
                                        .then(response => {
                                            console.log(response)
                                        })
                                        .catch(error => {
                                            console.error('Error fetching data:', error);
                                        });
                                }
                            }">
                            <a href="/user/{{ $friendRequests->user_id }}">
                                <figure class="h-[200px] flex-grow overflow-hidden">
                                    <img src="/storage/profile_images/{{ $friendRequests->user->profile_photo }}"
                                        alt="">
                                </figure>
                            </a>
                            <div class="px-5 text-base">
                                <p class="font-bold">{{ $friendRequests->user->name }}</p>
                            </div>
                            <div class="mt-auto flex flex-col gap-2 p-4 pt-0">
                                <button class="h-9 bg-blue-700 text-white" x-on:click="friendRequestAccept"
                                    x-text="friendAccepted ? 'Friend Request Accepted' : 'Accept Friend Request'"></button>
                                <button class="h-9 bg-neutral-400" x-on:click="deleteFriendRequest">Remove</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <div id="people-you-may-know" class="mt-7 grid grid-cols-6 gap-2">
                <div class="col-span-full flex w-full justify-between">
                    <h2 class="text-xl font-bold">People you may know</h2>
                    <a class="text-lg font-semibold text-blue-700">See All</a>
                </div>
                @foreach ($users as $user)
                    <div class="flex max-h-[360px] flex-col gap-2 overflow-hidden rounded-md border border-neutral-300 bg-white shadow"
                        x-data="{
                            'friendRequestSent': false,
                            addFriend: function() {
                                axios.post('/addfriend{{ $user->id }}/')
                                    .then(response => {
                                        console.log(response)
                                    })
                                    .catch(error => {
                                        console.error('Error fetching likes:', error);
                                    });
                        
                            },
                            deleteFriend: function() {
                                axios.post('/deletefriend{{ $user->id }}/')
                                    .then(response => {
                                        console.log(response)
                                    })
                                    .catch(error => {
                                        console.error('Error fetching data:', error);
                                    });
                            },
                        }">
                        <a href="/user/{{ $user->id }}">
                            <figure class="h-[200px] flex-grow overflow-hidden">
                                <img src="/storage/profile_images/{{ $user->profile_photo }}" alt="">
                            </figure>
                        </a>
                        <div class="px-5 text-base">
                            <p class="font-bold">{{ $user->name }}</p>
                        </div>
                        <div class="mt-auto flex flex-col gap-2 p-4 pt-0">
                            <button class="h-9 bg-blue-700 text-white"
                                x-on:click="friendRequestSent=!friendRequestSent; friendRequestSent?addFriend():deleteFriend();"
                                x-text="friendRequestSent ? 'Cancel Friend Request' : 'Add Friend'"></button>
                            <button class="h-9 bg-neutral-400">Remove</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>
    </div>
</x-app-layout>
