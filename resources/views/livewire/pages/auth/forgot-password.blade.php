<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink($this->only('email'));

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div class="flex flex-col justify-between">
    <div class="mx-auto mt-20 max-w-[680px] border p-10 shadow">
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form wire:submit="sendPasswordResetLink">
            <!-- Email Address -->
            <div>
                <div class="flex items-center justify-between">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <x-text-input wire:model="email" id="email" class="mt-1 block w-full border p-2" type="email"
                    name="email" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4 flex items-center justify-end">
                <input class="rounded-md bg-green-600 px-4 py-2 text-xl font-bold text-white hover:bg-green-500"
                    type="submit" value="{{ __('Email Password Reset Link') }}">
            </div>
        </form>
    </div>
    <footer class="absolute bottom-0 left-0 w-full border bg-white py-10 text-center">
        <p>Fakebook Copyright &copy; 2023, All Rights Reserved.</p>
    </footer>
</div>
