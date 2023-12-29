<x-app-layout>
    <div class="-my-16">
        <div class="relative border-b bg-white shadow-2xl dark:border-gray-600">
            <figure class="absolute inset-0 h-1/3 w-full blur-[75px]">
                @if ($user->cover_photo)
                    <img src="{{ asset('storage/' . $user->cover_photo) }}" alt="Cover Image" class="w-full">
                @else
                    <img src="https://picsum.photos/id/{{ $user->id }}/800/400" alt="Cover Image" class="w-full">
                @endif
            </figure>
            <div class="container relative z-[1] mx-auto max-w-[1250px]">
                <figure class="max-h-[360px] min-h-[300px] rounded-lg lg:max-h-[520px]">
                    @if ($user->cover_photo)
                        <img src="{{ asset('storage/' . $user->cover_photo) }}" alt="Cover Image" class="w-full">
                    @else
                        <img src="https://picsum.photos/id/{{ $user->id }}/800/400" alt="Cover Image"
                            class="w-full">
                    @endif
                </figure>
                <div class="flex flex-col items-center justify-between gap-2 p-5 lg:flex-row">
                    <div class="lg:flex">
                        <figure
                            class="z-30 mx-auto mt-[-84px] h-[168px] w-[168px] rounded-full border-4 border-white dark:border-gray-700">
                            <x-avatar :image="$user->profile_photo" :id="$user->id"></x-avatar>
                        </figure>
                        <div class="mx-3 text-center lg:text-start">
                            <h3 class="text-4xl font-bold">{{ $user->name }}</h3>
                            <small class="font-bold text-neutral-600">112 Friends</small>
                        </div>
                    </div>
                    @if (auth()->user()->id === $user->id)
                        <a href="{{ route('profile.edit') }}" wire:navigate
                            class="rounded border border-gray-300 bg-gray-100 px-3 py-1 hover:bg-gray-300 dark:border-gray-400 dark:bg-gray-600 dark:hover:bg-gray-400">
                            <i class="fa-solid fa-pen"></i> Edit profile
                        </a>
                    @else
                        <div class="ml-auto flex gap-2">
                            <livewire:friend-button :friend_id="$user->id" />
                            <button
                                class="rounded border border-blue-900 bg-blue-700 px-3 py-1 font-semibold text-white hover:bg-blue-900">
                                <i class="fa-solid fa-comments"></i> Message
                            </button>
                            <button
                                class="h-9 w-9 rounded-full text-xl hover:bg-neutral-300/90 dark:hover:bg-neutral-700/75">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="container mx-auto flex max-w-[1250px] flex-col gap-3 p-5 pt-3 md:flex-row">
            <div class="h-max flex-shrink-0 basis-[40%] rounded-md border-2 bg-white p-4 shadow-md dark:border-0">
                <div class="flex justify-between">
                    <div>
                        <h3 class="text-lg font-bold">Friends</h3>
                        {{-- <small>
                                    {{ count($user->friends_list()) }}
                                    Friend
                                    @if (count($user->friends_list()) > 1)
                                        s
                                    @endif
                                </small> --}}
                    </div>
                    <a class="text-sm font-bold text-blue-700">All Friends</a>
                </div>
                <div class="mt-4 grid grid-cols-3 gap-3">
                    @foreach ($user->friends()->get() as $friend)
                        <a href="/user/{{ $friend->id }}" wire:navigate>
                            <figure class="rounded border-2">
                                <x-avatar :image="$friend->profile_photo" :id="$friend->id"></x-avatar>
                            </figure>
                            <p class="px-2 text-base">{{ $friend->name }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="flex flex-grow flex-col gap-3">
                @if (auth()->user()->id === $user->id)
                    <livewire:post.create />
                @endif
                <livewire:post.lists :user_id="$user->id" />
            </div>
        </div>
    </div>
</x-app-layout>
