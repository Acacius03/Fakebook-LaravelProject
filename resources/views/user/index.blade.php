<x-app-layout>
    <div class="flex">
        <aside class="sticky top-[0px] mt-[-66px] h-screen w-full max-w-[360px] bg-white pt-[66px]">
            <nav class="p-4">
                <x-button :icon="'fa-solid fa-user-group'" :text="'Home'"></x-button>
                <x-button :icon="'fa-solid fa-user-plus'" :text="'Friend Request'" :type="'menu'"></x-button>
            </nav>
        </aside>
        <main class="flex-grow px-10 py-7">
            @if ($friendRequestsReceived->count() > 0)
                <div id="friendRequestRecieved" class="mt-7 grid grid-cols-6 gap-2">
                    <div class="col-span-full flex w-full justify-between">
                        <h2 class="text-xl font-bold">Friend Requests</h2>
                    </div>
                    @foreach ($friendRequestsReceived as $friendRequest)
                        <x-friend-card :user_id="$friendRequest->user->id" :name="$friendRequest->user->name" :photo="$friendRequest->user->profile_photo"></x-friend-card>
                    @endforeach
                </div>
            @endif

            <div id="people-you-may-know" class="mt-7 grid grid-cols-6 gap-2">
                <div class="col-span-full flex w-full justify-between">
                    <h2 class="text-xl font-bold">People you may know</h2>
                    {{-- <a class="text-lg font-semibold text-blue-700">See All</a> --}}
                </div>
                @foreach ($users as $user)
                    <x-friend-card :user_id="$user->id" :name="$user->name" :photo="$user->profile_photo"></x-friend-card>
                @endforeach
            </div>

        </main>
    </div>
</x-app-layout>
