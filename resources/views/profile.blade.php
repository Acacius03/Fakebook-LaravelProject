<x-app-layout>
    <div class="mx-auto pt-4">
        <div class="max-w-8xl mx-auto grid-cols-3 gap-2 sm:px-6 lg:px-8 2xl:grid">
            <div class="m-4 bg-white p-4 shadow sm:rounded-lg sm:p-8">
                <livewire:profile.update-profile-information-form />
            </div>
            <div class="m-4 bg-white p-4 shadow sm:rounded-lg sm:p-8">
                <livewire:profile.update-password-form />
            </div>
            <div class="m-4 bg-white p-4 shadow sm:rounded-lg sm:p-8">
                <livewire:profile.delete-user-form />
            </div>
        </div>
    </div>
</x-app-layout>
