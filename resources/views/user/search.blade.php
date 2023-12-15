<x-app-layout>
    <div class="flex">
        <aside class="sticky top-[56px] h-screen w-full bg-white shadow-2xl">
            <nav class="max-w-90 h-full pl-4 pr-1 pt-4">
                <x-button :icon="'fa-solid fa-solid fa-newspaper'" :text="'Posts'"></x-button>
                <x-button :icon="'fa-solid fa-user-group'" :text="'People'"></x-button>
            </nav>
        </aside>
        <main class="flex-grow px-10 py-7">
            <div class="mx-auto flex max-w-[680px] flex-col gap-2">
                @foreach ($users as $user)
                    <div x-data="{
                        'isFriend': {{ in_array($user->id,auth()->user()->friends_list())? 'true': 'false' }},
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
                        }
                    }"
                        class="flex h-[100px] items-center justify-between gap-3 rounded-md border bg-white px-4 shadow">
                        <figure class="h-[60px] w-[60px] overflow-hidden rounded-full bg-gray-300">
                            <img src="/storage/profile_images/{{ $user->profile_photo }}" alt="">
                        </figure>
                        <div class="mr-auto">
                            <span class="text-lg font-bold">{{ $user->name }}</span>
                        </div>
                        <button x-show="!isFriend"
                            x-on:click="friendRequestSent=!friendRequestSent; friendRequestSent?addFriend():deleteFriend()"
                            x-text="friendRequestSent ? 'Cancel Friend Request' : 'Add Friend'"
                            class="h-[40px] min-w-[100px] max-w-[200px] rounded-md bg-blue-100 font-bold text-blue-700">
                        </button>
                        <a x-show="isFriend" href="/user/{{ $user->id }}">
                            <button
                                class="h-[40px] min-w-[100px] max-w-[200px] rounded-md bg-blue-700 font-bold text-white">
                                Profile
                            </button>
                        </a>
                    </div>
                @endforeach
            </div>
        </main>
    </div>
</x-app-layout>
