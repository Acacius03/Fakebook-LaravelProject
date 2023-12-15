<x-app-layout>
    <div class="flex">
        <aside class="sticky top-[0px] mt-[-66px] hidden h-screen w-full max-w-[360px] pt-[66px] xl:block">
            <nav class="flex h-full flex-col p-4">
                <x-profile-card :user="auth()->user()"></x-profile-card>
                <x-button-link href="{{ route('home') }}" :icon="'fa-solid fa-user-group'" :text="'Friends'"></x-button-link>
                <x-misc-nav></x-misc-nav>
            </nav>
        </aside>
        <main class="flex-grow pt-2 lg:flex-shrink-0">
            <div class="mx-auto w-full max-w-[680px]">
                <livewire:post-maker />
            </div>
        </main>
        <aside class="sticky top-[0px] mt-[-66px] hidden h-screen w-full max-w-[360px] pt-[66px] xl:block">
            <nav class="flex h-full flex-col overflow-y-scroll p-4">
                <div class="flex items-center gap-2 px-2">
                    <span>Contacts</span>
                    <button class="icon-circle size-8 ml-auto text-lg">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <button class="icon-circle size-8 text-lg">
                        <i class="fa-solid fa-ellipsis"></i>
                    </button>
                </div>
                {{-- @foreach (auth()->user()->getFriendUsers() as $friend)
                    <x-profile-card :user="$friend"></x-profile-card>
                @endforeach --}}
            </nav>
        </aside>
    </div>
</x-app-layout>
