<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;
    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirect(session('url.intended', RouteServiceProvider::HOME), navigate: true);
    }
}; ?>

<div>
    <div class="h-screen grid-cols-2 lg:grid">
        <div class="hidden bg-cover bg-center lg:block" style="background-image: url('/image/login_bg.jpg')">
        </div>
        <div class="flex h-full flex-col justify-end gap-20">
            <div class="font-bold">
                <h2
                    class="mx-auto mb-5 h-20 w-20 overflow-hidden rounded-lg bg-blue-700 pr-4 text-right text-8xl text-white">
                    f</h2>
                <h2 class="text-center text-3xl">Log in to your account</h2>
            </div>
            <!-- Session Status -->
            <x-auth-session-status class="my-2 pr-10 text-right" :status="session('status')" />
            <div class="mx-auto w-4/5 rounded-md border bg-white p-10 shadow-lg">
                <form wire:submit="login">
                    <!-- Email Address -->
                    <div>
                        <div class="flex items-center justify-between">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <x-text-input wire:model="form.email" id="email" type="email" name="email"
                            class="mt-1 w-full border p-2 dark:text-black" required autofocus autocomplete="username" />
                    </div>
                    <!-- Password -->
                    <div class="my-2">
                        <div class="flex items-center justify-between">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <x-text-input wire:model="form.password" id="password" type="password" name="password"
                            class="mt-1 block w-full border p-2 dark:text-black" required
                            autocomplete="current-password" />
                    </div>
                    <a href="{{ route('password.request') }}" wire:navigate
                        class="m-1 ml-auto mt-4 block w-max px-1 text-sm text-gray-600 underline hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100">
                        {{ __('Forgot your password?') }}
                    </a>
                    <input type="submit" value="{{ __('Log in') }}"
                        class="btn-primary w-full rounded-md py-2 text-xl font-bold">
                </form>
                <p
                    class="my-4 flex items-center justify-center gap-2 px-5 before:h-[1px] before:flex-auto before:bg-black after:h-[1px] after:flex-auto after:bg-black">
                    Or</p>
                <a href="{{ route('register') }}" wire:navigate
                    class="mx-auto block w-max text-sm text-gray-600 underline hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100">
                    {{ __('Create a new account') }}
                </a>
            </div>
            <footer class="border-t-2 bg-white py-10 text-center dark:border-0">
                <p>{{ __('Fakebook Copyright') }} &copy; {{ __('2023, All Rights Reserved.') }}</p>
            </footer>
        </div>
    </div>
</div>
