<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div class="flex h-screen flex-col justify-between gap-10">
    <div class="m-auto max-w-[680px] px-20">
        <div class="mb-5">
            <h2
                class="mx-auto mb-7 h-20 w-20 overflow-hidden rounded-lg bg-blue-700 pr-4 text-right text-8xl font-bold text-white">
                f</h2>
            <h2 class="text-center text-3xl font-bold">Create Your Fakebook Account</h2>
        </div>
        <form wire:submit="register" class="flex flex-col gap-4">
            <!-- Name -->
            <div>
                <div class="flex items-center justify-between">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <x-text-input wire:model="name" id="name" class="mt-1 block w-full border p-2" type="text"
                    name="name" required autofocus autocomplete="name" />
            </div>
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
            <div class="mt-4 flex items-center justify-end gap-2">
                <a class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                    href="{{ route('login') }}" wire:navigate>
                    {{ __('Already registered?') }}
                </a>
                <input class="rounded-md bg-green-400 px-4 py-2 text-xl font-bold text-white" type="submit"
                    value="{{ __('Register') }}">
            </div>
        </form>
    </div>
    <footer class="border bg-white py-10 text-center">
        <p>Fakebook Copyright &copy; 2023, All Rights Reserved.</p>
    </footer>
</div>
