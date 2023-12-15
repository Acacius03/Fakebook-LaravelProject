<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    #[Locked]
    public string $token = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Mount the component.
     */
    public function mount(string $token): void
    {
        $this->token = $token;

        $this->email = request()->string('email');
    }

    /**
     * Reset the password for the given user.
     */
    public function resetPassword(): void
    {
        $this->validate([
            'token' => ['required'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset($this->only('email', 'password', 'password_confirmation', 'token'), function ($user) {
            $user
                ->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])
                ->save();

            event(new PasswordReset($user));
        });

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if ($status != Password::PASSWORD_RESET) {
            $this->addError('email', __($status));

            return;
        }

        Session::flash('status', __($status));

        $this->redirectRoute('login', navigate: true);
    }
}; ?>
<div class="flex h-screen flex-col justify-between gap-10">
    <div class="m-auto w-full max-w-[680px] px-20">
        <div class="mb-5">
            <h2
                class="mx-auto mb-7 h-20 w-20 overflow-hidden rounded-lg bg-blue-700 pr-4 text-right text-8xl font-bold text-white">
                f</h2>
            <h2 class="text-center text-3xl font-bold">Change Password</h2>
        </div>
        <form wire:submit="resetPassword" class="flex flex-col gap-4">
            <!-- Email Address -->
            <div>
                <div class="flex items-center justify-between">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <x-text-input wire:model="email" id="email" class="mt-1 block w-full border p-2" type="email"
                    name="email" required autocomplete="username" />
            </div>
            <!-- Password -->
            <div>
                <div class="flex items-center justify-between">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <x-text-input wire:model="password" id="password" class="mt-1 block w-full border p-2" type="password"
                    name="password" required autocomplete="new-password" />
            </div>
            <!-- Confirm Password -->
            <div>
                <div class="flex items-center justify-between">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <x-text-input wire:model="password_confirmation" id="password_confirmation"
                    class="mt-1 block w-full border p-2" type="password" name="password_confirmation" required
                    autocomplete="new-password" />
            </div>
            <div class="mt-4 flex items-center justify-end">
                <input class="rounded-md bg-green-600 px-4 py-2 text-xl font-bold text-white hover:bg-green-500"
                    type="submit" value="{{ __('Reset Password') }}">
            </div>
        </form>
    </div>
    <footer class="absolute bottom-0 left-0 w-full border bg-white py-10 text-center">
        <p>Fakebook Copyright &copy; 2023, All Rights Reserved.</p>
    </footer>
</div>
