<header class="sticky top-0 z-50 border-gray-100 bg-white shadow dark:border-gray-700 dark:bg-gray-800">
    <nav class="grid grid-cols-2 px-5 md:grid-cols-3">
        <div class="flex items-center gap-1 md:pr-9">
            <a href="{{ route('home') }}" wire:navigate class="h-12">
                <img src="/image/facebook.png" alt="">
            </a>
            <livewire:search-user></livewire:search-user>
        </div>
        <div class="-mx-7 hidden grid-cols-5 text-2xl text-neutral-500 md:grid">
            <x-main-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                <i class="fa-solid fa-house"></i>
            </x-main-nav-link>
            <x-main-nav-link href="{{ route('friends') }}" :active="request()->routeIs('friends')">
                <i class="fa-solid fa-user-group"></i>
            </x-main-nav-link>
            <x-main-nav-link href="{{ route('home') }}">
                <i class="fa-brands fa-youtube"></i>
            </x-main-nav-link>
            <x-main-nav-link href="{{ route('home') }}">
                <i class="fa-solid fa-store"></i>
            </x-main-nav-link>
            <x-main-nav-link href="{{ route('home') }}">
                <i class="fa-solid fa-gamepad"></i>
            </x-main-nav-link>
        </div>
        <div class="flex items-center justify-end gap-2 p-1">
            <x-dropdown>
                <x-slot name="trigger">
                    <button
                        class="flex h-11 w-11 items-center justify-center rounded-full bg-neutral-200 hover:bg-neutral-300/90 dark:hover:bg-neutral-700/75">
                        <x-avatar :image="auth()->user()->profile_photo"></x-avatar>
                    </button>
                </x-slot>
                <x-slot name="content">
                    <div class="flex w-[300px] flex-col overflow-hidden rounded-md border bg-white shadow">
                        @include('components.main-user-card')
                        <x-dropdown-link class="flex justify-between" href="{{ route('profile.edit') }}">
                            Profile Settings <i class="fa-solid fa-user-pen"></i>
                        </x-dropdown-link>
                        @include('components.dark-mode-toggler')
                        <livewire:logout-button />
                    </div>
                </x-slot>
            </x-dropdown>
        </div>
    </nav>
</header>
