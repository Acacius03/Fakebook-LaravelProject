<div class="bg-cover pt-24" style="background-image: url({{ asset('storage/' . auth()->user()->cover_photo) }})">
    <div class="flex flex-col items-center bg-white px-5 pb-3 dark:bg-gray-700">
        <div class="-mt-10 h-20 w-20 rounded-full border-2 bg-gray-500">
            <x-avatar :image="auth()->user()->profile_photo"></x-avatar>
        </div>
        <h5 class="text-base font-medium text-gray-900 dark:text-white">
            {{ auth()->user()->name }}
        </h5>
        <span class="text-sm text-gray-500 dark:text-gray-400">
            {{ auth()->user()->email }}
        </span>
    </div>
</div>
