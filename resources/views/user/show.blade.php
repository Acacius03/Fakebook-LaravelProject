<x-app-layout>
    <div class="container mx-auto max-w-[1250px] overflow-hidden rounded">
        <figure
            class="relative max-h-[460px] min-h-[300px] w-full overflow-hidden rounded-lg border border-neutral-300 shadow-xl">
            <img src="{{ asset('storage/' . $user->cover_photo) }}" alt="Cover Image">
        </figure>
        <div class="px-6">
            <div class="flex h-[100px] items-end justify-between bg-white px-4 pb-4">
                <div class="relative w-[168px]">
                    <figure class="absolute bottom-0 h-[168px] w-full overflow-hidden rounded-full border-4 bg-gray-300">
                        <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo">
                    </figure>
                </div>
                <div class="ml-5 mr-auto">
                    <h3 class="text-4xl font-bold">{{ $user->name }}</h3>
                    {{-- <p class="pt-2 text-lg font-semibold">{{ count($user->getFriendUsers()) }} Friend
                        @if (count($user->friends_list()) > 1)
                            s
                        @endif
                    </p> --}}
                </div>
                <div class="flex items-center">
                    @if (auth()->user()->id === $user->id)
                        <a href="{{ route('profile.edit') }}" wire:navigate>
                            <button
                                class="flex items-center gap-2 border-neutral-400 bg-neutral-200 font-semibold tracking-wide text-black hover:bg-neutral-400 dark:bg-white dark:hover:bg-neutral-300">
                                <i class="fa-solid fa-pen"></i> Edit profile
                            </button>
                        </a>
                    @else
                        <button
                            class="flex items-center border border-neutral-400 bg-neutral-200 text-black hover:bg-neutral-400 dark:bg-white dark:hover:bg-neutral-300">
                            <i class="fa-solid fa-user-plus"></i> Friends
                        </button>
                        <button
                            class="flex items-center border border-blue-900 bg-blue-700 text-white hover:bg-blue-900">
                            <i class="fa-solid fa-comments"></i>Message
                        </button>
                        <button
                            class="flex-center-center h-9 w-9 rounded-full text-xl hover:bg-neutral-300/90 dark:hover:bg-neutral-700/75">
                            <i class="fa-solid fa-ellipsis"></i>
                        </button>
                    @endif
                </div>
            </div>
            <div class="mt-2 items-start md:flex">
                <div class="mr-3 flex-shrink-0 basis-[40%]">
                    <div class="rounded-md bg-white p-4 shadow-md">
                        <div class="flex items-start justify-between">
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
                            {{-- @foreach ($user->getFriendUsers() as $friend)
                                <a href="/user/{{ $friend->id }}">
                                    <figure class="rounded border-2">
                                        <img class="w-full" src="/storage/profile_images/{{ $friend->profile_photo }}">
                                    </figure>
                                    <p class="px-2 text-base">{{ $friend->name }}</p>
                                </a>
                            @endforeach --}}
                        </div>
                    </div>
                </div>
                <div class="flex-grow">
                    @if (auth()->user()->id === $user->id)
                        <livewire:post-maker />>
                    @endif
                    {{-- @foreach ($posts as $post)
                        <x-blog-post :post="$post"></x-blog-post>
                    @endforeach --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
