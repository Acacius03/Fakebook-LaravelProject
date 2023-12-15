<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

new class extends Component {
    use WithFileUploads;

    #[Validate('required|string|max:255')]
    public string $name = '';
    #[Validate('required|email|max:255')]
    public string $email = ''; // 1MB Max

    #[Validate('nullable|sometimes|image|max:1024')]
    public $profile_photo = '';
    #[Validate('nullable|sometimes|image|max:1024')]
    public $cover_photo = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = auth()->user();

        $validated = $this->validate();

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        if ($this->profile_photo) {
            $user->profile_photo = $this->profile_photo->store('profile_images', 'public');
        }
        if ($this->cover_photo) {
            $user->cover_photo = $this->cover_photo->store('cover_images', 'public');
        }
        $user->save($validated);
        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $path = session('url.intended', RouteServiceProvider::HOME);

            $this->redirect($path);

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section>
    <header class="mb-5">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>
    <form wire:submit="updateProfileInformation" class="mt-6space-y-6" enctype="multipart/form-data">
        <div class="flex items-center gap-4">
            <div x-data="{ 'preview': '{{ asset('storage/' . auth()->user()->profile_photo) }}' }">
                <label for="profile_photo">
                    <figure class="h-36 w-36 rounded-full border-2 p-1 shadow-inner">
                        <img x-show="preview!==''" x-bind:src="preview" alt="Preview Image">
                    </figure>
                    <x-text-input wire:model="profile_photo" type="file" accept='image/jpeg, image/png'
                        name="profile_photo" id="profile_photo" class="hidden"
                        @change="preview=URL.createObjectURL($event.target.files[0])" />
                    <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
                </label>
            </div>
            <div class="flex flex-grow flex-col gap-4 text-base">
                <div>
                    <div class="flex items-center justify-between">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <x-text-input wire:model="name" id="name" class="mt-1 block w-full border p-2" type="name"
                        name="name" required autocomplete="username" />
                </div>
                <div>
                    <div>
                        <div class="flex items-center justify-between">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <x-text-input wire:model="email" id="email" class="mt-1 block w-full border p-2"
                            type="email" name="email" required autocomplete="username" />
                    </div>
                    @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&
                            !auth()->user()->hasVerifiedEmail())
                        <div>
                            <p class="mt-2 text-sm text-gray-800 dark:text-gray-200">
                                {{ __('Your email address is unverified.') }}

                                <button wire:click.prevent="sendVerification"
                                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
                <div>
                </div>
            </div>
        </div>
        <label for="cover_photo" class="mb-2 block">
            <p class="p-2 text-xl font-medium text-gray-900">
                Cover Photo
            </p>
            <div class="rounded-md border-2 p-1 shadow-inner">
                <div x-data="{ 'preview': '{{ asset('storage/' . auth()->user()->cover_photo) }}' }">
                    <figure
                        class="max-h-[400px] min-h-[250px] w-full overflow-hidden rounded-md border-2 bg-neutral-100">
                        <img x-show="preview!==''" class="h-full w-full object-contain" x-bind:src="preview"
                            alt="Cover Image">
                    </figure>
                    <x-text-input wire:model="cover_photo" id="cover_photo" accept='image/jpeg, image/png'
                        name="cover_photo" type="file" class="hidden"
                        @change="preview=URL.createObjectURL($event.target.files[0])" />
                </div>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('cover_photo')" />
        </label>
        <div class="flex flex-col gap-4">
            <x-action-message class="me-3" on="profile-updated">
                {{ __('Saved.') }}
            </x-action-message>
            <div wire:loading>
                <i class="fa-solid fa-spinner fa-spin"></i>
            </div>
            <x-primary-button class="h-10 w-full justify-center">
                {{ __('Save') }}
            </x-primary-button>
        </div>
    </form>
</section>
